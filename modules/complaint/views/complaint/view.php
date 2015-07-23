<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\DetailView;
use app\modules\mnrega\models\MarkingSearch;
use app\modules\complaint\models\Complaint;
/* @var $this yii\web\View */
/* @var $model app\models\Reply */
use app\assets\AppAssetGoogle;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complaint', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Complaint';
?>
<?php AppAssetGoogle::register($this);?>
<div class="reply-view">

    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add Comments', ['/reply/default/create','ct'=>'complaint', 'ctid' => $model->id], [
            'class' => 'btn btn-danger',
            
        ]) ?>
         <?= Html::a('View Comments', ['/complaint/complaint/viewcomments', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
          <?= Html::a('Add Comments', ['/reply/default/create', 'ct'=>'complaint', 'ctid' => $model->id], ['class' => 'btn btn-primary','onClick'=>'event.preventDefault();populateHtml($(this).attr("href"),"reply")']) ?>
       
       
    </p>
    <div id='reply'>
    </div>
<div class="col-sm-12">
<p><?=Yii::t('app','Complainant')?></p>
<div class="col-md-6">
<?=DetailView::widget(
[
 'model'=>$model,
 'attributes'=>['id','name_hi','fname','mobileno','address']
]
)?>
</div>
<div class="col-md-6">
<?=DetailView::widget(
[
 'model'=>$model,
 'attributes'=>[['attribute'=>'district_code','value'=>\app\modules\mnrega\models\District::findOne($model->district_code)->name_en],
               ['attribute'=>'block_code','value'=>\app\modules\mnrega\models\Block::findOne($model->block_code)->name_en],
 'panchayat',
 ['header'=>'Attachments','attribute'=>'attachments','value'=>\app\modules\reply\models\File::showAttachmentsInline($model,"attachments"),'format'=>'html'],
 ['header'=>Yii::t('app','Status'),'attribute'=>'status','value'=>Complaint::statusNames()[$model->status]],
]
]
)?>
</div>

   
</div>
<?php $cps=$model->complaintPoints;
if ($cps) {?>
<div class="col-sm-12">
<p>Complainant Points</p>
<table class="table table-striped">
<tr><th>Id</th><th>Type</th><th>Sub Type</th><th>Description</th><th>Attachments</th></tr>

<?php foreach ($cps as $cp) {?>
   <tr>
    <td><?=$cp->showValue('id')?></td>
    <td><?=$cp->showValue('complaint_type')?></td>
    <td><?=$cp->showValue('complaint_subtype')?></td>
    <td><?=$cp->showValue('description')?></td>
  
    <td><?=\app\modules\reply\models\File::showAttachmentsInline($cp,"attachments")?></td>
   
    </tr>
 
    <?php }?>
    </table>
</div>
<?php }?>
</div>
<div class="row">
<?php
      $marking=new MarkingSearch;
      $marking->request_type='complaint';
      $marking->request_id=$model->id;
      $dp =$marking->search([]);
      if (Yii::$app->user->can('changemarkingstatus') )
        $markurl=Url::to(['/complaint/complaint/setmarkingstatus']);
     else 
       $markurl=null;
      echo '<div class="col-sm-offset-2 col-sm-8">';
         print $this->render('@app/modules/mnrega/views/marking/index',['searchModel'=>$marking,'dataProvider'=>$dp,'markurl'=>$markurl]);
       echo '</div>';
     
?>
</div>
</div>
