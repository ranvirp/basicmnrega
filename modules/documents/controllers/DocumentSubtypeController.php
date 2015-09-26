<?php

namespace app\modules\documents\controllers;

use Yii;
use app\common\Utility;
use app\modules\documents\models\DocumentSubtype;
use app\modules\documents\models\DocumentSubtypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\helpers\ArrayHelper;

/**
 * DocumentSubtypeController implements the CRUD actions for DocumentSubtype model.
 */
class DocumentSubtypeController extends Controller
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
     * Lists all DocumentSubtype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSubtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\documents\models\DocumentSubtype        ]);
    }

    /**
     * Displays a single DocumentSubtype model.
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
     * Creates a new DocumentSubtype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new DocumentSubtype();
 
        if ($model->load(Yii::$app->request->post()))
        {
          
            if ($model->save())
            $model = new DocumentSubtype();; //reset model
        }
 
        $searchModel = new DocumentSubtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing DocumentSubtype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\documents\models\DocumentSubtype',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\documents\models\DocumentSubtype']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\documents\models\DocumentSubtype'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new DocumentSubtype();; //reset model
        }
 
       $searchModel = new DocumentSubtypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing DocumentSubtype model.
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
     * Finds the DocumentSubtype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DocumentSubtype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentSubtype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionGet($code)
    {
      return json_encode(ArrayHelper::map(DocumentSubtype::find()->where(['document_type_code'=>$code])->asArray()->all(),'shortcode','name_hi'));
    }
}
