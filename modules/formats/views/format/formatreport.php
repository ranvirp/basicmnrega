
<?php $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
        ?>
<p>Report for <?=$format->label_en?> for month of <?=$months[Yii::$app->request->get('month')]?> </p>
<table class="table table-responsive">
<tr>	
	<th>District</th>
	
<?php
foreach (json_decode($format->parameters,true) as $parameter){ ?>
<th><?=$parameter['label_en'] ?></th>
<?php } ?>
</tr>
<?php foreach ($formatvalues as $formatvalue) { 
if ($format->keyvalue==0)	{ ?>
<tr>
	<td><?=\app\modules\mnrega\models\District::findOne($formatvalue->district)->name_en?></td>

<?php
foreach (json_decode($formatvalue->enteredvalues,true) as $values){ ?>
<td><?=$values ?></td>
<?php } } else 
{ 
	
	foreach (json_decode($formatvalue->enteredvalues,true) as $key=>$values){
	?>
	<tr>
	<td><?=\app\modules\mnrega\models\District::findOne($formatvalue->district)->name_en?></td>

<?php foreach ($values as $k=>$value){?>	
<td><?=$value?></td>
<?php } ?>

	
<?php
}}
?>
</tr>
<?php } ?>
</table>