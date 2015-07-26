 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\complaint\models\WorkdemandReport;
\app\assets\AppAssetGoogle::register($this);

 ?>
 <style>
 .text-heading
 {
  font-size:165%;
  text-align:center;
 
 }
 </style>

 <div class="form-title">
        <div class="form-title-span text-heading">
         <span>काम के मांग की सूची</span>
        </div>
    </div>
    <?php
     yii\widgets\ActiveFormAsset::register($this);
  $this->registerJs(
   '$("document").ready(function(){ 
        $(".reply-form").on("pjax:end", function() {
        

          $("#workdemand-grid-view").yiiGridView("applyFilter");


            //$.pjax.reload({container:"#complaint-subtypes"});  //Reload GridView
        });
    });'
);

  ?>
  <?php 
  Pjax::begin(['id'=>'workdemand-list','enablePushState'=>false,'formSelector'=>'.reply-form','linkSelector'=>'.reply-form']);
  Pjax::end();
  ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'id'=>'workdemand-grid-view',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
['header'=>'Id',
'attribute'=>'id',
'value'=>function($model,$key,$index,$column)
{
        return Html::a($model['id'],Url::to(['/complaint/workdemand/view?id='.$model['id']]));
},
'format'=>'html'],
['header'=>Yii::t('app','Complainant Details'),
'attribute'=>'name_hi',
'value'=>function($model,$key,$index,$column)
{
       return $model['cname']."<br/>".$model['fname']."<br/>".$model['address']."<br/>".$model['mobileno'];
},
'format'=>'html'
],
/*
['header'=>Yii::t('app','Father/Husband Name'),
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model['fname'];
},],['header'=>Yii::t('app','Mobile No'),
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model['mobileno'];
},],
*/
['header'=>Yii::t('app','District'),
'attribute'=>'dname',
'value'=>function($model,$key,$index,$column)
{
                return $model['dname'];
},],
['header'=>Yii::t('app','Block'),
'attribute'=>'bname',
'value'=>function($model,$key,$index,$column)
{
                return $model['bname'];
},],

['header'=>Yii::t('app','Panchayat'),
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return $model['panchayat'];
},],
['header'=>Yii::t('app','Action Taken'),
//'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                $wdr=WorkdemandReport::find()->where(['work_demand_id'=>$model['id']])->one();
                return $wdr?(($wdr->complainttrue==1)?$wdr->workname.'-'.$wdr->work_id:$wdr->description):'';
},],

       ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{filereport}',
            'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id'],'markingid'=>$model['markingid']];
                $params[0] = '/complaint/workdemand'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
                'filereport'=>function($url,$model,$key)
                {
                 if ($model['markingid']!=null)
                  return Html::a('<button class="btn btn-success">'.'File Report'.'</button>',$url.'&returnurl='.urlencode(Url::to(['/complaint/workdemand/my'])),['class'=>'reply-form','data-pjax'=>1]);
                else
                  return Html::a('<button class="btn btn-success">'.'Mark Officer'.'</button>',Url::to(['/complaint/workdemand/update?id='.$model['id']]).'&returnurl='.urlencode(Url::to(['/complaint/workdemand/my'])));
      
                }
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
