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
	public function actionPopulate($p,$l,$d=0,$debug=0)
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
       // $pp=ParameterParse::find()->where(['parameter_id'=>$p,'level'=>$l,'district_code'=>$d])->one();
 //if (!$pp) 
 $pp=new ParameterParse;
       //if (time()+$model->periodicity*24*3600<$pp->update_time )
        //return "Cannot update before periodicity\n";
       // print $link;
        //exit;
     //   $data=file_get_contents($link);
       $data="not checking"; 
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
        case 'musterroll':
         $tableid=3;
         $rowstoskip=3;
         $m=date('m');
         $y=date('Y');
         if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=[2,3,4,5];
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
         case 'unfilledmusterroll':
        $tableid=3;
        $rowstoskip=3;
         $colwithnames=1;
         $level=0;
         $colwithvalues=range(16,22);
        break;
        
        default:
        break;
        }
        if ($debug) print $link."\n";
          $x=[];
          $utility=new \app\modules\mnrega\Utility;
          $result=$utility->parseTable($link,$tableid,$rowstoskip,$colwithnames,$colwithvalues,$x,$l,$dnew,$debug);
      if ($debug) var_dump($result);
       
 $pp->update_time=time();
 $pp->json_value=json_encode($result);
 $pp->parameter_id=$p;
 $pp->district_code=$d;
 //$pp->dld_data=$data;
 $pp->level=$l;
 if (!$pp->save())
  file_put_contents('../runtime/logs/'.$p.'.log', print_r($pp->errors,true));
else
  print $pp->id;
  // $pp->updateTable();
        
    
	}
	//public function actionAssigndesignation($username,$designation)
	public function actionRanking()
	{
	error_reporting(0);
	  $pp1=ParameterParse::find()->where(['parameter_id'=>1])
	       ->orderBy('update_time desc')->one();
	  $pp2=ParameterParse::find()->where(['parameter_id'=>11])
	       ->orderBy('update_time desc')->one();
	  $pp3=ParameterParse::find()->where(['parameter_id'=>12])
	       ->orderBy('update_time desc')->one();
	 $arr1=json_decode($pp1->json_value,true);//mandays
	 $arr2=json_decode($pp2->json_value,true);//emp status
	 $arr3=json_decode($pp3->json_value,true);//musterroll
	 $arr=[];
	 $m=date('m');
         $y=date('Y');
          if ($y==2016) $m=$m+12;
         $m=$m-3;
         $colwithnames=1;
         $level=0;
      
   $targetkey=2*$m+$colwithnames-1;
   $achkey= 2*$m+$colwithnames;
   $mustroll=2;
   $mustrollfilled=3;
   $withoutpaymentdate=4;
   $withnomb=5;
   $cumhhd=6;
   $cumhhp=8;
   $hhmonth=9;
                  //$persondaysprojected=10;
   $pda=13;//person days achievment
  
   $hh100=15;
   $indland=16;
   $disabled=17;
   $women=14;
   $st=11;
   $sc=10;
   $blocks=\app\modules\mnrega\models\Block::find()->all();
	// print_r($arr2);
	// exit;
	 foreach ($blocks as $block)
	 {
	  $x1=$arr[$block->code]['mandaystarget']=$arr1[$block->district_code][$block->code][$targetkey];
	  $x2=$arr[$block->code]['mandaysach']=$arr1[$block->district_code][$block->code][$achkey];
	  $mandaysper=$arr[$block->code]['mandaysper']=$x1!=0?$x1/$x2*100:0;
	  
	  $x3=$arr[$block->code]['cumhhd']=$arr2[$block->district_code][$block->code][$cumhhd];
	  $x4=$arr[$block->code]['cumhhp']=$arr2[$block->district_code][$block->code][$cumhhp];
	  $demandper=$arr[$block->code]['demandper']=($x3!=0)?sprintf(".2f",$x4/$x3*100):0.0;
	  $hh100total=$arr[$block->code]['hh100']=$arr2[$block->district_code][$block->code][$hh100];
	  $x5=$arr[$block->code]['women']=$arr2[$block->district_code][$block->code][$women];
	  $x6=$arr[$block->code]['womenper']=($x2!=0)?sprintf(".2f",$x5/$x2*100):0.0;
	  $x7=$arr[$block->code]['mustroll']=$arr3[$block->district_code][$block->code][$mustroll];
	  $x8=$arr[$block->code]['mustrollfilled']=$arr3[$block->district_code][$block->code][$mustrollfilled];
	  $x9=$arr[$block->code]['withoutpaymentdate']=$arr3[$block->district_code][$block->code][$withoutpaymentdate];
	  $x10=$arr[$block->code]['withnomb']=$arr3[$block->district_code][$block->code][$withnomb];
	  $totalmarks=($mandaysper<150)?1.2*$mandaysper:-1000;
	  $totalmarks+=$demandper;
	  $totalmarks+=$x6;
	  $totalmarks+=$x8/$x7*100*1.2;
	  $totalmarks+=$x8/$x7*100*1.2;
	  $totalmarks+=($x7-$x10)/$x7*100*1.3;
	  $arr[$block->code]['totalmarks']=sprintf("%0.2f",$totalmarks);
	  
	 
	 }
	 print_r($arr);
	error_reporting(-1);
	}
	
}

