<?php
use yii\web\Controller;
use app\modules\mnrega\models\District;
use Yii;

public class ReportController extends Controller
{
  public function actionDistrictwise($t='complaint')
   {
      $districts=District::find()->all();
      foreach ($districts as $district)
        {
        // print_r($status);
         //exit;
         foreach ($status as $s1)
          {
          $x="SUM(CASE WHEN status=".$s1." and request_type='".$tc."'";
          if ($d!=-1) $x.="and receiver=".$d;
          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count"."_".$s1;
          }
          $x="SUM(CASE WHEN request_type='".$tc."'";
           if ($d!=-1) $x.="and receiver=".$d;

          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count";
         
        }
   
     $query="SELECT ".implode(",",$q)." FROM marking";
        $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
   }


}
?>