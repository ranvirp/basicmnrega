<?php

namespace app\modules\mnrega\controllers;

use Yii;
use app\common\Utility;
use app\modules\mnrega\models\Parameter;
use app\modules\mnrega\models\ParameterParse;

use app\modules\mnrega\models\ParameterSearch;
use app\modules\mnrega\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * ParameterController implements the CRUD actions for Parameter model.
 */
class ParameterController extends \yii\web\Controller
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
     * Lists all Parameter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParameterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>new \app\modules\mnrega\models\Parameter        ]);
    }

    /**
     * Displays a single Parameter model.
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
     * Creates a new Parameter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
       
       
        $model = new Parameter();
 
        if ($model->load(Yii::$app->request->post()))
        {
           if (array_key_exists('app\modules\mnrega\models\Parameter',Utility::rules()))
            foreach ($model->attributes as $attribute)
            if (Utility::rules('app\modules\mnrega\models\Parameter') && array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\Parameter']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\Parameter'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Parameter();; //reset model
        }
 
        $searchModel = new ParameterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }

    /**
     * Updates an existing Parameter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
        public function actionUpdate($id)
    {
         $model = $this->findModel($id);
       
 
        if ($model->load(Yii::$app->request->post()))
        {
        if (array_key_exists('app\modules\mnrega\models\Parameter',Utility::rules()))
           
            foreach ($model->attributes as $attribute)
            if (array_key_exists($attribute,Utility::rules()['app\modules\mnrega\models\Parameter']))
            $model->validators->append(
               \yii\validators\Validator::createValidator('required', $model, Utility::rules()['app\modules\mnrega\models\Parameter'][$model->$attribute]['required'])
            );
            if ($model->save())
            $model = new Parameter();; //reset model
        }
 
       $searchModel = new ParameterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            
        ]);

    }
    /**
     * Deletes an existing Parameter model.
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
     * Finds the Parameter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parameter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parameter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionPopulate($p,$l,$d=0)
    {
       
       $dnew=$d;
        if ($d!=0)
         {
           $district=\app\modules\mnrega\models\District::findOne($d);
           if ($district) $dnew=$district->district_name;
         }
         if (($l==2) && ($dnew==0)) 
       {
         print "you must specify district_code as parameter d if level=2";
         return;
       }
        $model=Parameter::findOne($p);
        $link=$model->link;
        $data=file_get_contents($link);
        if ($data==false)
        {
          print "Error fetching data...aborting\n";
          return;
        }
        
        switch($model->shortcode)
        {
        case 'mandays':
         $tableid=4;
         $rowstoskip=4;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=[2*$m+$colwithnames,2*$m+$colwithnames-1];
        break;
        case 'musteroll':
         $tableid=3;
         $rowstoskip=3;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=[2,3];
        break;
        case 'workcategory':
         $tableid=2;
         $rowstoskip=3;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=range(2,55);
        break;
        case 'test':
         $tableid=3;
         $rowstoskip=3;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=[2,3];
        break;
        case 'houses':
         $tableid=1;
         $rowstoskip=2;
        
         $colwithnames=1;
         $level=0;
         $colwithvalues=range(2,8);
        break;
        case 'empstatus':
         $tableid=5;
         $rowstoskip=6;
        
         $colwithnames=1;
         $level=0;
         $colwithvalues=range(2,18);
        break;
        default:
        break;
        }
          $x=[];
          $utility=new \app\modules\mnrega\Utility;
          $result=$utility->parseTable($link,$tableid,$rowstoskip,$colwithnames,$colwithvalues,$x,$l,$dnew);
       var_dump($result);
       $pp=ParameterParse::find()->where(['parameter_id'=>$p,'level'=>$l,'district_code'=>$d])->one();
 if (!$pp) $pp=new ParameterParse;
 $pp->update_time=time();
 $pp->json_value=json_encode($result);
 $pp->parameter_id=$p;
 $pp->district_code=$d;
 //$pp->dld_data=$data;
 $pp->level=$l;
 if (!$pp->save())
   print_r($pp->errors);
//else
  // $pp->updateTable();
        
    
    
   
    
    }
    public function actionDisplay($id)
    {
      $model=ParameterParse::findOne($id);
      //$model->updateTable();
      if (!$model)
        print "Id wrong\n";
        else {
        
        if ($model->parameter->shortcode=='mandays')
        return $this->render('_display',['model'=>$model,'result'=>
        Json::decode($model->json_value,true)]);
        else
         return $this->render('_displaygeneral',['model'=>$model,'result'=>Json::decode($model->json_value,true)]);
      
      }
    }
    public function actionGenworkpage($cat,$level)
     {
       unset($this->layout);
       $works=new \app\modules\mnrega\models\Works;
       switch($cat)
       {
         case 'housing':
           $page='B';
           $rcode='B';
           $rsubcode='4';
           $rsec_code='W09';
           $fin_year='2015-2016';
           return $works->genWorkCategoriesPage($fin_year,$level);
         break;
         default:
         break;
       
       }
     
     
     }
}
