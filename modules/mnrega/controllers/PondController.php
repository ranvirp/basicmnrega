<?php

namespace app\modules\mnrega\controllers;

use Yii;
use app\common\Utility;
use app\modules\mnrega\models\Pond;
use app\modules\mnrega\models\PondSearch;
use app\modules\mnrega\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PondController implements the CRUD actions for Pond model.
 */
class PondController extends Controller
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
     * Lists all Pond models with unsatisfactory rating.
     * @return mixed
     */
    public function actionIndex1($rating=WorkRating::UNSATISFACTORY)
    {
        $searchModel = new PondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\mnrega\models\Pond        ]);
    }
/**
     * Lists all Pond models.
     * @return mixed
     */
    public function actionIndex2()
    {
        $searchModel = new PondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\mnrega\models\Pond        ]);
    }
    /**
     * Lists all Pond models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $designation=\app\modules\users\models\Designation::find()->
        where(['officer_userid'=>Yii::$app->user->id])->one();
         $dataProvider->query=$dataProvider->query->andFilterWhere(['district_code'=>$designation->level->code])->orderBy('created_at desc');
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\mnrega\models\Pond        ]);
    }

    /**
     * Displays a single Pond model.
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
     * Creates a new Pond model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new Pond();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\mnrega\models\Pond',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\mnrega\models\Pond') && array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\Pond']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\Pond'][$model->$attribute]['required'])
            );
            $model->created_at=time();
            $model->created_by=Yii::$app->user->id;
            $model->updated_at=time();
            $model->updated_by=Yii::$app->user->id;
            
            
            if ($model->save())
            $model = new Pond();; //reset model
        }
 
        $searchModel = new PondSearch();
        $designation=\app\modules\users\models\Designation::find()->
        where(['officer_userid'=>Yii::$app->user->id])->one();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query=$dataProvider->query->where(['district_code'=>$designation->level->code])->orderBy('created_at desc');
        $dataProvider->pagination->pageSize=1;
        return $this->render('create', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing Pond model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\mnrega\models\Pond',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\Pond']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\Pond'][$model->$attribute]['required'])
            );
            $model->updated_at=time();
            $model->updated_by=Yii::$app->user->id;
            if ($model->save())
            $model = new Pond();; //reset model
        }
 
       $searchModel = new PondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  $dataProvider->query=$dataProvider->query->orderBy('updated_at desc');
        $dataProvider->pagination->pageSize=1;
       
        return $this->render('update', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing Pond model.
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
     * Finds the Pond model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pond the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pond::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionPhotosbywork($workid)
    {
     $photos=\app\modules\gpsphoto\models\Photo::find()->where(['bwid'=>$workid])->orderBy('created_at desc')->limit(10)->all();
     
     return $this->render('photos',['photos'=>$photos]);
    
    }
    public function actionPhotosbydist($d)
    {
     $photos=\app\modules\gpsphoto\models\Photo::find()->where(['district'=>strtoupper($d)])->orderBy('created_at desc')->limit(10)->all();
     
     return $this->render('photos',['photos'=>$photos]);
    
    }
    public function actionTitle($workid)
    {
      $pond= Pond::findOne($workid);
      if ($pond)
        print $pond->name_hi.'<br><small><b>Panchayat </b>'.$pond->panchayat.'<b> Block </b>'.$pond->block.'<b> District </b>'.$pond->district;
    }
}
