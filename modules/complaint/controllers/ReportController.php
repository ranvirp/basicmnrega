<?php
namespace app\modules\complaint\controllers;

use yii\web\Controller;
use app\modules\mnrega\models\District;
use app\modules\users\models\DesignationType;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintSearch;

use app\modules\complaint\models\WorkDemand;

use app\modules\complaint\models\JobcardDemand;

use Yii;

class ReportController extends Controller
{
 public function actionDesignationtypewise()
 {
   $sources=Complaint::source();
   $q=[];
   $q1=[];
   $q2=[];
   $t='complaint';
   foreach ($sources as $code=>$source)
   {
   
    $x="SUM(CASE WHEN source='".$code
          ."' THEN 1 ELSE 0 END) AS ".'source_'.$code."_count";
    $q1[]='source_'.$code."_count";
    $q[]=$x;
   
   }
     $q[]="SUM( 1) AS total";
     $q1[]='total';
     $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM complaint left join district on district.code=complaint.district_code group by dname,dcode order by dname asc";
      $queryhead="SELECT dname,dcode,".implode(",",$q1)." FROM (".$query.") x"." UNION ALL ".
                "SELECT 'TOTAL' as dname, '-1' as dcode,".implode(",",$q)." FROM complaint";
    $db=Yii::$app->db;
    $counts= $db->createCommand($queryhead)->queryAll();  
    return $this->render('sourcewise',['counts'=> $counts,'source'=>$sources,'t'=>'complaint']);
 }
 public function actionSourcewise()
 {
   $sources=Complaint::source();
   $q=[];
   $q1=[];
   $q2=[];
   $t='complaint';
   foreach ($sources as $code=>$source)
   {
   
    $x="SUM(CASE WHEN source='".$code
          ."' THEN 1 ELSE 0 END) AS ".'source_'.$code."_count";
    $q1[]='source_'.$code."_count";
    $q[]=$x;
   
   }
     $q[]="SUM( 1) AS total";
     $q1[]='total';
     $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM complaint left join district on district.code=complaint.district_code group by dname,dcode order by dname asc";
      $queryhead="SELECT dname,dcode,".implode(",",$q1)." FROM (".$query.") x"." UNION ALL ".
                "SELECT 'TOTAL' as dname, '-1' as dcode,".implode(",",$q)." FROM complaint";
    $db=Yii::$app->db;
    $counts= $db->createCommand($queryhead)->queryAll();  
    return $this->render('sourcewise',['counts'=> $counts,'source'=>$sources,'t'=>'complaint']);
 }
  public function actionDwise($t='complaint',$source='',$desgn='')
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
          $x="SUM(CASE WHEN status=".$s1;
          
          if ($source!='')
           $x.=" AND source='".$source."'";
         if ($desgn!='')
         $x.=" AND marking.receiver_designation_type_id=".$desgn;
          $x.=" THEN 1 ELSE 0 END) AS ".'status_'.$s1."_count";
          $q[]=$x;
          $q1[]='status_'.$s1."_count";
          }
          if ($source=='')
          $q[]="SUM(1) AS total";
          else
          if ($desgn=='')
          $q[]="SUM(case when source='".$source."' THEN 1 else 0 end) AS total";
          else
           $q[]="SUM(case when source='".$source."' AND marking.receiver_designation_type_id=".$desgn." THEN 1 else 0 end) AS total";
          $q1[]='total';
          $query="SELECT district.name_en as dname,".$t.".district_code as dcode,".implode(",",$q)." FROM complaint left join marking on (marking.id=complaint.enqrofficer or marking.id=complaint.atrofficer) left join district on district.code=complaint.district_code group by dname,dcode order by dname asc";
         $queryhead="SELECT dname,dcode,".implode(",",$q1)." FROM (".$query.") x"." UNION ALL ".
                "SELECT 'TOTAL' as dname, '-1' as dcode,".implode(",",$q)." FROM complaint";
          
      //print $query;
       //exit;
       $db=Yii::$app->db;
        $counts= $db->createCommand($queryhead)->queryAll();
        } else 
        if ($t=='workdemand')
         {
         $q=[];
         //$status=[0=>'pending',1=>'disposed',2=>'reported'];
         $status=WorkDemand::statusNames();
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
         $status=JobcardDemand::statusNames();
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
    if (Yii::$app->request->isAjax)
     return $this->renderPartial('dwise',['counts'=> $counts,'status'=>$status,'t'=>$t,'sourceselected'=>$source]);
    else
     return $this->render('dwise',['counts'=> $counts,'status'=>$status,'t'=>$t,'sourceselected'=>$source]);
       
     
   }
   public function actionDwise1()
   {
    return $this->render('wrapper',['sourceselected'=>'-5']);
   }
   public function actionPdf()
   {
     $html=Yii::$app->request->post('html');
     //print $html;
     //exit;
     $stylesheet='<style>'.file_get_contents(Yii::getAlias('@bower/bootstrap/dist/css/bootstrap.css')).'</style>';
     $mdf = new \mPDF();
    $mdf->useAdobeCJK = true;		// Default setting in config.php
						// You can set this to false if you have defined other CJK fonts

     //$mdf->SetAutoFont(AUTOFONT_ALL);
     ob_clean();
     ob_start();
     $mdf->setFooter('{PAGENO}');
     $mdf->WriteHTML($stylesheet,1);
     $mdf->WriteHTML($html,2);
     ob_get_clean();
     $mdf->Output();
     /*
        if (!is_dir($outdir.'/ld/'))
        mkdir($outdir.'/ld/');
        $mdf->Output($outdir.'/ld/'.$officerassigned.".pdf");
        */
   
   }

public function actionCmypdf($ms=-1,$d=-1,$s=-1,$dcode=null,$bcode=null)
     {
        
         if (Yii::$app->user->isGuest)
           throw new NotFoundHttpException("Not Allowed");
                  Yii::$app->response->format = 'pdf';
/*
        // Rotate the page
          Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'format' => [216, 356], // Legal page size in mm
            'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
            'beforeRender' => function($mpdf, $data) {},
            ]);
*/
        $this->layout = '//print';
        
       //$complaintSearch= new ComplaintSearch;
        // $complaintSearch->load(Yii::$app->request->get());
         //$searchModel=[];
         //$searchModel['id']=$complaintSearch->id;
         $statuses=Complaint::statusNames();
        $dp=Complaint::count1($ms,$d,$s,false,$dcode,$bcode);
        $dp->pagination=false;
        $models=$dp->getModels();
        $out='<html><meta charset="utf-8"><body><style>th,td,.bordered{border:solid 1px;padding:5px;}</style><table class="bordered">';
        $out.='<tr><th>'.'Name'.'</th>'.'<th>'.'Description'.'</th>'.'<th>'.'Action Taken'.'</th>'.'<th>'.'Status'.'</th>'.'</tr>';
        foreach ($models as $model)
         {
         //print_r($model);
         //exit;
            $model1=Complaint::findOne($model['id']);
             $out.='<tr><td>'.$model['cname'].'<br>'.$model['fname'].'<br>'.$model['mobileno'].'</td><td>'.'<b>'.$model['ctype'].'</b>'.'<br/>'.'<b>'.$model['csubtype'].'</b>'.'<br/>'.$model['desc'].'</td>';
          
            $x='';
            foreach ($model1->markings as $marking) { 
   
      
              $x.=$this->renderPartial('../complaint/list',['replies'=>$model1->getReplies($marking->id)]);
    
    
         }
          $out.='<td>'.$x.'</td>'.'<td>'.$statuses[$model1->status].'</td>'.'</tr>';
         }
        
         $out.='</table></body></html>';
       /*  
         $mdf = new \mPDF();
    $mdf->useAdobeCJK = true;		// Default setting in config.php
						// You can set this to false if you have defined other CJK fonts

     //$mdf->SetAutoFont(AUTOFONT_ALL);
     $mdf->autoLangToFont=true;
     ob_clean();
     ob_start();
     $mdf->setFooter('{PAGENO}');
     $mdf->WriteHTML($stylesheet,1);
     $mdf->WriteHTML($out,2);
     ob_get_clean();
     $mdf->Output();
     */
         return $this->renderContent($out);
       // return $this->render('../complaint/index1',['dataProvider'=>$dp,'searchModel'=>$searchModel]);
     }
     public function actionJmypdf($ms=0,$d=-1,$s=-1,$dcode=null,$bcode=null)
     {
        
         if (Yii::$app->user->isGuest)
           throw new NotFoundHttpException("Not Allowed");
                //  Yii::$app->response->format = 'pdf';

        $this->layout = '//print';
        
     
         $statuses=JobcardDemand::statusNames();
        $dp=JobcardDemand::count1($ms,$d,$s,false,$dcode,$bcode);
        $dp->pagination=false;
        $models=$dp->getModels();
        $out='<html><meta charset="utf-8"><body><style>th,td,.bordered{border:solid 1px;padding:5px;text-align:center;}</style><table class="bordered">';
        $out.='<tr><th>'.'Name'.'</th>'.'<th>'.'District'.'</th>'.'<th>'.'Action Taken'.'</th>'.'<th>'.'Status'.'</th>'.'</tr>';
        foreach ($models as $model)
         {
        
            $model1=JobcardDemand::findOne($model['id']);
             $out.='<tr><td>'.$model['cname'].'<br>'.$model['fname'].'<br>'.$model['mobileno'].'</td>';
          
            $x='';
            $y=$model1->report?$model1->report->complainttrue:"";
            $x.='<td>'.$y.'</td>';
    
         
          $out.=$x.'<td>'.$statuses[1].'</td>'.'</tr>';
         }
        
         $out.='</table></body></html>';
      
         return $this->renderContent($out);
       // return $this->render('../complaint/index1',['dataProvider'=>$dp,'searchModel'=>$searchModel]);
     }
     public function actionReport1()
     {
       return $this->render('report1');
     }
}
?>