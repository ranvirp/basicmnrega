 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
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
        return $model->complaint?$model->complaint->showValue('name_hi'):'No Data';
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
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return $model->complaint->panchayat;
},],
['header'=>Yii::t('app','Complaint Type'),
'value'=>function($model,$key,$index,$column)
{
    if ($model->request_type=='workdemand')
    return 'कार्य की मांग ';
    else  if ($model->request_type=='jobcarddemand')
    return 'जॉबकार्ड की मांग';
    else 
      return $model->complaint->complaint_type?$model->complaint->showValue('complaint_type'):'';
            
       
},],
['header'=>Yii::t('app','Description'),
'value'=>function($model,$key,$index,$column)
{
       if($model->request_type=='complaint')
         return $model->complaint->description;
        else
          if ($model->request_type=='workdemand')
          {
            return 'For '.$model->complaint->noofdays.' days from '.$model->complaint->datefrom.
            ' to '.$model->complaint->dateto;
          }
            
       
},],
            ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{view}{update}{filereport}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model->request_id) ? $model->request_id: ['id' => (string) $model->request_id];
                $params[0] = '/complaint/'.$model->request_type. '/' . $action ;
                return Url::toRoute($params);
              },
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
