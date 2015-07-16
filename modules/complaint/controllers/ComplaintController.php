<?php
namespace app\modules\complaint\controllers;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintPoint;
use app\modules\complaint\models\Complaint_type;
use app\modules\complaint\models\Complaint_marking;
use app\modules\complaint\models\EnquiryReportSummary;
use app\modules\complaint\models\EnquiryReportPoint;

use app\modules\mnrega\models\MarkingSearch;

use yii\web\NotFoundHttpException;

use app\modules\complaint\Utility;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use yii\base\Model;
/**
 * ComplaintController implements the CRUD actions for Complaint model.
 */
class ComplaintController extends Controller
{

public function actionIndex()
{
  return $this->render('dashboard');
}
    /**
     * Creates a new Complaint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelComplaint = new Complaint;
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
                    /*
                      //Now create markings
                      $markings=Yii::$app->request->post('complaint-marking');
                      $deadline=Yii::$app->request->post('deadline');
                      foreach ($markings['sender'] as $marking)
                       {
                         if ($marking=='po')
                         {
                           //find block -
                           $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$modelComplaint->block_code]);
                           $complaint_marking=new Complaint_marking;
                           $complaint_marking->sender=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->id;
                           $complaint_marking->receiver=$designation;
                           $complaint_marking->complaint_id=$modelComplaint->id;
                           $complaint_marking->deadline=$deadline;
                            $complaint_marking->status=0;
                            $complaint_marking->create_time=time();
                            $comlpaint_marking->save();
                         }
                       
                       }
                       */
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
        return $this->render('view', [
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
     Assigned to current designation
    */
    public function actionMy($d=-1)
    {
       $modelSearch= new MarkingSearch;
       if ($d==-1)
       {
         $designation=\app\modules\users\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
         $d=$designation->id;
       }
       $modelSearch->receiver=$d;
       $modelSearch->status=0;
       $dp=$modelSearch->search([]);
       return $this->render('index',['searchModel'=>$modelSearch,'dataProvider'=>$dp]);
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
}