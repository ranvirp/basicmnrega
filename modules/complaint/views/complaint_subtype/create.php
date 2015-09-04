<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_subtype */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Complaint Subtype',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Subtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-subtype-create">
<?=  $this->render('_form');
	   ?>
</div>
