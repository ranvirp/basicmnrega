<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\JobcardDemandSearch;
use app\modules\complaint\models\JobcarddemandReport;
use app\modules\mnrega\models\Marking;
use app\modules\users\models\Designation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * JobcarddemandController implements the CRUD actions for JobcardDemand model.
 */
class JobcarddemandController extends Controller
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
     * Lists all JobcardDemand models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('complaintagent'))
      throw new NotFoundHttpException("Not Allowed");
   
        $searchModel = new JobcardDemandSearch();
        $dcode = Yii::$app->request->get('dcode');
		if ($dcode!=null && $dcode!=-1 )
			$searchModel->district_code = $dcode;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
            'model'=>null    
            ]);
    }

    /**
     * Displays a single JobcardDemand model.
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
     * Creates a new JobcardDemand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new JobcardDemand();
        $model->status=JobcardDemand::PENDING;
         if (Yii::$app->user->isGuest)
            $model->scenario='guestentry';//captcha validation
  
        $transaction = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->create_time=time();
            $model->update_time=time();
            if (Yii::$app->user->isGuest)
            $model->author=0;
            else
            $model->author=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
          
            if ($model->save())
            {
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
                   $status=JobcardDemand::PENDING;
                   $statustarget=JobcardDemand::DISPOSED;
                   $model->markToDesignation($model->id,$sender,$sender_name,$sender_mobileno,$sender_designation_type_id,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0);
                    }
                    $transaction->commit();
                   $this->redirect(['view','id'=>$model->id]);
                }
                else 
                  {
                    $transaction->rollBack();
                  }
             $model = new JobcardDemand();; //reset model
            
           }
        
 
     
        return $this->render('create', [
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing JobcardDemand model.
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
                   $status=JobcardDemand::PENDING;
                   $statustarget=JobcardDemand::DISPOSED;
                   $model->markToDesignation($model->id,$sender,$sender_name,$sender_mobileno,$sender_designation_type_id,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0);
                    }
                    $transaction->commit();
                   $this->redirect(['view','id'=>$model->id]);
                }
                
                
                else {print_r($model->errors); $transaction->rollBack();exit;}
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
     * Deletes an existing JobcardDemand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function action1Delete($id)
    {
       if (!Yii::$app->user->can('complaintagent'))
      throw new NotFoundHttpException("Not Allowed");
   
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobcardDemand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobcardDemand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobcardDemand::findOne($id)) !== null) {
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
          throw new NotFoundHttpException('The requested page does not exist.wrong markingid');
    if (($model = JobcardDemand::findOne($id)) !== null) {
          $jobcarddemandreport=JobcardDemandReport::find()->where(['jobcarddemand_id'=>$model->id])->one();
           if (!$jobcarddemandreport)
           $jobcarddemandreport=new JobcardDemandReport;
           $jobcarddemandreport->jobcarddemand_id=$model->id;
         if( Yii::$app->request->post() && $jobcarddemandreport->load(Yii::$app->request->post()))
         {
          $transaction=Yii::$app->db->beginTransaction();
           $jobcarddemandreport->save();
           $model->status=JobcardDemand::DISPOSED;
           $model->save();
           $marking->status=JobcardDemand::DISPOSED;
           $marking->flag=1;
           $marking->save();
           $transaction->commit();
           if ($returnurl!='')
            return $this->redirect($returnurl);
          else
              return $this->render('atr',['model'=>$model,'jobcarddemandReport'=>$jobcarddemandreport]);
         }
           return $this->render('atr',['model'=>$model,'jobcarddemandReport'=>$jobcarddemandreport]); 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }
  public function actionMy($ms=-1,$d=-1,$s=-1,$dcode=null,$bcode=null)
     {
     /*
        $query = new Query;
	    $query  ->select('jobcarddemand.id as id,jobcarddemand.name_hi as cname,fname,mobileno,address,district.name_en as dname,block.name_en as bname,panchayat,
	    ') 
	        ->from('jobcarddemand')
	        ->join(  'RIGHT JOIN',
	                'marking',
	                'marking.request_id =jobcarddemand.id and marking.request_type=\'jobcarddemand\' and marking.status=0'
	            )
	           ->join(  'INNER JOIN',
	                'district',
	                'district.code =jobcarddemand.district_code'
	            ) 
	             ->join(  'INNER JOIN',
	                'block',
	                'block.code =jobcarddemand.block_code'
	            );
	 if ($ms==-2)
        $query->where(['marking.status'=>null]);
     else
        $query->where(['marking.status'=>$ms]);
    if ($s!=-1)
      $query->andWhere(['workdemand.status'=>$s]);
	if (($d==-1) && (!Yii::$app->user->can('complaintadmin')))
	  {
	   $d=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
   
       $query->andWhere(['receiver'=>$d]);
       }
       else if (Yii::$app->user->can('complaintadmin'))
        $query->andWhere(['receiver'=>$d]);
        $dp= new ActiveDataProvider([
         'query' => $query,
         'pagination' => [
            'pageSize' => 20,
          ],
        ]);
        */
        if (Yii::$app->user->isGuest)
           throw new NotFoundHttpException("Not Allowed");
        $dp=JobcardDemand::count1($ms,$d,$s,false,$dcode,$bcode);
        return $this->render('index1',['dataProvider'=>$dp]);
     
     
     }
     protected function _ismarkedtocurrentuser($id,$markingid)
  {
    return Marking::find()->where(['id'=>$markingid,'request_type'=>'jobcarddemand','request_id'=>$id,'receiver'=>\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id)])->one()?true:false;
  
  }
}
