<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Marking */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Marking',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Markings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marking-create">
<?=  $this->render('_form');
	   ?>
</div>
