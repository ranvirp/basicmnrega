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
<p class="well">
<?=$parentcontent?>
</p>
<div class="reply-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php $this->endBody();?>
<?php $this->endPage();?>