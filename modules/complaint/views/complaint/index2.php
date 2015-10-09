<?php
 use yii\helpers\Html;
 use yii\helpers\Url;
 use yii\helpers\ArrayHelper;

use yii\grid\GridView;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\Complaint_type;

use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use yii\widgets\Pjax;

 ?>
  <?php 
     $source=Yii::$app->request->get('source');
     $ctype=Yii::$app->request->get('ComplaintSearch')['complaint_type'];
        $queryString=Yii::$app->request->queryString; ?>

 <script>
 $(document).ready(function(){
$('#source').change(function(){ jQuery('#w0').yiiGridView({"filterUrl":"<?= Url::to(['/complaint/complaint/index']) ?>?<?=$queryString ?>","filterSelector":"#w0-search input, #w0-search select"});});
 $('#ctype').change(function(){ jQuery('#w0').yiiGridView({"filterUrl":"<?= Url::to(['/complaint/complaint/index']) ?>?<?=$queryString ?>","filterSelector":"#w0-search input, #w0-search select"});});

 });
 </script>
 <div id="w0-search" class="">
  Filter by Source: <?=Html::dropDownList('source',$source,Complaint::source(),['id'=>'source','prompt'=>'None'])?>
  Type: <?=Html::dropDownList('ComplaintSearch[complaint_type]',$ctype,ArrayHelper::map(Complaint_type::find()->asArray()->all(),'shortcode','name_hi'),['id'=>'ctype','prompt'=>'None'])?>
 </div>
 <div class="form-title">
        <div class="form-title-span">
         <span>List of Complaints</span>
        </div>
    </div>
    <?php $dataProvider->query=$dataProvider->query->with('enquiryOfficer')->with('atrOfficer');?>
    <?php Pjax::begin(['enablePushState'=>false, 'id'=>'complaint-lists']);?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'afterRow'=>function($model, $key, $index, $grid)
                     {
                       return '<tr><td colspan="5">'.($model->enquiryOfficer?Yii::t('app','Enquiry Officer').':'.$model->enquiryOfficer->receiver_name:'').
                       ($model->atrOfficer?Yii::t('app','ATR Officer').':'.$model->atrOfficer->receiver_name:'').'</td></tr>';
                     },
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
              'label'=>Yii::t('app','Id'),
             'value'=>function ($model,$key,$index,$column)
                      {
                       $sources=Complaint::source();
                        return Html::a($model->id,Url::to(['/complaint/complaint/view?id='.$model->id]))."<br>".
                               Yii::t('app','Source').':'.Yii::t('app',$sources[$model->source]);
                      },
             'attribute'=>'id',
             'format'=>'html'
            ],
            ['label'=>Yii::t('app','Complainant'),
             'attribute'=>'name_hi',
             'value'=>function ($model,$key,$index,$column)
                      {
                      return $model->showValue('name_hi')."<br>".$model->showValue('fname')
                      .$model->showValue('mobileno');
                      },
              'format'=>'html'
             ],
             ['header'=>Yii::t('app','Mobile No'),
             'attribute'=>'mobileno',
             'value'=>function ($model,$key,$index,$column)
                      {
                      return 
                      $model->showValue('mobileno');
                      },
             
             ],
            
            [
              'header'=>Yii::t('app','Complaint'),
              'contentOptions'=>['class'=>'scrollable'],
             'value'=>function ($model,$key,$index,$column)
                      {
                       return '<strong>'.$model->showValue('complaint_type').'</strong>'."<br>".
                        $model->showValue('description');
                      },
             'attribute'=>'complaint_type',
             'format'=>'html',
             'filter'=>ArrayHelper::map(Complaint_type::find()->asArray()->all(),'code','name_hi'),
            ],
             
              [
              'header'=>Yii::t('app','District'),
             'value'=>function ($model,$key,$index,$column)
                      {
                         return $model->district->name_en;
                      },
             'attribute'=>'district_code',
             'filter'=>ArrayHelper::map(District::find()->asArray()->orderBy('name_en asc')->all(),'code','name_en'),
            ],
             [
              'header'=>Yii::t('app','Block'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return $model->block?$model->block->name_en:'';
                      },
             'attribute'=>'block_code',
             'filter'=>ArrayHelper::map(Block::find()->asArray()->all(),'code','name_en'),
            ],
              [
              'label'=>Yii::t('app','Status').'/last action time',
             'value'=>function ($model,$key,$index,$column)
                      {
                        $status=Complaint::statusNames();
                        return $status[$model->status].($model->lastactiontime?date('d/m/Y',$model->lastactiontime):'');
                      },
             'attribute'=>'lastactiontime',
             'filter'=>Complaint::statusNames(),
            ],
               ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{simple}',
            
              'buttons'=>[
				  'simple'=>function($url,$model,$key)
					  {
						  
					  return \yii\helpers\Html::a('Take Action','#',['id'=>$model->id.'-action','onclick'=>'$(\'#complaint-panel-div\').html();populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/complaint?id='.$model->id]).'\',\'complaint-panel-div\');return false;']);
	  
				  },
                'reqaction'=>function($url,$model,$key)
                {
                
                 if ($model->status==Complaint::PENDING_FOR_ENQUIRY)
                  {
                    $x='';
                    foreach ($model->markings as $marking)
                    {
                    if($marking->receiver1)
                    $x.=Html::a('<button class="btn btn-success">'.'File Enquiry Report for'.$marking->receiver1->name_en.'</button>',Url::to(['/complaint/complaint/filereport?id='.$model->id]).'&markingid='.$marking->id.'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                    }
                    return $x;
                  }
                    else if ($model->status==Complaint::REGISTERED)
                       return Html::a('<button class="btn btn-success">'.'Mark to Officer'.'</button>',Url::to(['/complaint/complaint/update?id='.$model->id]).'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                 else  if ($model->status==Complaint::PENDING_FOR_ATR)
                    {
                    $x='';
                    foreach ($model->markings as $marking)
                    {
                                        if($marking->receiver1)

                    $x.=Html::a('<button class="btn btn-success">'.'File ATR for'.$marking->receiver1->name_en.'</button>',Url::to(['/complaint/complaint/fileatr?id='.$model->id]).'&markingid='.$marking->id.'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                    }
                    return $x;
                  }
                     else if ($model->status==Complaint::ATR_RECEIVED)
                       {
                        $x='';
                    foreach ($model->markings as $marking)
                    {
                                        if($marking->receiver1)

                    $x.=Html::a('<button class="btn btn-success">'.'Mark Disposed for'.$marking->receiver1->name_en.'</button>',Url::to(['/complaint/complaint/markstatus?s=8&id='.$model->id]).'&markingid='.$marking->id.'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                    }
                    return $x;
                       }
                  /*
                  else  if ($model->status==Complaint::PENDING_FOR_ATR)
                  return Html::a('<button class="btn btn-success">'.'File ATR'.'</button>'.Url::to(['/complaint/complaint/fileatr?id='.$model->id]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                   else if ($model->status==Complaint::ATR_RECEIVED)
                  return Html::a('<button class="btn btn-success">'.'Mark Disposed'.'</button>'.Url::to(['/complaint/complaint/markstatus?s=8&id='.$model->id]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                    else if ($model->status==Complaint::REGISTERED)
                  return Html::a('<button class="btn btn-success">'.'Mark to Officer'.'</button>'.Url::to(['/complaint/complaint/update?id='.$model->id]).'&markingid='.$model['markingid'].'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                 */ 
                }
              ],
              ],
        ]])
        
    ?>
    <?php Pjax::end();?>