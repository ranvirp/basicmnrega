<?php



/* @var $this yii\web\View */
/* @var $model app\modules\work\models\PondAttributes */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pond Attributes',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pond Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pond-attributes-create">
<?=  $this->render('_form');
	   ?>
</div>
