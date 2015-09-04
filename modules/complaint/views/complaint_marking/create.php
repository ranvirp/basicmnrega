<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_marking */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Complaint Marking',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Markings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-marking-create">
<?=  $this->render('_form');
	   ?>
</div>
