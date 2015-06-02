<?php

namespace app\modules\taxonomy\controllers;

use Yii;
use app\common\Utility;
use app\modules\taxonomy\models\Taggable;
use app\modules\taxonomy\models\TaggableSearch;
use app\modules\taxonomy\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaggableController implements the CRUD actions for Taggable model.
 */
class TaggableController extends Controller
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
     * Lists all Taggable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaggableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\taxonomy\models\Taggable        ]);
    }

    /**
     * Displays a single Taggable model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Taggable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new Taggable();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\taxonomy\models\Taggable',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\taxonomy\models\Taggable') && array_key_exists($attribute,Utility::rules()['app\modules\taxonomy\models\Taggable']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\taxonomy\models\Taggable'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Taggable();; //reset model
        }
 
        $searchModel = new TaggableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing Taggable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\taxonomy\models\Taggable',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\taxonomy\models\Taggable']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\taxonomy\models\Taggable'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Taggable();; //reset model
        }
 
       $searchModel = new TaggableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing Taggable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Taggable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Taggable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taggable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
