 <?php
 use yii\helpers\Html;
 ?>
 <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add Comments', ['/reply/default/create','ct'=>'complaint', 'ctid' => $model->id], [
            'class' => 'btn btn-danger',
            
        ]) ?>
         <?= Html::a('View Comments', ['/complaint/complaint/viewcomments', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>
  <?=  $this->render('@app/modules/reply/views/default/list',['model'=>$model])?>