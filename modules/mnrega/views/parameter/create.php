<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Parameter */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Parameter',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parameters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-create">
<?=  $this->render('_form');
	   ?>
</div>
