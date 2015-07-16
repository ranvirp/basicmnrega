<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\JobcardDemandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
 
        if ($model->load(Yii::$app->request->post()))
        {
          
            if ($model->save())
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
    public function actionFilereport($id)
     {
        if (($model = JobcardDemand::findOne($id)) !== null) {
            return $this->render('atr',['model'=>$model]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }
}
