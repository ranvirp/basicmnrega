 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
 ?>
 <div class="form-title">
        <div class="form-title-span">
         <span>List of Demand for Job Card</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
['header'=>'Id',
'attribute'=>'id',
'value'=>function($model,$key,$index,$column)
{
        return Html::a($model['id'],Url::to(['/complaint/jobcarddemand/view?id='.$model['id']]));
},
'format'=>'html'],
['header'=>'name_hi',
'attribute'=>'Name',
'value'=>function($model,$key,$index,$column)
{
        return $model['cname'];
},],['header'=>'Father/Husband Name',
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model['fname'];
},],['header'=>'Mobile No',
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model['mobileno'];
},],
'dname',
'bname',
['header'=>'Panchayat',
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return $model['panchayat'];
},],
       ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{filereport}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/jobcarddemand'. '/' . $action ;
                return Url::toRoute($params);
              },
             'buttons'=>[
                'filereport'=>function($url,$model,$key)
                {
                 if ($model['markingstatus']!=null)
                  return Html::a('<button class="btn btn-success">'.'File Report'.'</button>',$url.'&returnurl='.urlencode(Url::to(['/complaint/jobcarddemand/my'])));
                else
                  return Html::a('<button class="btn btn-success">'.'Mark Officer'.'</button>',Url::to(['/complaint/jobcarddemand/update?id='.$model['id']]).'&returnurl='.urlencode(Url::to(['/complaint/jobcarddemand/my'])));
      
                }
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
