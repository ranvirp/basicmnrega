<?php
/* @var $this yii\web\View */
$this->title = 'UP MNREGS';
?>
<div class="site-index">
<div class="body-content">
<div class="row">
<div class="col-md-4">
 <?=	 \app\modules\gpsphoto\widgets\LeafletWidget::widget(['gpslat'=>'26.846510800000000000','gpslong'=>'80.946683200000050000']);?>

</div>

<div class="col-md-8">
     <?php
      $photos=\app\modules\gpsphoto\models\Photo::find()->orderBy('created_at desc')->limit(10)->all();
      echo \app\modules\gpsphoto\widgets\GeneralPhotoWidget::widget(['photos'=>$photos]);
     
     ?>
</div>
    </div>
    </div>
    

    
</div>
