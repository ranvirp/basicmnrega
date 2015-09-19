<?php



/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\Document */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Document',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">
<?=  $this->render('_form',['model'=>$model]);
	   ?>
</div>
