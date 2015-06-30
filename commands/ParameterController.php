<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;


	
use Yii;
use yii\console\Controller;
use app\modules\mnrega\models\Parameter;
use app\modules\mnrega\models\ParameterParse;

class ParameterController extends Controller
{
    public function actionInit()
    {
        
        

        
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
        $pp=ParameterParse::find()->where(['parameter_id'=>$p,'level'=>$l,'district_code'=>$d])->one();
 if (!$pp) $pp=new ParameterParse;
       //if (time()+$model->periodicity*24*3600<$pp->update_time )
        //return "Cannot update before periodicity\n";
       // print $link;
        //exit;
        $data=file_get_contents($link);
        
        if ($data=='')
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
       
 $pp->update_time=time();
 $pp->json_value=json_encode($result);
 $pp->parameter_id=$p;
 $pp->district_code=$d;
 //$pp->dld_data=$data;
 $pp->level=$l;
 if (!$pp->save())
   print_r($pp->errors);
else
  print $pp->id;
  // $pp->updateTable();
        
    
	}
	//public function actionAssigndesignation($username,$designation)
	
}

