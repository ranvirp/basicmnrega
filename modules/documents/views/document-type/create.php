<?php



/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\DocumentType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Document Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-type-create">
<?=  $this->render('_form');
	   ?>
</div>
