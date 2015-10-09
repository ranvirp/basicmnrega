<?php

namespace app\modules\mnrega\controllers;

use Yii;
use app\common\Utility;
use app\modules\mnrega\models\ParameterTarget;
use app\modules\mnrega\models\ParameterTargetSearch;
use app\modules\mnrega\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ParameterTargetController implements the CRUD actions for ParameterTarget model.
 */
class ParameterTargetController extends Controller
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
     * Lists all ParameterTarget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParameterTargetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\mnrega\models\ParameterTarget        ]);
    }

    /**
     * Displays a single ParameterTarget model.
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
     * Creates a new ParameterTarget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new ParameterTarget();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\mnrega\models\ParameterTarget',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\mnrega\models\ParameterTarget') && array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\ParameterTarget']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\ParameterTarget'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new ParameterTarget();; //reset model
        }
 
        $searchModel = new ParameterTargetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing ParameterTarget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\mnrega\models\ParameterTarget',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\ParameterTarget']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\ParameterTarget'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new ParameterTarget();; //reset model
        }
 
       $searchModel = new ParameterTargetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing ParameterTarget model.
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
     * Finds the ParameterTarget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ParameterTarget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ParameterTarget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
