<?php

namespace app\modules\formats\controllers;

use Yii;
use app\common\Utility;
use app\modules\formats\models\Format;
use app\modules\formats\models\FormatValues;

use app\modules\formats\models\FormatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormatController implements the CRUD actions for Format model.
 */
class FormatController extends Controller
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
     * Lists all Format models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\formats\models\Format        ]);
    }

    /**
     * Displays a single Format model.
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
     * Creates a new Format model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new Format();
        
       
        if ($model->load(Yii::$app->request->post()))
        {
          $model->name=self::labeltoname($model->label_en);
          $model->keyvalue=Yii::$app->request->post('keyvalue');
          $label_en=Yii::$app->request->post('label_en');
          $label_hi=Yii::$app->request->post('label_hi');
          $type=Yii::$app->request->post('type');
          $dropdown=Yii::$app->request->post('dropdown');
          $calculated=Yii::$app->request->post('calculated');
          $noofp=Yii::$app->request->post('noofp');
          $key=Yii::$app->request->post('keyvalue');
          print_r($type);
          //exit;
          $parameters=[];

          if (is_numeric($noofp))
          {
            for ($i=1;$i<=$noofp;$i++)
            {
             $x=[];
             $x['label_hi']=$label_hi[$i];
             $x['label_en']=$label_hi[$i];
             $x['type']=$type[$i];
             if ($dropdown && array_key_exists($i,$dropdown))
             {
                $x['dropdown']=$dropdown[$i];
             }
             if ($calculated && array_key_exists($i,$calculated))
             {
                $x['calculated']=$calculated[$i];
             }
             $parameters[$i]=$x;
            }
            print_r($parameters);
            $model->parameters=json_encode($parameters);
            $model->calcparameters='';
          }
           
        
        
        
            if ($model->save())
            $model = new Format();; //reset model
        }
        
        return $this->render('create', [
            'model' => $model,
            
        ]);

    }

    public function actionForm($id)
    {
        $format=Format::findOne($id);
        if ($format)
            return $this->render('formatform',['form'=>$format->renderForm()]);
        else
            print "Not found";
    }

    public function actionPost()
    {
        $postarray=Yii::$app->request->post();
        $id=Yii::$app->request->post('id');
        $format=Format::findOne($id);
        $format->entervalues($postarray);
        if ($format)
            return $this->render('formatform',['form'=>$format->renderForm()]);
        else
            print "Not found";
        
    }

    /**
     * Updates an existing Format model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\formats\models\Format',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\formats\models\Format']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\formats\models\Format'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Format();; //reset model
        }
 
       $searchModel = new FormatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    public function actionReport($id,$month)
    {
        $format=Format::findOne($id);
        $formatvalues=FormatValues::find()->where(['month'=>$month,'format_id'=>$id])->all();
      return  $this->render('formatreport',['format'=>$format,'formatvalues'=>$formatvalues]);
    }
    /**
     * Deletes an existing Format model.
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
     * Finds the Format model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Format the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Format::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public static function labeltoname($label)
    {
        $name=strtolower($label);
        $name=str_replace(" ", "_", $name);
        return $name;
    }
}
