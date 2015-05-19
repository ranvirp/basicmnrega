<?php



/* @var $this yii\web\View */
/* @var $model app\modules\work\models\Village */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Village',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Villages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="village-create">
<?=  $this->render('_form');
	   ?>
</div>
