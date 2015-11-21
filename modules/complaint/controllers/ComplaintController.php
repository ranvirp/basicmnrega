<?php

namespace app\modules\complaint\controllers;

use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintReply;
use app\modules\complaint\models\ComplaintSearch;
use app\modules\users\models\Designation;
use app\modules\complaint\models\ComplaintPoint;
use app\modules\complaint\models\Complaint_type;
use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\EnquiryReportSummary;
use app\modules\complaint\models\EnquiryReportPoint;
use app\modules\complaint\models\AtrSummary;
use app\modules\complaint\models\AtrPoint;
use app\modules\mnrega\models\MarkingSearch;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use app\modules\complaint\Utility;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * ComplaintController implements the CRUD actions for Complaint model.
 */
class ComplaintController extends Controller {

	public function actionIndex() {
		//return $this->render('dashboard');
		if (Yii::$app->user->isGuest)
			throw new NotFoundHttpException("You are not allowed!!");

		$searchModel = new ComplaintSearch();
		
		$status = Yii::$app->request->get('s');
		if ($status>=0)
			$searchModel->status = $status;
		$source = Yii::$app->request->get('source');
		if ($source!='')
			$searchModel->source = $source;
		$dcode = Yii::$app->request->get('dcode');
		if ($dcode!=null && $dcode!=-1 )
			$searchModel->district_code = $dcode;
			
		    // $searchModel->enqrofficer=
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams
	
		);
		
		//$dataProvider->query = $dataProvider->query->with('markings');
		//$dataProvider->query=$dataProvider->query->join('LEFT OUTER JOIN','marking',['marking.request_id'=>'complaint.id','marking.request_type'=>'complaint'])->
		 //where('(complaint.enqrofficer=marking.id or complaint.atrofficer=marking.id) and complaint.receiver_designation_id='.$desgn )->select('distinct complaint.*');
		return $this->render('index2', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'model' => null]);
	}

	/**
	 * Creates a new Complaint model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {

		$modelComplaint = new Complaint;
		//$modelComplaint->on(\yii\db\ActiveRecord::EVENT_AFTER_INSERT,function($event){Yii::$app->sms->sendSMS($event);});
		if (Yii::$app->user->isGuest)
		{
			$modelComplaint->scenario = 'guestentry'; //captcha validation
		}
		$flagcomplex = 0;
		$modelsComplaintPoint = [new ComplaintPoint];
		if ($modelComplaint->load(Yii::$app->request->post())) {

			$modelsComplaintPoint = Utility::createMultiple(ComplaintPoint::classname());
			Model::loadMultiple($modelsComplaintPoint, Yii::$app->request->post());


			// ajax validation
			if (Yii::$app->request->isAjax) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ArrayHelper::merge(
						ActiveForm::validateMultiple($modelsComplaintPoint), ActiveForm::validate($modelComplaint)
				);
			}
	$modelComplaint->dateofcomplaint=date('Y-m-d',strtotime($modelComplaint->dateofcomplaint));
				 	
			// validate all models
			$valid = $modelComplaint->validate();
			$valid = Model::validateMultiple($modelsComplaintPoint) && $valid;

			if ($valid) {
				$transaction = \Yii::$app->db->beginTransaction();
				try {
				   //if (Yii::$app->user->isGuest)
					$modelComplaint->status = Complaint::REGISTERED;
					if (Yii::$app->user->isGuest)
						$modelComplaint->source='web';
					
					//Audit trail
					$modelComplaint->created_by = Yii::$app->user->id;
					$modelComplaint->create_time = time();
					
					if ($modelComplaint->dateofcomplaint==null)
					$modelComplaint->created_at = time();
					else 
					 $modelComplaint->created_at =strtotime($modelComplaint->dateofcomplaint);
					 
					if ($flag = $modelComplaint->save(false)) {

                        $modelComplaint->_createSingleMarking();
                       if(! $modelComplaint->save()) 
                       {
                        //print_r($modelComplaint->errors);
                        //$transaction->rollBack();
                        //return $this->renderText('Error');
                        }
						foreach ($modelsComplaintPoint as $modelComplaintPoint) {
							// print_r($modelComplaintPoint);
							//exit;
							$modelComplaintPoint->complaint_id = $modelComplaint->id;
							if (!($flag = $modelComplaintPoint->save())) {
								$transaction->rollBack();
								break;
							}
							$modelComplaint->flowtype = 1; //if there are complaint points it
							//has to be complext flow type
						}
					}
					if ($flag) {

						// $modelComplaint->flag=1;//requires Admin Attention
						//
                        $transaction->commit();
                        if (Yii::$app->user->can('complaintagent'))
                        {
                          
                           \Yii::$app->getSession()->setFlash('success', 'Complaint with id '.$modelComplaint->id.' created');
                            $modelComplaint=new Complaint;//reset
                           } else
						return $this->redirect(['view', 'id' => $modelComplaint->id]);
					}
				} catch (Exception $e) {
					$transaction->rollBack();
				}
			}
		}

		return $this->render('/default/complaintnew', [
				'modelComplaint' => $modelComplaint,
				'modelsComplaintPoint' => (empty($modelsComplaintPoint)) ? [new ComplaintPoint] : $modelsComplaintPoint
		]);
	}

	/**
	 * Updates an existing Complaint model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		if (!Yii::$app->user->can('complaintagent'))
			throw new NotFoundHttpException("You are not allowed!!");

		$modelComplaint = $this->findModel($id);
		$modelsComplaintPoint = $modelComplaint->complaintPoints;
		if ($modelComplaint->create_time==null)
		 $modelComplaint->create_time=time();
        if ($modelComplaint->dateofcomplaint==null)
					 $modelComplaint->dateofcomplaint =date('Y-m-d',$modelComplaint->created_at);
			
		if ($modelComplaint->load(Yii::$app->request->post())) {

			$oldIDs = ArrayHelper::map($modelsComplaintPoint, 'id', 'id');
			$modelsComplaintPoint = Utility::createMultiple(ComplaintPoint::classname(), $modelsComplaintPoint);
			Model::loadMultiple($modelsComplaintPoint, Yii::$app->request->post());
			$deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsComplaintPoint, 'id', 'id')));

			// ajax validation
			if (Yii::$app->request->isAjax) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ArrayHelper::merge(
						ActiveForm::validateMultiple($modelsComplaintPoint), ActiveForm::validate($modelComplaint)
				);
			}
			$modelComplaint->created_at=strtotime($modelComplaint->dateofcomplaint);
	
           // $modelComplaint->dateofcomplaint=date('Y-m-d',strtotime($modelComplaint->dateofcomplaint));
			//print	$modelComplaint->dateofcomplaint;
			//exit;
			// validate all models
			$valid = $modelComplaint->validate();
			$valid = Model::validateMultiple($modelsComplaintPoint) && $valid;

			if ($valid) {
				$transaction = \Yii::$app->db->beginTransaction();
				try {
					
					//Audit trail
					$modelComplaint->updated_by = Yii::$app->user->id;
					$modelComplaint->updated_at = time();
					$modelComplaint->flag = 1; //requires Admin Attention
					
					if ($flag = $modelComplaint->save(false)) {
					   $modelComplaint->_createSingleMarking();
                        $modelComplaint->save(false);
						if (!empty($deletedIDs)) {
							ComplaintPoint::deleteAll(['id' => $deletedIDs]);
						}

						foreach ($modelsComplaintPoint as $modelComplaintPoint) {
							//  print_r($modelComplaintPoint);
							//exit;

							$modelComplaintPoint->complaint_id = $modelComplaint->id;
							if (!($flag = $modelComplaintPoint->save(false))) {
								print_r($modelComplaint->errors());
								$transaction->rollBack();
								break;
							}
						}
					}
					if ($flag) {

						//
						$transaction->commit();
						return $this->redirect(['view', 'id' => $modelComplaint->id]);
					}
				} catch (Exception $e) {
					$transaction->rollBack();
				}
			}
		}

		return $this->render('/default/complaintnew', [
				'modelComplaint' => $modelComplaint,
				'modelsComplaintPoint' => (empty($modelsComplaintPoint)) ? [new ComplaintPoint] : $modelsComplaintPoint
		]);
	}

	/**
	 * Displays a single Reply model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id,$print=1) {
		//$this->view->params['sidebar'] = Yii::getAlias('@app/modules/complaint/views/complaint/sidebar.php');
		$model = $this->findModel($id);
		return $this->render('viewcontainer', [
				'model' => $model,
				'print'=>$print,
		]);
	}

	/**
	 * Finds the Reply model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Reply the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Complaint::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionMark($id, $a = 'e', $canmark = 0,$change=0) {
		if (!(Yii::$app->user->can('canmark') || Yii::$app->user->can('complaintagent') || Yii::$app->user->can('complaintadmin')))
			throw new NotFoundHttpException("Not Allowed");
		if (!(Yii::$app->user->can('complaintadmin')|| Yii::$app->user->can('complaintagent'))) {
		    $change=0;
			$canmark = 0;
		}
		$model = $this->findModel($id);
		$model->marking=['actiontype'=>$a];
		if (Yii::$app->request->post()) {

			if ($model) {

				$model->_createSingleMarking($a, $canmark,$change);
				$model->save();
				print "done";
			}
		}
		else
		return $this->renderAjax('markingsingle', ['modelComplaint' => $model, 'district_code' => $model->district_code, 'actiontype' => $a, 'canmark' => $canmark,'change'=>$change]);
	}

	public function actionMy($ms = -1, $d = -1, $s = -1, $dcode = null, $bcode = null,$sender=-1,$allflags=false,$enqrofficer=false,$atrofficer=false,$title='List of Complaints') {

		if (Yii::$app->user->isGuest)
			throw new NotFoundHttpException("Not Allowed");
		$complaintSearch = new ComplaintSearch;
		$complaintSearch->load(Yii::$app->request->get());
		$searchModel = [];
		$searchModel['id'] = $complaintSearch->id;
		$dp = Complaint::count1($ms, $d, $s, false, $dcode, $bcode,$sender,$allflags,$enqrofficer,$atrofficer);
		return $this->render('index4', ['dataProvider' => $dp, 'searchModel' => $searchModel,'title'=>$title]);
	}
		public function actionMy1($ms = -1, $d = -1, $s = -1, $dcode = null, $bcode = null,$flag=0,$title='List of Complaints') {

		if (Yii::$app->user->isGuest)
			throw new NotFoundHttpException("Not Allowed");
		$complaintSearch = new ComplaintSearch;
		$complaintSearch->load(Yii::$app->request->get());
		$searchModel = [];
		$searchModel['id'] = $complaintSearch->id;
		$dp = Complaint::count2($ms, $d, $s, false, $dcode, $bcode,$flag);
		return $this->render('index4', ['dataProvider' => $dp, 'searchModel' => $searchModel,'title'=>$title]);
	}

	public function actionSetmarkingstatus() {
		if (!Yii::$app->user->can('complaintagent'))
			throw new NotFoundHttpException("Not Allowed");
		$id = \Yii::$app->request->post('request_id');
		$markingid = Yii::$app->request->post('markingid');
		$message = Yii::$app->request->post('message');
		$status = Yii::$app->request->post('markingstatus');
		Marking::setStatus($markingid, $status, $message);
	}

	public function actionSetstatus($id, $status, $message = '') {
		if (Yii::$app->user->can('complaintadmin') || Yii::$app->user->can('complaintagent')) {
			Complaint::setStatus($id, $status, $message);
			return $status;
		} else
			throw new NotFoundHttpException("Not Allowed");
	}

	protected function _ismarkedtocurrentuser($id, $markingid) {
		$currdesignation = Designation::getDesignationByUser(Yii::$app->user->id);
		$marking = Marking::find()->where(['id' => $markingid, 'request_id' => $id])->one();
		if ($marking)
			return ($marking->sender == $currdesignation) || ($marking->receiver == $currdesignation);
		else
			return false;
	}

	public function actionGetreply($id) {
		$cr = ComplaintReply::findOne($id);
		if ($cr)
			return $this->render('_reply', ['reply' => $cr]);
		else
			return '';
	}

	public function actionFilereply($id, $markingid) {
		//Add to Reply
		if (!$this->_ismarkedtocurrentuser($id, $markingid))
			throw new NotFoundHttpException('Not Found');
		$complaint = Complaint::findOne($id);
		$marking = Marking::findOne($markingid);
		if (!(($marking->request_type == 'complaint') && ($marking->request_id == $id)))
			throw new NotFoundHttpException('Not Found');

		$model = new ComplaintReply;

		$model->marking_id = $markingid;
		$model->complaint_id = $id;

		if ($model->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->created_at = time();
				$model->updated_at = time();
				$model->author = Yii::$app->user->id;
				if (!$model->save())
					print_r($model->errors);
				switch ($model->reply_type) {
					case ComplaintReply::ENQUIRY_REPORT:
						Marking::setStatus($markingid, Complaint::ENQUIRY_REPORT_RECEIVED);
						if ($complaint->enqrofficer == $markingid)
							Complaint::setStatus($id, Complaint::ENQUIRY_REPORT_RECEIVED);
						break;
						case ComplaintReply::QUESTION:
						  $marking=Marking::findOne($markingid);
						  if (Yii::$app->user->can('complaintadmin') && Yii::$app->user->can('complaintagent'))
						   $marking->flag=3;
						   else
					
						  $marking->flag=4;
						  $marking->save();
						break;
						case ComplaintReply::REPLY_TO_QUESTION:
						  $marking=Marking::findOne($markingid);
						  if (Yii::$app->user->can('complaintadmin') && Yii::$app->user->can('complaintagent'))
						   $marking->flag=3;
						   else
					
						  $marking->flag=4;
						  $marking->save();
						break;

					case ComplaintReply::ATR_REPORT:
						Marking::setStatus($markingid, Complaint::ATR_RECEIVED);
						if ($complaint->atrofficer == $markingid)
							Complaint::setStatus($id, Complaint::ATR_RECEIVED);
						break;
					default:
						//$complaintstatus = Yii::$app->request->post('complaintstatus');
						//if ($complaintstatus) {
						//	Complaint::setStatus($id, $complaintstatus);
						//}
						break;
				}
				// Marking::setStatus($markingid,Complaint::ATR_RECEIVED);
				//Complaint::setStatus($id,Complaint::ATR_RECEIVED);
				$transaction->commit();
				print "Saved";
				$model = new ComplaintReply;
			} catch (Exception $e) {
				$transaction->rollBack();
				print_r($model->errors);
			}
		} else

		if (Yii::$app->request->isAjax)
			return $this->renderAjax('createreply', ['model' => $model, 'id' => $id, 'marking' => $marking]);
		else
			return $this->render('createreply', ['model' => $model, 'id' => $id, 'marking' => $marking]);
		
	}
	public function actionLeftmenu()
	 {
	 if (Yii::$app->user->isGuest)
	  throw new NotFoundHttpException(" Please do not hack it");
	   if (Yii::$app->user->can('complaintadmin') || Yii::$app->user->can('complaintagent'))
	     return $this->renderPartial('//layouts/leftmenuadmin.php');
	  else 
	    if (!Yii::$app->user->isGuest)
	       return $this->renderPartial('//layouts/leftmenu.php');
	 }


}