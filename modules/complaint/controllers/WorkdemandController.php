<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\WorkdemandSearch;
use app\modules\complaint\models\WorkdemandReport;
use app\modules\mnrega\models\Marking;
use app\modules\users\models\Designation;



use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkdemandController implements the CRUD actions for WorkDemand model.
 */
class WorkdemandController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all WorkDemand models.
     * @return mixed
     */
   public function actionIndex()
{
  //return $this->render('dashboard');
   if (!Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("You are not allowed!!");
     
   $searchModel = new WorkDemandSearch();
   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
   //leftJoin('marking',['marking.request_id'=>'complaint.id','marking.request_type'=>'complaint']);
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\complaint\models\WorkDemand]);
}

    /**
     * Displays a single WorkDemand model.
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
     * Creates a new WorkDemand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new WorkDemand();
        $model->status=WorkDemand::PENDING;
   if (Yii::$app->user->isGuest)
            $model->scenario='guestentry';//captcha validation
       
        if ($model->load(Yii::$app->request->post()))
        {
            $model->create_time=time();
            $model->update_time=time();
            if (Yii::$app->user->isGuest)
            $model->author=0;
            else
            $model->author=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
            $model->dateto=date('Y-m-d',strtotime('+'.$model->noofdays.' day',strtotime($model->datefrom)));
            if ($model->validate())
             
            {
                 $transaction = \Yii::$app->db->beginTransaction();
                 try{
                if ( $model->save(false))
                {
                   $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                   $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$model->block_code])->one();
                //print_r($designation);
               // exit;
                if ($designation)
                {
                //($request_id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0)
                   if (Yii::$app->user->isGuest)
                   {
                      $sender=0;
                      $sender->designation_type_id=-100;
                      $sender_name=$model->name_hi;
                      $sender_mobileno=$model->mobileno;
                    }
                   else
                    {
                    $senderdesignation=Designation::getDesignationByUser(Yii::$app->user->id,true);
                    $sender=$senderdesignation->id;
                    $sender_designation_type_id=$senderdesignation->designation_type_id;
                    $sender_name=$senderdesignation->officer_name_en;
                    $sender_mobileno=$senderdesignation->officer_mobile;
                    }
                   $receiver=$designation->id;
                   $receiver_designation_type_id=$designation->designation_type_id;
                   $receiver_name=$designation->name_en;
                   $receiver_mobileno=$designation->officer_mobile;
                   $purpose="For action and report";
                   $canmark=0;
                   $status=WorkDemand::PENDING;
                   $statustarget=WorkDemand::DISPOSED;
                   $deadline=$model->datefrom;
                   $model->markToDesignation($model->id,$sender,$sender_name,$sender_mobileno,$sender_designation_type_id,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0);
                    }
                   $transaction->commit();
                   $this->redirect(['view','id'=>$model->id]);
                }
                
                else {print_r($model->errors);$transaction->rollBack();exit;}
                }
                catch(Exception $e)
                  {
                    $transaction->rollBack();
                  }
            
            $model = new WorkDemand(); //reset model
            }
            else 
            {
             print_r($model->errors);
             }
        }
 
        return $this->render('create', [
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing WorkDemand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
           if (!Yii::$app->user->can('complaintagent'))
      throw new NotFoundHttpException("Not Allowed");
   
         $model = $this->findModel($id);
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post()))
        {
           $model->update_time=time();
            
            $transaction = \Yii::$app->db->beginTransaction();
                 try{
                if ( $model->save())
                {
                   $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                   $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$model->block_code])->one();
                //print_r($designation);
               // exit;
                  $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$model->block_code])->one();
                  if ($designation)
                {
                //($request_id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0)
                   if (Yii::$app->user->isGuest)
                   {
                      $sender=0;
                      $sender->designation_type_id=-100;
                      $sender_name=$model->name_hi;
                      $sender_mobileno=$model->mobileno;
                    }
                   else
                    {
                    $senderdesignation=Designation::getDesignationByUser(Yii::$app->user->id,true);
                    $sender=$senderdesignation->id;
                    $sender_designation_type_id=$senderdesignation->designation_type_id;
                    $sender_name=$senderdesignation->officer_name_en;
                    $sender_mobileno=$senderdesignation->officer_mobile;
                    }
                   $receiver=$designation->id;
                   $receiver_designation_type_id=$designation->designation_type_id;
                   $receiver_name=$designation->name_en;
                   $receiver_mobileno=$designation->officer_mobile;
                   $purpose="For action and report";
                   $canmark=0;
                   $status=WorkDemand::PENDING;
                   $statustarget=WorkDemand::DISPOSED;
                   $deadline=$model->datefrom;
                   $model->markToDesignation($model->id,$sender,$sender_name,$sender_mobileno,$sender_designation_type_id,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,1);
                    }
                    $transaction->commit();
                   $this->redirect(['view','id'=>$model->id]);
            
                
                }
                else {print_r($model->errors);$transaction->rollBack();exit;}
                }
                catch(Exception $e)
                  {
                    $transaction->rollBack();
                  }
        
       }
      
        return $this->render('update', [
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing WorkDemand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function action1Delete($id)
    {
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WorkDemand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkDemand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkDemand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionFilereport($id,$markingid,$returnurl='')
     {
    
        if (!$this->_ismarkedtocurrentuser($id,$markingid) && !Yii::$app->user->can('complaintagent'))
        throw new NotFoundHttpException("Not permitted");
        $marking=Marking::findOne($markingid);
        if (!$marking)
         throw new NotFoundHttpException("Not permitted");
        if (($model = WorkDemand::findOne($id)) !== null) 
        {
          $workdemandreport=WorkdemandReport::find()->where(['work_demand_id'=>$model->id])->one();
           if (!$workdemandreport)
           $workdemandreport=new WorkdemandReport;
           $workdemandreport->work_demand_id=$model->id;
           if ($workdemandreport->load(Yii::$app->request->bodyParams))
           {
           
               $transaction=Yii::$app->db->beginTransaction();
             
           if (!$workdemandreport->save())
           {
             //var_dump($workdemandreport->validators);
             print_r($workdemandreport->errors);
             exit;
             }
           $model->status=1;
           $model->save();
           $marking->status=1;
           $marking->flag=1;
           $marking->save();
           $transaction->commit();
           
              if ($returnurl!='')
                  return $this->redirect($returnurl);
              else if(!Yii::$app->request->isAjax)
               return $this->redirect(['view','id'=>$id]);
               else
                //print "data submitted";
                {
                \Yii::$app->getSession()->setFlash('message', 'Report Submitted!!!');
                }
        }
        else
            if (Yii::$app->request->isAjax)
             return $this->renderAjax('atr',['model'=>$model,'markingid'=>$markingid,'workdemandReport'=>$workdemandreport]);
            else 
            return $this->render('atr',['model'=>$model,'markingid'=>$markingid,'workdemandReport'=>$workdemandreport]);
                
       } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }
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
      public function actionMy($ms=-1,$d=-1,$s=-1,$dcode=null,$bcode=null)
     {
        if (Yii::$app->user->isGuest)
         throw new NotFoundHttpException('Not Found');
        $dp=WorkDemand::count1($ms,$d,$s,false,$dcode,$bcode);
        return $this->render('index1',['dataProvider'=>$dp]);
     
     
     }
protected function _ismarkedtocurrentuser($id,$markingid)
  {
    return Marking::find()->where(['id'=>$markingid,'request_type'=>'workdemand','request_id'=>$id,'receiver'=>\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id)])->one()?true:false;
  
  }
}
