<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\Document */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view">
<?php if ($model && Yii::$app->user->can('webadmin'))
{?>
 <?=Html::a('Update',Url::to(['/docs/document/update?id='.$model->id]))?>   
<?php } ?>
<article>
<h1><?=$model->name_hi?></h1>
<hl>
	<p><?=date('day month year time',$model->create_time)?></p>
<hl>
	<p><strong><?=$model->shorttext?></strong></p>
<p>
<?=$model->fulltext?>
</p>
<?=\app\modules\reply\models\File::showAttachmentsInline($model,'attachments')?>
<?php foreach (explode(",",$model->gallery) as $photos) {
	if (is_numeric($photos))
	{
 $photo=\app\modules\reply\models\File::findOne($photos);
?>
<div class="col-md-6" style="margin-bottom:15px">
 <img height="250px" width="100%" title="<?=$photo->title?>" src="<?=$photo->url?>"></img>
 <p class="text-center"><?=$photo->title?></p>
</div>
<?php }}?>
</article>
   
</div>
