<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_type */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Complaint Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-type-create">
<?=  $this->render('_form');
	   ?>
</div>
