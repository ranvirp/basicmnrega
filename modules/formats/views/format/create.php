<?php



/* @var $this yii\web\View */
/* @var $model app\modules\formats\models\Format */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Format',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="format-create">
<?=  $this->render('_form',['model'=>$model]);
	   ?>
</div>
