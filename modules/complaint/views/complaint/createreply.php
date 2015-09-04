<?php

//use \kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reply */
$this->title = 'Create Reply';
$this->params['breadcrumbs'][] = ['label' => 'Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage();?>
<?php $this->head();?>
<?php $this->beginBody();?>
<div class="reply-create">

    

    <?= $this->render('reply', [
        'model' => $model,
        'id'=>$id,
        'marking'=>$marking,
    ]) ?>

</div>
<?php $this->endBody();?>
<?php $this->endPage();?>