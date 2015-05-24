<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Block */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Block',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">
<?=  $this->render('_form');
	   ?>
</div>
