<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\mnrega\models\MarkingSearch;
/* @var $this yii\web\View */
/* @var $model app\models\Reply */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complaint', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-view">

    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="col-sm-12">
<p>Complainant</p>
<table class="table table-striped">
<tr><th>Id</th><th>Name</th><th>Father's Name</th><th>Mobile No</th><th>Address</th><th>Complaint Letter</th></tr>
   <tr>
    <td><?=$model->showValue('id')?></td>
    <td><?=$model->showValue('name_hi')?></td>
    <td><?=$model->showValue('fname')?></td>
    <td><?=$model->showValue('mobileno')?></td>
    <td><?=$model->showValue('address')?></td>
    <td><?=\app\modules\reply\models\File::showAttachmentsInline($model,"attachments")?></td>
   
    </tr>
    </table>
   
</div>
<div class="col-sm-12">
<p>Complainant Points</p>
<table class="table table-striped">
<tr><th>Id</th><th>Type</th><th>Sub Type</th><th>Description</th><th>Attachments</th></tr>

<?php foreach ($model->complaintPoints as $cp) {?>
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
</div>
</div>
<?php
      $marking=new MarkingSearch;
      $marking->request_type='complaint';
      $marking->request_id=$model->id;
      $dp =$marking->search([]);
      print $this->render('@app/modules/mnrega/views/marking/index',['searchModel'=>$marking,'dataProvider'=>$dp]);
?>
