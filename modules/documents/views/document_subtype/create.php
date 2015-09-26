<?php



/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\DocumentSubtype */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Document Subtype',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Subtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-subtype-create">
<?=  $this->render('_form');
	   ?>
</div>
