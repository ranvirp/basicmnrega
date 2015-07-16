<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\Complaint_subtype;
use app\modules\complaint\models\Complaint_subtypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * Complaint_subtypeController implements the CRUD actions for Complaint_subtype model.
 */
class Complaint_subtypeController extends Controller
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
     * Lists all Complaint_subtype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Complaint_subtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\complaint\models\Complaint_subtype        ]);
    }

    /**
     * Displays a single Complaint_subtype model.
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
     * Creates a new Complaint_subtype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new Complaint_subtype();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\complaint\models\Complaint_subtype',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\complaint\models\Complaint_subtype') && array_key_exists($attribute,Utility::rules()['app\modules\complaint\models\Complaint_subtype']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\complaint\models\Complaint_subtype'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Complaint_subtype();; //reset model
        }
 
        $searchModel = new Complaint_subtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing Complaint_subtype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\complaint\models\Complaint_subtype',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\complaint\models\Complaint_subtype']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\complaint\models\Complaint_subtype'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Complaint_subtype();; //reset model
        }
 
       $searchModel = new Complaint_subtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing Complaint_subtype model.
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
     * Finds the Complaint_subtype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Complaint_subtype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complaint_subtype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGet($code)
    {
      return json_encode(ArrayHelper::map(Complaint_subtype::find()->where(['complaint_type_code'=>$code])->asArray()->all(),'shortcode','name_hi'));
    }
}
