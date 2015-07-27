 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintSearch;
use yii\widgets\Pjax;
use yii\widgets\PjaxAsset;
\app\assets\AppAssetGoogle::register($this);

 ?>
 

 <div class="form-title">
        <div class="form-title-span">
         <span>List of Complaints</span>
        </div>
    </div>
  <?php 
//  PjaxAsset::register($this) ;
  yii\widgets\ActiveFormAsset::register($this);
  $this->registerJs(
   '$("document").ready(function(){ 
        $("#complaint-list").on("pjax:end", function() {
        

          // $("#complaint-grid-view").yiiGridView("applyFilter");


            //$.pjax.reload({container:"#complaint-subtypes"});  //Reload GridView
        });
    });'
);

  ?>
  <?php 
  Pjax::begin(['id'=>'complaint-list','enablePushState'=>false,'formSelector'=>'.reply-form','linkSelector'=>'.reply-form']);
  Pjax::end();
  ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'complaint-grid-view',
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
['header'=>'Id',
'attribute'=>'id',
'value'=>function($model,$key,$index,$column)
{
        return Html::a($model['id'],Url::to(['/complaint/complaint/view?id='.$model['id']]));
},
'format'=>'html'],
['header'=>Yii::t('app','Complainant Details'),
'attribute'=>'cname',
'value'=>function($model,$key,$index,$column)
{
        return $model['cname']."<br/>".$model['fname']."<br/>".$model['address']."<br/>".$model['mobileno'];
},
'format'=>'html',
],
/*
['header'=>Yii::t('app','Father/Husband Name'),
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model['fname'];
},],['header'=>Yii::t('app','Mobileno'),
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model['mobileno'];
},],
*/
['header'=>Yii::t('app','Panchayat'),
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return ucwords(strtolower($model['dname'])).'-'.ucwords(strtolower($model['bname'])).'-'.ucwords(strtolower($model['panchayat']));
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
['header'=>'Action taken',
 'value'=>function($model,$key,$index,$column)
{
      
        $reply= \app\modules\complaint\models\ComplaintReply::lastReply($model['markingid']);
        if ($reply) return $this->render('_reply',['reply'=>$reply]);
                else return 'No Action Taken';
       
},'format'=>'html'],
            ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{reply}{reqaction}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/complaint'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
                'reqaction'=>function($url,$model,$key)
                {
                 if ($model['flowtype']==1)
                 {
                 if ($model['complaintstatus']==Complaint::PENDING_FOR_ENQUIRY)
                  return Html::a('<button class="btn btn-success">'.'File Enquiry Report'.'</button>',Url::to(['/complaint/complaint/filereport?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                  else  if ($model['complaintstatus']==Complaint::PENDING_FOR_ATR)
                  return Html::a('<button class="btn btn-success">'.'File ATR'.'</button>',Url::to(['/complaint/complaint/fileatr?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                  else 
                    if (Yii::$app->user->can('complaintadmin') && $model['complaintstatus']=Complaint::ATR_RECEIVED)
                     return Html::a('<button class="btn btn-success">'.'Mark As Disposed'.'</button>',Url::to(['/complaint/complaint/view?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                     else
                      return '';
                }
                },
                'reply'=>function($url,$model,$key)
                {
                if ($model['flowtype']==0)
                {
             //   $x.=  Html::a('Quick Reply',Url::to(['/reply/default/create?ct=marking&ctid='.$model['markingid']]),['class'=>'reply-form','onclick'=>"$(document).pjax('a.reply-form','#new-container-".$key."')"]);
               $x=  Html::a('Quick Reply',Url::to(['/complaint/complaint/filereply?id='.$model['id'].'&markingid='.$model['markingid']]),['class'=>'reply-form','data-pjax'=>1]);
               
                 
                 return $x;
                 }
                 else return '';
                 // return "<div style='max-height:50px'>".$this->render('reply',['id'=>$model['id'],'model'=>new \app\modules\Complaint\models\ComplaintReply,'markingid'=>$model['markingid']])."</div>";
                },
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-bordered'],
        ]); ?>
     