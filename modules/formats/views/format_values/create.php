<?php



/* @var $this yii\web\View */
/* @var $model app\modules\formats\models\FormatValues */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Format Values',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Format Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="format-values-create">
<?=  $this->render('_form');
	   ?>
</div>
