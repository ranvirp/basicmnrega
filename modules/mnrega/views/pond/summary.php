<table class="table table-bordered">
<tr><th>District</th><th>No of Records</th></tr>
 <?php foreach (\app\modules\mnrega\models\Pond::getSummaryCount() as $summary)
 {
 ?>
 <tr><td><?=$summary['district']?></td><td><?=$summary['count']?></td></tr>
<?php 
 }
 ?>
</table>