 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\complaint\models\Complaint;
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

['header'=>'Name',
'attribute'=>'cname',
'value'=>function($model,$key,$index,$column)
{
        return $model['cname'];
},],['header'=>'Father/Husband Name',
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model['fname'];
},],['header'=>'Mobileno',
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
              'template'=>'{reqaction}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/complaint'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
                'reqaction'=>function($url,$model,$key)
                {
                 if ($model['complaintstatus']==Complaint::PENDING_FOR_ENQUIRY)
                  return Html::a('<button class="btn btn-success">'.'File Enquiry Report'.'</button>',$url.'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint/my'])));
                  else  if ($model['complaintstatus']==Complaint::PENDING_FOR_ATR)
                  return Html::a('<button class="btn btn-success">'.'File ATR'.'</button>',$url.'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint/my'])));
                   else if ($model['complaintstatus']==Complaint::ATR_RECEIVED)
                  return Html::a('<button class="btn btn-success">'.'Mark Disposed'.'</button>',$url.'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint/my'])));
                    else if ($model['complaintstatus']==Complaint::REGISTERED)
                  return Html::a('<button class="btn btn-success">'.'Mark to Officer'.'</button>',$url.'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint/my'])));
                  
                }
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
