<?php
namespace app\modules\complaint\controllers;

use yii\web\Controller;
use app\modules\mnrega\models\District;
use app\modules\complaint\models\Complaint;
use Yii;

class ReportController extends Controller
{
  public function actionDwise($t='complaint')
   {
        // print_r($status);
         //exit;
         $lang=Yii::$app->language;
         Yii::$app->language='en';
         $counts=[];
         $status=[];
         if ($t=='complaint')
         {
         $q=[];
         $status=Complaint::statusNames();
         foreach ($status as $s1=>$sname)
          {
          $x="SUM(CASE WHEN status=".$s1
          ." THEN 1 ELSE 0 END) AS ".strtolower(str_replace(" ","_",$sname))."_count";
          $q[]=$x;
          }
          $q[]="SUM( 1) AS total";
          $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM complaint inner join district on district.code=complaint.district_code group by dname,dcode order by dname asc";
       //print $query;
       //exit;
       $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
        } else 
        if ($t=='workdemand')
         {
         $q=[];
         $status=Complaint::statusNames();
         foreach ($status as $s1=>$sname)
          {
          $x="SUM(CASE WHEN status=".$s1
          ." THEN 1 ELSE 0 END) AS ".strtolower(str_replace(" ","_",$sname))."_count";
          $q[]=$x;
          }
          $q[]="SUM( 1) AS total";
          $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM workdemand inner join district on district.code=workdemand.district_code group by dname,dcode order by dname asc";
       //print $query;
       //exit;
       $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
        } else 
        if ($t=='jobcarddemand')
         {
         $q=[];
         $status=Complaint::statusNames();
         foreach ($status as $s1=>$sname)
          {
          $x="SUM(CASE WHEN status=".$s1
          ." THEN 1 ELSE 0 END) AS ".strtolower(str_replace(" ","_",$sname))."_count";
          $q[]=$x;
          }
          $q[]="SUM( 1) AS total";
          $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM jobcarddemand inner join district on district.code=jobcarddemand.district_code group by dname,dcode order by dname asc";
       //print $query;
       //exit;
       $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
        }
     return $this->render('dwise',['counts'=> $counts,'status'=>$status,'t'=>$t]);
       
     
   }


}
?>