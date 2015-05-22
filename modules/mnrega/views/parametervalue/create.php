<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\ParameterValue */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Parameter Value',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parameter Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-value-create">
<?=  $this->render('_form');
	   ?>
</div>
