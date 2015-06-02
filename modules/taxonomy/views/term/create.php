<?php



/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Term */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Term',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-create">
<?=  $this->render('_form');
	   ?>
</div>
