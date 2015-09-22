<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\Document */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<article>
<h1><?=$model->name_hi?></h1>
<hl>
<p>
<?=$model->fulltext?>
</p>
<?=\app\modules\reply\models\File::showAttachmentsInline($model,'attachments')?>
<?php foreach (explode(",",$model->gallery) as $photos) {
 $photo=\app\modules\reply\models\File::findOne($photos);
?>
<div class="col-md-6" style="margin-bottom:15px">
 <img height="250px" width="100%" title="<?=$photo->title?>" src="<?=$photo->url?>"></img>
 <p class="text-center"><?=$photo->title?></p>
</div>
<?php }?>
</article>
   
</div>
