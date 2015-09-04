<?php



/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\JobcardDemand */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Jobcard Demand',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobcard Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobcard-demand-create">
<?=  $this->render('_form',['model'=>$model]);
	   ?>
</div>
