<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\JobcardDemandSearch;
use app\modules\complaint\models\JobcardDemandReport;
use app\modules\mnrega\models\Marking;
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
        $searchModel = new JobcardDemandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\complaint\models\JobcardDemand        ]);
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
                if ($designtion)
                {
                   $model->markToDesignation($designation->id);
                   $transaction->commit();
                   $this->redirect('view',['id'=>$model->id]);
                }
                else 
                  {
                    $transaction->rollBack();
                  }
             $model = new JobcardDemand();; //reset model
            
           }
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
        public function action1Update($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        
            if ($model->save())
            $model = new JobcardDemand();; //reset model
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
    public function actionDelete($id)
    {
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
    public function actionFilereport($id,$returnurl='')
     {
       if (!Yii::$app->user->can('jobcarddemandfilereport'))
        throw new \yii\web\ForbiddenHttpException('Not allowed!!!');
       if (($model = JobcardDemand::findOne($id)) !== null) {
          $jobcarddemandreport=JobcardDemandReport::find()->where(['jobcarddemand_id'=>$model->id])->one();
           if (!$jobcarddemandreport)
           $jobcarddemandreport=new JobcardDemandReport;
           $jobcarddemandreport->jobcarddemand_id=$model->id;
         if( Yii::$app->request->post() && $jobcarddemandreport->load(Yii::$app->request->post()) && $jobcarddemandreport->save())
         {
           Marking::setStatus('jobcarddemand',$model->id,1);
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
  public function actionMy()
     {
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