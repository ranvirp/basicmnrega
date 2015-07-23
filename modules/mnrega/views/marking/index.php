<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
<div class="marking-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span><?=Yii::t('app','List of Marking')?></span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                return $model->showValue('receiver');
},],[
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

['header'=>'Change Status',
'format'=>'raw',
'value'=>function($model,$key,$index,$column)
{
$x='';

if ($this->params['markurl']!=null)
{
    $x='<form class="no-padding" action="'.$this->params['markurl'].'" method="POST"
    onSubmit="event.preventDefault();$.ajax({\'url\':$(this).attr(\'action\'),\'type\':\'POST\',\'data\':$(this).serialize()});">';
    $x.='<input type="hidden" name="requestid" value="'.$model->request_id.'">';
  $x.='<input type="hidden" name="requesttype" value="'.$model->request_type.'">';
  
    $x.='<input type="hidden" name="markingid" value="'.$model->id.'">';
    $x.=Html::dropDownList('markingstatus','',['Pending','Solved','Attention']);
    $x.='<input type="submit" value="Submit" ></input>';
    $x.='</form>';
    }else 
    {
      $x='<b>Not Allowed!!</b>';
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
</div>