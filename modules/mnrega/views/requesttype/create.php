<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\RequestType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Request Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-type-create">
<?=  $this->render('_form');
	   ?>
</div>
