<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\mnrega\models\Marking;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\MarkingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Markings');
$this->params['breadcrumbs'][] = $this->title;
$this->params['markurl']=$markurl;
?>
<style>
.no-padding
{
 padding:0;
}
</style>
<div class="marking-index col-md-12">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span><?=Yii::t('app','List of Marking')?></span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
       'options'=>['class'=>'grid-view table-rsponsive'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
'id',
'request_type',[
'attribute'=>'request_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('request_id');
},],[
'attribute'=>'sender',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('sender');
},],[
'attribute'=>'receiver',
'value'=>function($model,$key,$index,$column)
{
                return $model->receiver_name;
},],

[
'attribute'=>'dateofmarking',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('dateofmarking');
},],             'deadline',
['header'=>'Status',
'attribute'=>'status',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('status');
},],
['header'=>'Flag','value'=>function($model,$key,$index,$column){return ($model->flag==1?Yii::t('app','inactive'):Yii::t('app','Active'));}],
($this->params['markurl']==null)?[]:
['header'=>'Change Status',
'format'=>'raw',
'value'=>function($model,$key,$index,$column)
{
$x='';

if ($this->params['markurl']!=null)
{
    $x='<form class="no-padding" action="'.$this->params['markurl'].'" method="POST"
    onSubmit="event.preventDefault();$.ajax({\'url\':$(this).attr(\'action\'),\'type\':\'POST\',\'data\':$(this).serialize(),\'success\':function(data){$(\'#'.$model->id.'-action\').trigger(\'click\');}});">';
    $x.='<input type="hidden" name="requestid" value="'.$model->request_id.'">';
  $x.='<input type="hidden" name="requesttype" value="'.$model->request_type.'">';
  
    $x.='<input type="hidden" name="markingid" value="'.$model->id.'">';
    $classmap=Marking::mapping();
    $classname=$classmap[$model->request_type];
    $x.=Html::dropDownList('markingstatus','',$classname::statusNames());
    $x.='<input type="submit" value="Submit" ></input>';
    $x.='</form>';
    }
    return $x;
},],

            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'read_time:datetime',

            
        ],
        'tableOptions'=>['class'=>'table table-hover'],
        ]); ?>

</div>
