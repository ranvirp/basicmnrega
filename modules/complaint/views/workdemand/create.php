<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\WorkDemand */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Work Demand',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-demand-create">
<?=  $this->render('_form',['model'=>$model]);
	   ?>
</div>
