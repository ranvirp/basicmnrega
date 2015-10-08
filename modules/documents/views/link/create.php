<?php



/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\Link */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Link',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-create">
<?=  $this->render('_form');
	   ?>
</div>
