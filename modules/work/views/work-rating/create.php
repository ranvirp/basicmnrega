<?php



/* @var $this yii\web\View */
/* @var $model app\modules\work\models\WorkRating */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Work Rating',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-rating-create">
<?=  $this->render('_form');
	   ?>
</div>
