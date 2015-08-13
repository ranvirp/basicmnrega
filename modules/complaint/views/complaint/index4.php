 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintSearch;
use yii\widgets\Pjax;
use yii\widgets\PjaxAsset;
//\app\assets\AppAssetGoogle::register($this);

 ?>
 

 <div class="form-title">
        <div class="form-title-span">
         <span><?= $title ?></span>
        </div>
    </div>
  <?php 
  PjaxAsset::register($this) ;
/*
  yii\widgets\ActiveFormAsset::register($this);
  $this->registerJs(
   'flag=0;$("document").ready(function(){ 
        //$("#complaint-list").on("pjax:end", function() {
        //console.log(flag);
        //if (flag==1)
         // $("#complaint-grid-view").yiiGridView("applyFilter");


            //$.pjax.reload({container:"#complaint-subtypes"});  //Reload GridView
       // });
    });'
);

  
  <script>
   function changeparams(elem,selector)
   {
   var y='<style>.no-print{visibility: screenonly;}#grid-table{border:1px}</style>';
    var x= $(selector)[0].outerHTML;
    x=x.replace(/(['"])/g, "&quot;");
    var p=new Object
    p.html=x
    elem.data('params',p);
    //console.log(elem.data());
    
   }
  </script>
  */
  ?>
  <?php 
  Pjax::begin(['id'=>'complaint-lists','enablePushState'=>false]);
  
  ?>
  <p><?=Html::a('Export as Pdf',Url::to(['/complaint/report/cmypdf?'.Yii::$app->request->queryString]))?>
  <?php //['onclick'=>'changeparams($(this),"#grid-table");','data'=>['method'=>'post','params'=>['html'=>'test"hi""HI""']]])
  ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'complaint-grid-view',
       // 'filterModel' => $searchModel,
       /*
       'panel' => [
'type' => GridView::TYPE_PRIMARY,
],
'exportConfig'=>['pdf'=>['mode'=>'UTF-8']],
       'toolbar'=>['{export}'],
       */
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
['header'=>'<p style-"font-family:ind_hi_1_001;">'.Yii::t('app','Complaint Type').'</p>',
'value'=>function($model,$key,$index,$column)
{
      return $model['ctype'];
       
},],
['header'=>Yii::t('app','Description'),
'value'=>function($model,$key,$index,$column)
{
      
         return $model['desc'];
       
       
},],
['header'=>Yii::t('app','Action Taken'),
 'contentOptions'=>['class'=>'no-print','style'=>'scrpll'],
 'value'=>function($model,$key,$index,$column)
{
      /*
        $reply= \app\modules\complaint\models\ComplaintReply::lastReply($model['markingid']);
        if ($reply) return $this->render('_reply',['reply'=>$reply]);
                else return 'No Action Taken';
        */
        
        $replies=\app\modules\complaint\models\ComplaintReply::find()->where(['marking_id'=>$model['markingid']]);
        return $this->render('list',['replies'=>$replies]);
       
},'format'=>'raw'],
            ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{simple}',
              'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/complaint'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
               'simple'=>function($url,$model,$key)
               {
                if (Yii::$app->user->can('complaintagent') || Yii::$app->user->can('complaintadmin'))
                  return \yii\helpers\Html::a('Take Action','#',['id'=>$model['id'].'-action','onclick'=>'$(\'#complaint-panel-div\').html();populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/complaint/?id='.$model['id'].'&markingid='.$model['markingid']]).'\',\'complaint-panel-div\');return false;']);
                else
                {
                  if ($model['markingstatus']<$model['markingstatustarget'])
                  return \yii\helpers\Html::a('Take Action','#',['id'=>$model['markingid'].'-action','onclick'=>'$(\'#complaint-panel-div\').html();populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/?id='.$model['id'].'&markingid='.$model['markingid']]).'\',\'complaint-panel-div\');return false;']);
                 else
                   return '<p> Nothing to be done</p>';
                 }
               },
                'reqaction'=>function($url,$model,$key)
                {
                  $statuses=Complaint::statusNames();
                  $x=$statuses[$model['complaintstatus']]."<br/>";
                 if ($model['flowtype']==1)
                 {
                 if ($model['complaintstatus']==Complaint::PENDING_FOR_ENQUIRY)
                  return Html::a('<button class="btn btn-success">'.'File Enquiry Report'.'</button>',Url::to(['/complaint/complaint/filereport?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                  else  if ($model['complaintstatus']==Complaint::PENDING_FOR_ATR)
                  return $x.Html::a('<button class="btn btn-success">'.'File ATR'.'</button>',Url::to(['/complaint/complaint/fileatr?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                  else 
                    if (Yii::$app->user->can('complaintadmin') && $model['complaintstatus']=Complaint::ATR_RECEIVED)
                     return $x.Html::a('<button class="btn btn-success">'.'Mark As Disposed'.'</button>',Url::to(['/complaint/complaint/view?id='.$model['id']]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                     else
                      return '';
                }
                },
                'reply'=>function($url,$model,$key)
                {
                if ($model['flowtype']==0)
                {
                 $statuses=Complaint::statusNames();
                  $x=$statuses[$model['complaintstatus']]."<br/>";
             //   $x.=  Html::a('Quick Reply',Url::to(['/reply/default/create?ct=marking&ctid='.$model['markingid']]),['class'=>'reply-form','onclick'=>"$(document).pjax('a.reply-form','#new-container-".$key."')"]);
               $x.=  Html::a('Quick Reply',Url::to(['/complaint/complaint/filereply?id='.$model['id'].'&markingid='.$model['markingid']]),['class'=>'reply-form','data-pjax'=>1]);
               
                 
                 return $x;
                 }
                 else return '';
                 // return "<div style='max-height:50px'>".$this->render('reply',['id'=>$model['id'],'model'=>new \app\modules\Complaint\models\ComplaintReply,'markingid'=>$model['markingid']])."</div>";
                },
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-bordered','id'=>'grid-table'],
        ]); ?>
        Pjax::end();
     