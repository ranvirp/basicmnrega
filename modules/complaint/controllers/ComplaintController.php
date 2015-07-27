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
   if (!Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("You are not allowed!!");
     
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
                            $modelComplaint->flowtype=1;//if there are complaint points it
                            //has to be complext flow type
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
        if (!Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("You are not allowed!!");
     
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
     $model=$this->findModel($id);
     if ($model->flowtype==1)
        return $this->render('view1', [
            'model' => $model,
        ]);
    else 
      return $this->render('view2', [
            'model' => $model,
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
   
   
    /*
    File Report for a complaint 
    */
    public function actionFilereport($id,$markingid)
    {
        if (!$this->_ismarkedtocurrentuser($id,$markingid) && !Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("Not permitted");
        
        $modelComplaint = $this->findModel($id);
        $marking=Marking::findOne($markingid);
        if (!$marking)
          throw new NotFoundHttpException("Requested Page does not exist.. wrong markingid ");
        if ($modelComplaint->flowtype==1) 
          return $this->redirect(Url::to(['/complaint/filereply?id='.$id.'&markingid='.$markingid]));
        $modelsComplaintPoint = $modelComplaint->complaintPoints;
        $enquiryReportSummary=$modelComplaint->getEnquiryReportSummary($markingid)->one();
        if (!$enquiryReportSummary) 
        { 
          $enquiryReportSummary=new EnquiryReportSummary;
          $enquiryReportSummary->complaint_id=$modelComplaint->id;
          $enquiryReportSummary->marking_id=$markingid;
          }
        $enquiryReportsPoint=$modelComplaint->getEnquiryReportsPoint($markingid);
        if (!$enquiryReportsPoint)
        {
          foreach ($modelsComplaintPoint as $modelComplaintPoint)
              {
                 $eq=new EnquiryReportPoint;
                 $eq->complaint_point_id=$modelComplaintPoint->id;
                 $eq->marking_id=$markingid;
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
              print_r($enqreportpoint->errors);
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
                         
                         if ($modelComplaint->status==Complaint::PENDING_FOR_ENQUIRY)
                           $modelComplaint->status=Complaint::ENQUIRY_REPORT_RECEIVED;
                         $modelComplaint->save(false);
                         $marking->status=Complaint::ENQUIRY_REPORT_RECEIVED;
                         $marking->flag=1;//complaint admin attention
                         $marking->save();
                        $transaction->commit();
                        $returnurl1=Yii::$app->request->get('returnurl');
                         $returnurl=Yii::$app->request->post('returnurl');
                         if (!$returnurl) $returnurl=$returnurl1;
                         if ($returnurl)
                           $this->redirect($returnurl);
                        else
                           $this->redirect(['view','id'=>$modelComplaint->id]);
     
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
       if (Yii::$app->user->isGuest)
         throw new NotFoundHttpException("Not Allowed");
        return $this->render('comments',['model'=>$this->findModel($id)]); 
  }
  public function actionMark($id)
  {
     if (!Yii::$app->user->can('complaintagent'))
         throw new NotFoundHttpException("Not Allowed");
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
    public function action1My1($t='c',$d=-1)
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
    public function actionMy($ms=0,$d=-1,$s=-1,$dcode=null,$bcode=null)
     {
         
         if (Yii::$app->user->isGuest)
           throw new NotFoundHttpException("Not Allowed");
       $complaintSearch= new ComplaintSearch;
         $complaintSearch->load(Yii::$app->request->get());
         $searchModel=[];
         $searchModel['id']=$complaintSearch->id;
        $dp=Complaint::count1($ms,$d,$s,false,$dcode,$bcode);
        return $this->render('index1',['dataProvider'=>$dp,'searchModel'=>$searchModel]);
     
     
     }
      /*
    File Report for a complaint 
    */
    public function actionFileatr($id,$markingid)
    {
      if (!$this->_ismarkedtocurrentuser($id,$markingid) && !Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("Not permitted");
        
        $modelComplaint = $this->findModel($id);
         $marking=Marking::findOne($markingid);
        if (!$marking)
          throw new NotFoundHttpException("Requested Page does not exist.. wrong markingid ");
       
          if ($modelComplaint->flowtype==1) 
          return $this->redirect(Url::to(['/complaint/filereply?id='.$id.'&markingid='.$markingid]));
      
        if ($marking->status!=Complaint::PENDING_FOR_ATR)
          return $this->renderContent('First file enquiry report!!!'); 
        $modelsEnquiryPoint = $modelComplaint->getEnquiryReportsPoint($markingid);
        $atrSummary=$modelComplaint->getAtrSummary($markingid);
        if (!$atrSummary) 
        { 
          $atrSummary=new AtrSummary;
          $atrSummary->complaint_id=$modelComplaint->id;
          $atrSummary->marking_id=$markingid;
          }
        $atrPoints=$modelComplaint->atrPoints;
        if (!$atrPoints)
        {
          foreach ($modelsEnquiryPoint as $modelEnquiryPoint)
              {
                 $ap=new AtrPoint;
                 $ap->complaint_point_id=$modelEnquiryPoint->complaint_point_id;
                 $ap->marking_id=$markingid;
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
                        
                         if ($modelComplaint->status==Complaint::PENDING_FOR_ATR)
                           $modelComplaint->status=Complaint::ATR_RECEIVED;
                         $modelComplaint->save(false);
                         $marking->status=Complaint::ATR_RECEIVED;
                         $marking->flag=1;//attention of operator
                        $transaction->commit();
                         $returnurl1=Yii::$app->request->get('returnurl');
                         $returnurl=Yii::$app->request->post('returnurl');
                         if (!$returnurl) $returnurl=$returnurl1;
                         if ($returnurl)
                           $this->redirect([$returnurl]);
                        else
                           $this->redirect(['view','id'=>$modelComplaint->id]);
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
    if (!Yii::$app->user->can('complaintagent'))
      throw new NotFoundHttpException("Not Allowed");
    $id=\Yii::$app->request->post('request_id');
    $markingid=Yii::$app->request->post('markingid');
    $message=Yii::$app->request->post('message');
    $status=Yii::$app->request->post('markingstatus');
    Marking::setStatus($markingid,$status,$message);
  
  
  
  }
  public function actionSetstatus($id,$status,$message='')
  {
     if (Yii::$app->user->can('complaintadmin'))
       {
         Complaint::setStatus($id,$status,$message);
         return $status;
       }
       else
         throw new NotFoundHttpException("Not Allowed");
  
  }
  
  public function actionFilereply($id,$markingid)
  {
    //Add to Reply
    $model=new ComplaintReply;
    $model->marking_id=$markingid;
    if ($model->load(Yii::$app->request->bodyParams) )
     {
      $transaction= Yii::$app->db->beginTransaction();
   try
   {
      $model->created_at=time();
      $model->updated_at=time();
      $model->author=Yii::$app->user->id;
      if (!$model->save())
        print_r($model->errors);
      Marking::setStatus($markingid,Complaint::ATR_RECEIVED);
      Complaint::setStatus($id,Complaint::ATR_RECEIVED);
      $transaction->commit();
       print "Saved";
       }
       catch(Exception $e)
        {
          $transaction->rollBack();
          print_r($model->errors);
        }
     }
    else
    
    if (Yii::$app->request->isAjax) 
   return $this->renderAjax('createreply',['model'=>$model,'id'=>$id,'markingid'=>$markingid]);
   else 
        return $this->render('createreply',['model'=>$model,'id'=>$id,'markingid'=>$markingid]);

     
  }
  protected function _ismarkedtocurrentuser($id,$markingid)
  {
    return Marking::find()->where(['id'=>$markingid,'request_id'=>$id,'receiver'=>Designation::getDesignationByUser(Yii::$app->user->id)])->one()?true:false;
  
  }
}