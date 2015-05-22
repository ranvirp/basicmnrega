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
class ParameterController extends Controller
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
       if (($l==2) && ($d==0)) 
       {
         print "you must specify district_code as parameter d if level=2";
         return;
       }
        if ($d!=0)
         {
           $district=\app\modules\mnrega\models\District::findOne($d);
           if ($district) $d=$district->district_name;
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
         $tableid='t1';
         $rowstoskip=4;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=[2*$m+$colwithnames,2*$m+$colwithnames-1];
        break;
        default:
        break;
        }
          $x=[];
          $utility=new \app\modules\mnrega\Utility;
          $result=$utility->parseTable($link,$tableid,$rowstoskip,$colwithnames,$colwithvalues,$x,$l,$d);
        $pp=ParameterParse::find()->where(['parameter_id'=>$p,'level'=>$level])->one();
 if (!$pp) $pp=new ParameterParse;
 $pp->update_time=time();
 $pp->json_value=json_encode($result);
 $pp->parameter_id=$p;
 //$pp->dld_data=$data;
 $pp->level=$l;
 if (!$pp->save())
   print_r($pp->errors);
//else
  // $pp->updateTable();
        
    
    }
    public function action1Populate($p)
    {
       $model=Parameter::findOne($p);
       $link=$model->link;
       print $link;
       //$link="http://164.100.129.6/netnrega/projected_VS_generated.aspx?file1=empprov&page1=s&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=CgyzEo8dpRYpwcFbitdqJg";
      // $link="http://localhost/basicmnrega/web/images/page1.html";
      
       $data=file_get_contents($link);
       if ($data==false)
        {
          print "Error fetching data...aborting\n";
          return;
        }
       
     print $model->shortcode;  
    switch($model->shortcode)
    {
    case 'mandays':
    print "processing for mandays";
     $result=[];
        try{
       $dom = new domDocument;

       @$dom->loadHTML($data);
       $dom->preserveWhiteSpace = false;
       $table = $dom->getElementById('t1');

       $rows = $table->getElementsByTagName('tr');
      $i=0;
       $m=date('m');
       $y=date('Y');
       if ($y==2016) $m=$m+12;
       $m=$m-3;
       foreach ($rows as $row) {
       if ($i<4) {$i++;continue;}
        $col = $row->getElementsByTagName('td');
        
        
        for ($j=1;$j<=$m;$j++)
        {
        
          //AGRA april->achievement, percentage may achievement,percentage
          if ($col[1] && $col[1+2*$j] && $col[2*$j])
          {
            $result[$col[1]->nodeValue][$j]['mandays']=$col[1+2*$j]->nodeValue;
            $result[$col[1]->nodeValue][$j]['target']=$col[2*$j]->nodeValue;
            $req=$col[2*$j]->nodeValue;
              $per=0;
         
          if ($req!=0)
          
             $per=$col[1+2*$j]->nodeValue/$req*100;
           $result[$col[1]->nodeValue][$j]['per']=$per;
          }
          }
          
    $i++;
}
}catch(Exception $e)
{
 print_r($e);
 }
 //var_dump($result);
 $pp=ParameterParse::find()->where(['parameter_id'=>$p,'level'=>$level]);
 if (!$pp) $pp=new ParameterParse;
 $pp->update_time=time();
 $pp->json_value=json_encode($result);
 $pp->parameter_id=$p;
 $pp->dld_data=$data;
 if (!$pp->save())
   print_r($pp->errors);
else
   $pp->updateTable();
 break;
 default:
 break;
 
}
    
    }
    public function actionDisplay($id)
    {
      $model=ParameterParse::findOne($id);
      //$model->updateTable();
     // print "Value at ".date('d/m/Y i:H',$model->update_time);
      return $this->render('_display',['result'=>Json::decode($model->json_value,true)]);
    }
}
