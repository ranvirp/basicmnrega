<?php
namespace app\commands;
use app\modules\users\models\Designation;
use app\modules\users\models\DesignationType;

use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\JobcardDemand;

use app\modules\mnrega\models\Marking;
use Yii;


class SmsController extends \yii\console\Controller
{
   public function actionSendReports()
	  {
	  	$smsc=new \app\components\SendSMSComponent;
	  	//for Admin
	  	$complaintcounts=Complaint::counts([]);
        $jobcarddemandcounts=JobcardDemand::counts([]);

        $workdemandcounts=WorkDemand::counts([]);
        $s=Complaint::PENDING_FOR_ATR;
         		   
        $c_atr=$complaintcounts[0]['complaint_count_'.$s];
        $jcd=$jobcarddemandcounts[0]['jobcarddemand_count_0'];
        $wd=$workdemandcounts[0]['workdemand_count_0'];
        $mobile=Yii::$app->params['adminmobile'];;
				$userm=$mobile;
		
        $text='Pending '.Yii::t('app','Complaints')."-".$c_atr."\n".'Pending '.Yii::t('app','WorkDemand')."-".$wd."\n".Yii::t('app','JobCardDemand')."-".$jcd;
				$text.=" Login to http://nregaup.in	";
			//	print $userm."\n".$text."\n";
				
				$smsc->postSms($userm,$text);
				
        $po=DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
	  	/*
	 foreach (Designation::find()->where(['designation_type_id'=>$po])->asArray()->all() as $designation)
		{
		    $counts=Marking::count1(['complaint','workdemand','jobcarddemand'],[0,1,2,3,4,5],$designation['id']);
            $counts1=$counts;
            $s=Complaint::PENDING_FOR_ATR;
            $pending_for_atr_complaints=$counts1[0]['complaint_count_'.$s];
            $pending_workdemand=$counts1[0]['workdemand_count_0'];
            $pending_jobcarddemand=$counts1[0]['jobcarddemand_count_0'];
		   
		   
		   if (($pending_for_atr_complaints+$pending_workdemand+$pending_jobcarddemand)>0)
		     {
		      print_r( $designation);
		  
		       print_r($counts1);
            
			    $mobile= Designation::find()->where(['id'=>$designation['id']])->one()->officer_mobile;
				$userm=$mobile;
				$text="Pending \n";
				$text.='Pending '.Yii::t('app','Complaints')."-".$pending_for_atr_complaints."\n".'Pending '.Yii::t('app','WorkDemand')."-".$pending_workdemand."\n".Yii::t('app','JobCardDemand')."-".$pending_jobcarddemand."\n".
				    "\n";
				$text.=" Login to http://nregaup.in	";
				//$smsc->postSms($userm,$text);
				print $userm."\n".$text."\n";
				
			  }
		   //print $name."-".$ul."\n";
		}
		*/
	   }
}