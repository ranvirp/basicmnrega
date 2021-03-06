<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<table class="table table-hover">
<tr>
  <th>Type of Parameter</th>
  <th>Current Values </th>
  <th>Upload to nregaup.in </th>
  <th>View on nregaup.in </th>
</tr>
<tr>
  <th>Persondays Block Wise Target and Achievement</th>
  <th><?=Html::a('Populate',Url::to(['/mnrega/parameter/populate?p=1&l=1']))?> </th>
  <th><?= Html::a('Upload to nregaup.in',Url::to(['/api/pps/remote?mid=20&rmid=7&host=nregaup.in&access_token=']).Yii::$app->user->identity->auth_key)?> </th>
  <th><?=Html::a('View on nregaup.in','http://nregaup.in/mnrega/parameter/display?id=7')?> </th>
</tr>
<tr>
  <th>Work Wise Categories</th>
  <th><?=Html::a('Populate',Url::to(['/mnrega/parameter/populate?p=9&l=1']))?> </th>
  <th><?= Html::a('Upload to nregaup.in',Url::to(['/api/pps/remote?mid=15&rmid=2&host=nregaup.in&access_token=']).Yii::$app->user->identity->auth_key)?> </th>
  <th><?=Html::a('View on nregaup.in','http://nregaup.in/mnrega/parameter/displaywc?id=2')?> </th>
</tr>
<tr>
  <th>Employment Status</th>
  <th><?=Html::a('Populate',Url::to(['/mnrega/parameter/populate?p=11&l=1']))?> </th>
  <th><?= Html::a('Upload to nregaup.in',Url::to(['/api/pps/remote?mid=18&rmid=3&host=nregaup.in&access_token=']).Yii::$app->user->identity->auth_key)?> </th>
  <th><?=Html::a('View on nregaup.in','http://nregaup.in/mnrega/parameter/display?id=3')?> </th>
</tr>
</table>
