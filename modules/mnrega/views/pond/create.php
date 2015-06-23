<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Pond */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pond',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ponds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pond-create">
<?=  $this->render('_form');
	   ?>
</div>
