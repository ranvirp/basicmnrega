<?php



/* @var $this yii\web\View */
/* @var $model app\modules\work\models\District */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'District',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">
<?=  $this->render('_form');
	   ?>
</div>
