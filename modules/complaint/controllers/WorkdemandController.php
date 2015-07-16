<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\WorkDemandSearch;


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
            if ($model->save())
            {
            $model = new WorkDemand(); //reset model
            }
            else 
            {
             print_r($model->errors);
             }
        }
 
        $searchModel = new WorkDemandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('create', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    public function actionDelete($id)
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
    public function actionFilereport($id)
     {
        if (($model = WorkDemand::findOne($id)) !== null) {
            return $this->render('atr',['model'=>$model]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }
}
