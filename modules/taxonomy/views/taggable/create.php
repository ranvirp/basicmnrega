<?php



/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Taggable */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Taggable',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taggables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taggable-create">
<?=  $this->render('_form');
	   ?>
</div>
