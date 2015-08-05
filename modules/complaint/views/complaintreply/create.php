<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\ComplaintReply */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Complaint Reply',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Replies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-reply-create">
<?=  $this->render('_form');
	   ?>
</div>
