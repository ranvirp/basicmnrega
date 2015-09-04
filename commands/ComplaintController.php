<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;


	
use Yii;
use yii\console\Controller;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintPoint;

use app\modules\complaint\models\EnquiryReportPoint;
use app\modules\complaint\models\EnquiryReportSummary;
use app\modules\complaint\models\AtrPoint;
use app\modules\complaint\models\AtrSummary;class ComplaintController extends Controller
{
  //rbac setup 
  public function actionRbacsetup()
   {
    $roles=[ 
            'complaintadmin',//Admin complaint- can create complaint categories, approve/disapprove reports
                             //can lock/unlock records for edit, update 
            'editor',// can edit complaints/jobcardeemand and workdemand
            'complaintagent',//can mark unmarked complaints, can edit complaints and add information 
                             //can file reports, search for any reports
            //any authenticated user can file report marked to him/her, can
            //edit report before finalizing 
            //can file atr 
            ];
                             
    
   
   
   }
public function actionPrinthint()
{
  

$complaint=new Complaint;
$complaintpoint=new ComplaintPoint;
$eqsummary=new EnquiryReportSummary;
$eqpoint=new EnquiryReportPoint;
$atrsummary=new AtrSummary;
$atrpoint=new AtrPoint;

$x=$complaint->attributeHints();

$x=array_merge($x,$eqsummary->attributeHints());
$x=array_merge($x,$eqpoint->attributeHints());
$x=array_merge($x,$atrsummary->attributeHints());
$x=array_merge($x,$atrpoint->attributeHints());
$x=array_merge($x,$complaintpoint->attributeHints());
$hints=include Yii::getAlias("@app/messages/hi/hints.php");
   
$y='<?php'."\n".'return ['."\n";
    foreach ($x as $name=>$value)
    {
      $y.="\n'".$value."'=>'".$hints[$value]."',\n";
    
    }
    $y.="\n];";
    file_put_contents(Yii::getAlias("@app/messages/hi/hints.php"),$y);


}




}