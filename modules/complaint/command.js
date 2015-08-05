$(document).ready(
function(){
$('#complaint-atr-accepted').change(function()
{
  populateHtml("<?= \yii\helpers\Url::to(['/complaint/complaint/findActions?cstatus'])"+$('#cstatus').val()+"&markingid=1])?>",'#complaint-actionbar');
});
$('#complaint-enquiry-report-accepted').change(function()
{
  populateHtml("<?= \yii\helpers\Url::to(['/complaint/complaint/findActions?id=1&markingid=1])?>",'#complaint-actionbar');

});


});
//Complaint view by User
//report filed by subuser
//Accept report by a user marked by user
->forward report with your comment---clone a enquiry report and then open with already filled in vivran 

//markingstatus-> report accepted and 