<div class="col-md-12 pull-right">
 <?=Html::a('Reject','#',['onclick'=>'$.get(\''.Url::to(['/complaint/complaint/accept?accept=2&id='.$enquiryreportsummary->id.'&type=enqsummary']).'\',function(data){$(\'#reject-reason\').append(\'Enquiry Report Summary #'.$enquiryreportsummary->id.'not accepted \');});return false;'])?>
</div>
<div class="col-md-12 pull-right">
 <?=Html::a('Reject','#',['onclick'=>'$.get(\''.Url::to(['/complaint/complaint/accept?accept=2&id='.$id.'&type=atrsummary']).'\',function(data){$(\'#reject-reason\').append(\'ATR Report Summary #'.$atrsummary->id.'not accepted \');});return false;'])?>
</div>
<div class="col-md-12 pull-right">
 <?=Html::a('Reject','#',['onclick'=>'$.get(\''.Url::to(['/complaint/complaint/accept?accept=2&id='.$enquiryreportspoint[$cp->id]->id.'&type=enqpoint']).'\',function(data){$(\'#reject-reason\').append(\'Enquiry Point #'.$enquiryreportspoint[$cp->id]->id.'not accepted \');});return false;'])?>
</div>
<div class="col-md-12 pull-right">
 <?=Html::a('Reject','#',['onclick'=>'$.get(\''.Url::to(['/complaint/complaint/accept?accept=2&id='.$atrpoint->id.'&type=atrpoint']).'\',function(data){$(\'#reject-reason\').append(\'ATR Point #'.$atrpoint->id.'not accepted \');});return false;'])?>
</div>


