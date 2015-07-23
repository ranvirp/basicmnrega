<?php
namespace app\modules\complaint\controllers;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintSearch;

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
use yii\web\Controller;
use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ActiveDataProvider;
/**
 * ComplaintController implements the CRUD actions for Complaint model.
 */
class ComplaintController extends Controller
{

public function actionIndex()
{
  //return $this->render('dashboard');
   $searchModel = new ComplaintSearch();
   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
   $dataProvider->query=$dataProvider->query->with('markings');
   //leftJoin('marking',['marking.request_id'=>'complaint.id','marking.request_type'=>'complaint']);
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\complaint\models\Complaint]);
}
    /**
     * Creates a new Complaint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      
        $modelComplaint = new Complaint;
         if (Yii::$app->user->isGuest)
            $modelComplaint->scenario='guestentry';//captcha validation
        $modelsComplaintPoint = [new ComplaintPoint];
        if ($modelComplaint->load(Yii::$app->request->post())) {

            $modelsComplaintPoint = Utility::createMultiple(ComplaintPoint::classname());
            Model::loadMultiple($modelsComplaintPoint, Yii::$app->request->post());
            
          
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsComplaintPoint),
                    ActiveForm::validate($modelComplaint)
                );
            }

            // validate all models
            $valid = $modelComplaint->validate();
            $valid = Model::validateMultiple($modelsComplaintPoint) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                      $modelComplaint->status=Complaint::REGISTERED;
                        $modelComplaint->_createMarking();
                        
                          //Audit trail
                       $modelComplaint->created_by=Yii::$app->user->id;
                       $modelComplaint->created_at=time();
                    if ($flag = $modelComplaint->save(false)) {
                    

                        foreach ($modelsComplaintPoint as $modelComplaintPoint) {
                           // print_r($modelComplaintPoint);
                            //exit;
                            $modelComplaintPoint->complaint_id = $modelComplaint->id;
                            if (! ($flag = $modelComplaintPoint->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                       
                      // $modelComplaint->flag=1;//requires Admin Attention
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
     * Updates an existing Complaint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelComplaint = $this->findModel($id);
        $modelsComplaintPoint = $modelComplaint->complaintPoints;

        if ($modelComplaint->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsComplaintPoint, 'id', 'id');
            $modelsComplaintPoint = Utility::createMultiple(ComplaintPoint::classname(), $modelsComplaintPoint);
            Model::loadMultiple($modelsComplaintPoint, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsComplaintPoint, 'id', 'id')));
           
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsComplaintPoint),
                    ActiveForm::validate($modelComplaint)
                );
            }

            // validate all models
            $valid = $modelComplaint->validate();
            $valid = Model::validateMultiple($modelsComplaintPoint) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                       $modelComplaint->_createMarking();
                       
                       //Audit trail
                       $modelComplaint->updated_by=Yii::$app->user->id;
                       $modelComplaint->updated_at=time();
                       $modelComplaint->flag=1;//requires Admin Attention
                    if ($flag = $modelComplaint->save(false)) {
                        if (! empty($deletedIDs)) {
                            ComplaintPoint::deleteAll(['id' => $deletedIDs]);
                        }
                      
                        foreach ($modelsComplaintPoint as $modelComplaintPoint) {
                           //  print_r($modelComplaintPoint);
                            //exit;
                           
                            $modelComplaintPoint->complaint_id = $modelComplaint->id;
                            if (! ($flag = $modelComplaintPoint->save(false))) {
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
    public function actionView($id)
    {
        return $this->render('view1', [
            'model' => $this->findModel($id),
        ]);
    }
     /**
     * Finds the Reply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complaint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSearch($mobileno)
    {
      $models=Complaint::find()->where(['mobileno'=>$mobileno])->asArray()->all(); 
      return json_encode($models);
    }
   
    /*
    File Report for a complaint 
    */
    public function actionFilereport($id)
    {
        $modelComplaint = $this->findModel($id);
                    
        $modelsComplaintPoint = $modelComplaint->complaintPoints;
        $enquiryReportSummary=$modelComplaint->enquiryReportSummary;
        if (!$enquiryReportSummary) 
        { 
          $enquiryReportSummary=new EnquiryReportSummary;
          $enquiryReportSummary->complaint_id=$modelComplaint->id;
          }
        $enquiryReportsPoint=$modelComplaint->enquiryReportsPoint;
        if (!$enquiryReportsPoint)
        {
          foreach ($modelsComplaintPoint as $modelComplaintPoint)
              {
                 $eq=new EnquiryReportPoint;
                 $eq->complaint_point_id=$modelComplaintPoint->id;
                 $enquiryReportsPoint[$modelComplaintPoint->id]=$eq;
                 
              }
        }
        if ($enquiryReportSummary->load(Yii::$app->request->post())) {

            Model::loadMultiple($enquiryReportsPoint,Yii::$app->request->post());
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($enquiryReportsPoint),
                    ActiveForm::validate($enquiryReportSummary)
                );
            }

            // validate all models
            $valid = $enquiryReportSummary->validate();
            if (!$valid)
              print_r($enquiryReportSummary->errors);
            $valid = Model::validateMultiple($enquiryReportsPoint) && $valid;
            if (!$valid)
             {
              foreach ($enquiryReportsPoint as $enqreportpoint)
              print_r($enquiryreportpoint->errors);
              }
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $enquiryReportSummary->save(false)) {
                       
                        foreach ($enquiryReportsPoint as $enquiryReportPoint) {
                           //  print_r($modelComplaintPoint);
                            //exit;
                           
                            //$modelComplaintPoint->complaint_id = $modelComplaint->id;
                            if (! ($flag = $enquiryReportPoint->save(false))) {
                               print_r($enquiryReportPoint->errors());
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                         $markingid=Yii::$app->request->get('markingid');
                         if ($markingid)
                         $modelComplaint->markStatus($markingid,2);
                         if ($modelComplaint->status==Complaint::PENDING_FOR_ENQUIRY)
                           $modelComplaint->status=Complaint::ENQUIRY_REPORT_RECEIVED;
                         $modelComplaint->save(false);
                        $transaction->commit();
                        return $this->render('/default/atrform', ['model' => $modelComplaint]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
      if ($modelComplaint) {
            return $this->render('/default/atrform',['model'=>$modelComplaint]);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
          }
  public function actionViewcomments($id)
  {
             return $this->render('comments',['model'=>$this->findModel($id)]); 
  }
  public function actionMark($id)
  {
    $model=$this->findModel($id);
    if (Yii::$app->request->post())
    {
    if ($model)
    {
      $model->_createMarking();
     }
     }
    return $this->renderPartial('marking',$model);
    
  }
   /*
     Assigned to current designation
    */
    public function actionMy1($t='c',$d=-1)
    {
       $modelSearch= new MarkingSearch;
       if ($d==-1)
       {
         $designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
         $d=$designation->id;
       }
       if (!Yii::$app->user->can('complaintviewall'))
       $modelSearch->receiver=$d;
       $modelSearch->status=0;
       if ($t=='c')
       $modelSearch->request_type='complaint';
       else if ($t=='wd') 
         $modelSearch->request_type='workdemand';
       else if ($t=='jc') 
         $modelSearch->request_type='jobcarddemand';
     
     
       $dp=$modelSearch->search([]);
       return $this->render('index',['searchModel'=>$modelSearch,'dataProvider'=>$dp]);
    }
    public function actionMy($ms=0,$d=-1,$s=-1)
     {
     /*
        $query = new Query;
	    $query  ->select('complaint.id as id,complaint.name_hi as cname,fname,mobileno,address,panchayat,
	    complaint_type.name_hi as ctype,complaint_subtype.name_hi as csubtype,complaint.description as desc,dateofmarking,complaint.status as complaintstatus,marking.id as markingid,marking.status as markingstatus') 
	        ->from('complaint')
	        ->join(  'RIGHT JOIN',
	                'marking',
	                'marking.request_id =complaint.id and marking.request_type=\'complaint\''
	            )
	           ->join(  'RIGHT JOIN',
	                'complaint_type',
	                'complaint.complaint_type =complaint_type.shortcode'
	            ) 
	             ->join(  'RIGHT JOIN',
	                'complaint_subtype',
	                'complaint.complaint_subtype =complaint_subtype.shortcode'
	            );
  // $query->where(['complaint.status'=>$s]);
  if ($ms==-2)
    $query->where(['marking.status'=>null]);
else
  $query->where(['marking.status'=>$ms]);
    if ($s!=-1)
      $query->andWhere(['complaint.status'=>$s]);
	//if (!Yii::$app->user->can('complaintviewall'))
	if (($d!=-1) && (!Yii::$app->user->can('complaintadmin')))
	  {
	   $d=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
   
       $query->andWhere(['receiver'=>$d]);
       }
       //print_r($query);
       //exit;
        $dp= new ActiveDataProvider([
         'query' => $query,
         'pagination' => [
            'pageSize' => 20,
          ],
        ]);
        */
        $dp=Complaint::count1($ms,$d,$s,false);
        return $this->render('index1',['dataProvider'=>$dp]);
     
     
     }
      /*
    File Report for a complaint 
    */
    public function actionFileatr($id)
    {
        $modelComplaint = $this->findModel($id);
        $modelsEnquiryPoint = $modelComplaint->enquiryReportsPoint;
        $atrSummary=$modelComplaint->atrSummary;
        if (!$atrSummary) 
        { 
          $atrSummary=new AtrSummary;
          $atrSummary->complaint_id=$modelComplaint->id;
          }
        $atrPoints=$modelComplaint->atrPoints;
        if (!$atrPoints)
        {
          foreach ($modelsEnquiryPoint as $modelEnquiryPoint)
              {
                 $ap=new AtrPoint;
                 $ap->complaint_point_id=$modelEnquiryPoint->complaint_point_id;
                 $atrPoints[$modelEnquiryPoint->complaint_point_id]=$ap;
                 
              }
        }
        if ($atrSummary->load(Yii::$app->request->post())) {

            Model::loadMultiple($atrPoints,Yii::$app->request->post());
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($atrPoints),
                    ActiveForm::validate($atrSummary)
                );
            }

            // validate all models
             //print_r($atrSummary);
               //         exit;
                       
            $valid = $atrSummary->validate();
            if (!$valid)
              print_r($atrSummary->errors);
            $valid = Model::validateMultiple($atrPoints) && $valid;
            if (!$valid)
             {
              foreach ($atrPoints as $atrpoint)
              print_r($atrpoint->errors);
              }
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $atrSummary->save(false)) {
                        //print_r($atrSummary);
                        //exit;
                       
                        foreach ($atrPoints as $atrPoint) {
                           //  print_r($modelComplaintPoint);
                            //exit;
                           
                            //$modelComplaintPoint->complaint_id = $modelComplaint->id;
                            if (! ($flag = $atrPoint->save(false))) {
                               print_r($atrPoint->errors());
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        //print_r($atrPoint);
                        $markingid=Yii::$app->request->get('markingid');
                         if ($markingid)
                         $modelComplaint->markStatus($markingid,2);
                         if ($modelComplaint->status==Complaint::PENDING_FOR_ATR)
                           $modelComplaint->status=Complaint::ATR_RECEIVED;
                         $modelComplaint->save(false);
                        $transaction->commit();
                        return $this->render('/default/atrreportform', ['model' => $modelComplaint]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
      if ($modelComplaint) {
            return $this->render('/default/atrreportform',['model'=>$modelComplaint]);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
          }
  public function actionSetmarkingstatus()
  {
    $id=\Yii::$app->request->post('request_id');
    $markingid=Yii::$app->request->post('markingid');
    $message=Yii::$app->request->post('message');
    $status=Yii::$app->request->post('markingstatus');
    Marking::setStatus($markingid,$status,$message);
  
  
  
  }
}