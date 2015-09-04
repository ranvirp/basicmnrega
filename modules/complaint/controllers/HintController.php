<?php
namespace app\modules\complaint\controllers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class HintController extends Controller
{
  public function actionHint($t="hints")
  {
 //   if (!Yii::$app->user->can('complaintadmin'))
   //   throw new NotFoundHttpException("Not Found page");
    $hints=include Yii::getAlias("@app/messages/hi/$t.php");
   
      if (Yii::$app->request->post())
      {
    $hint_names=Yii::$app->request->post('hint_names');
    $hint_values=Yii::$app->request->post('hint_values');
    foreach ($hint_names as $i=>$hint_name)
    {
      $hints[$hint_name]=$hint_values[$i];
    
    }
    $y='<?php'."\n".'return ['."\n";
    foreach ($hints as $name=>$value)
    {
      $y.="\n'".$name."'=>'".$value."',\n";
    
    }
    $y.="\n];";
    file_put_contents(Yii::getAlias("@app/messages/hi/$t.php"),$y);
    }
    return $this->render('hint',['hints'=>$hints]);
  
  }

}