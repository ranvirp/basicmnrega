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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
},],['header'=>'Panchayat',
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return $model['panchayat'];
},],
['header'=>Yii::t('app','Complaint Type'),
'value'=>function($model,$key,$index,$column)
{
      return $model['ctype'];
       
},],
['header'=>Yii::t('app','Description'),
'value'=>function($model,$key,$index,$column)
{
      
         return $model['desc'];
       
       
},],
            ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{filereport}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/complaint'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
                'filereport'=>function($url,$model,$key)
                {
                  return Html::a('<button class="btn btn-success">'.'File Report'.'</button>',$url.'&returnurl='.urlencode(Url::to(['/complaint/jobcarddemand/my'])));
                }
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
