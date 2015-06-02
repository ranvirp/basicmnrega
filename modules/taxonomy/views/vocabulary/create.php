<?php



/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Vocabulary */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Vocabulary',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vocabularies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vocabulary-create">
<?=  $this->render('_form');
	   ?>
</div>
