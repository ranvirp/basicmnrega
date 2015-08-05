<?php

namespace app\modules\complaint\controllers;

use Yii;
use app\common\Utility;
use app\modules\complaint\models\ComplaintReply;
use app\modules\complaint\models\ComplaintReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComplaintReplyController implements the CRUD actions for ComplaintReply model.
 */
class ComplaintreplyController extends Controller
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
     * Lists all ComplaintReply models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new ComplaintReplySearch();
        $searchModel->complaint_id=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        $dataProvider->query=$dataProvider->query->orderBy('created_at desc');
        return $this->renderPartial('../complaint/replygridview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>null      ]);
    }

    /**
     * Displays a single ComplaintReply model.
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
     * Creates a new ComplaintReply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new ComplaintReply();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\complaint\models\ComplaintReply',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\complaint\models\ComplaintReply') && array_key_exists($attribute,Utility::rules()['app\modules\complaint\models\ComplaintReply']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\complaint\models\ComplaintReply'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new ComplaintReply();; //reset model
        }
 
        $searchModel = new ComplaintReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing ComplaintReply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\complaint\models\ComplaintReply',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\complaint\models\ComplaintReply']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\complaint\models\ComplaintReply'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new ComplaintReply();; //reset model
        }
 
       $searchModel = new ComplaintReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing ComplaintReply model.
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
     * Finds the ComplaintReply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComplaintReply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComplaintReply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
