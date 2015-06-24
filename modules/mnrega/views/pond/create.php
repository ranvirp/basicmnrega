<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Pond */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pond',
]);
\app\assets\AppAssetGoogle::register($this);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ponds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pond-index">
<?= $this->render('index1',
['dataProvider'=>$dataProvider,'model'=>null,'searchModel'=>$searchModel])
?>
</div>
<div class="pond-create">
<?=  $this->render('_form',['model'=>$model]);
	   ?>
</div>
