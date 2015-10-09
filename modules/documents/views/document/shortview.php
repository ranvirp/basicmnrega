<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-12 simple-box">
<h3><strong><?=$model->name_hi?></strong></h3>
<p> <?=$model->shorttext?></p>
<span class="pull-right"><?=Html::a('More>>',Url::to(['/docs/document/view?id='.$model->id]))?></span>
</div>