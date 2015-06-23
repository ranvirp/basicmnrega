<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Panchayat */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Panchayat',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Panchayats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panchayat-create">
<?=  $this->render('_form');
	   ?>
</div>
