<?php



/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Request */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Request',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">
<?=  $this->render('_requestform',['model'=>$model]);
	   ?>
</div>
