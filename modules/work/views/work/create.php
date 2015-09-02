<?php



/* @var $this yii\web\View */
/* @var $model app\modules\work\models\Work */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Work',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">
<?=  $this->render('_form');
	   ?>
</div>
