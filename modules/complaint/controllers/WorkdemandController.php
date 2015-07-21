<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\WorkDemandSearch;
use app\modules\complaint\models\WorkDemandReport;
use app\modules\mnrega\models\Marking;



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
        $dataProvider = new ActiveDataProvider([
            'query' => WorkDemand::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
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
 
        if ($model->load(Yii::$app->request->post()))
        {
            $model->create_time=time();
            $model->update_time=time();
            if (Yii::$app->user->isGuest)
            $model->author=0;
            else
            $model->author=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
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
                   $model->markToDesignation($model->id,$designation->id,$model->datefrom);
                   $transaction->commit();
                   $this->redirect(['view','id'=>$model->id]);
                }
                }
                else {print_r($model->errors);exit;}
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
        public function action1Update($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        
            if ($model->save())
            $model = new WorkDemand();; //reset model
        }
 
       $searchModel = new WorkDemandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    public function actionFilereport($id,$returnurl='')
     {
        if (($model = WorkDemand::findOne($id)) !== null) {
          $workdemandreport=WorkDemandReport::find()->where(['work_demand_id'=>$model->id])->one();
           if (!$workdemandreport)
           $workdemandreport=new WorkDemandReport;
           $workdemandreport->work_demand_id=$model->id;
           $workdemandreport->load(Yii::$app->request->post());
           if ($workdemandreport->save())
            {
              Marking::setStatus('workdemand',$model->id,1);
           
              if ($returnurl!='')
                  return $this->redirect($returnurl);
              else 
               
                \Yii::$app->getSession()->setFlash('message', 'Report Submitted!!!');
             }
              else
                      \Yii::$app->getSession()->setFlash('message', 'Error in submitting form');
          
            return $this->render('atr',['model'=>$model,'workdemandReport'=>$workdemandreport]);
                }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }
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
      public function actionMy()
     {
        $query = new Query;
	    $query  ->select('workdemand.id as id,workdemand.name_hi as cname,fname,mobileno,address,district.name_en as dname,block.name_en as bname,panchayat,
	    ') 
	        ->from('workdemand')
	        ->join(  'RIGHT JOIN',
	                'marking',
	                'marking.request_id =workdemand.id and marking.request_type=\'workdemand\' and marking.status=0'
	            )
	           ->join(  'INNER JOIN',
	                'district',
	                'district.code =workdemand.district_code'
	            ) 
	             ->join(  'INNER JOIN',
	                'block',
	                'block.code =workdemand.block_code'
	            );
    $d=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);

	if (!Yii::$app->user->can('complaintviewall'))
       $query->where(['receiver'=>$d]);
        $dp= new ActiveDataProvider([
         'query' => $query,
         'pagination' => [
            'pageSize' => 20,
          ],
        ]);
        return $this->render('index1',['dataProvider'=>$dp]);
     
     
     }
}
