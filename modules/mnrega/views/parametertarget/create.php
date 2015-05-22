<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\ParameterTarget */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Parameter Target',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parameter Targets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-target-create">
<?=  $this->render('_form');
	   ?>
</div>
