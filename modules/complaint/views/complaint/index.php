 <?php
 use yii\helpers\Html;
use yii\grid\GridView;
 ?>
 <div class="form-title">
        <div class="form-title-span">
         <span>List of Complaints</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'name_hi',
'attribute'=>'Name',
'value'=>function($model,$key,$index,$column)
{
                return $model->complaint->showValue('name_hi');
},],['header'=>'Father/Husband Name',
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model->complaint->showValue('fname');
},],['header'=>'Mobile No',
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model->complaint->showValue('mobileno');
},],['header'=>'Panchayat',
'attribute'=>'panchayat_code',
'value'=>function($model,$key,$index,$column)
{
                return $model->complaint->showValue('panchayat_code');
},],
['header'=>Yii::t('app','Complaint Type'),
'value'=>function($model,$key,$index,$column)
{
       
                  return $model->complaint->complaint_type?$model->complaint->showValue('complaint_type'):'';
            
       
},],
['header'=>Yii::t('app','Description'),
'value'=>function($model,$key,$index,$column)
{
       
                  return $model->complaint->description;
            
       
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
