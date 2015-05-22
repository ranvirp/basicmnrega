<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Photo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <div class="row">
<div class="col-md-6">

 <img height="200" width="200" src="<?=$model->url?>"/>
 </div>
 <div class="col-md-6">
 
 <?=	 \app\modules\gpsphoto\widgets\LeafletWidget::widget(['gpslat'=>$model->gpslat,'gpslong'=>$model->gpslong]);?>
<p><b>Latitude:</b><?=$model->gpslat;?>,<b>Longitude</b>:<?=$model->gpslong?></p>
</div>	
</div>
</div>
