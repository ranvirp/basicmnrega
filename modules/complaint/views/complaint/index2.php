<?php
 use yii\helpers\Html;
 use yii\helpers\Url;
 use yii\helpers\ArrayHelper;

use yii\grid\GridView;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\Complaint_type;

use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;

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
             [
              'header'=>Yii::t('app','Complaint Type'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return Html::a($model->id,Url::to(['/complaint/complaint/view?id='.$model->id]));
                      },
             'attribute'=>'id',
             'format'=>'html'
            ],
            'name_hi',
            'fname',
            'mobileno',
            [
              'header'=>Yii::t('app','Complaint Type'),
             'value'=>function ($model,$key,$index,$column)
                      {
                      
                      },
             'attribute'=>'complaint_type',
             'filter'=>ArrayHelper::map(Complaint_type::find()->asArray()->all(),'code','name_hi'),
            ],
             'description',
              [
              'header'=>Yii::t('app','District'),
             'value'=>function ($model,$key,$index,$column)
                      {
                         return District::findOne($model->district_code)->name_en;
                      },
             'attribute'=>'district_code',
             'filter'=>ArrayHelper::map(District::find()->asArray()->all(),'code','name_en'),
            ],
             [
              'header'=>Yii::t('app','Block'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return Block::findOne($model->block_code)->name_en;
                      },
             'attribute'=>'block_code',
             'filter'=>ArrayHelper::map(District::find()->asArray()->all(),'code','name_en'),
            ],
              [
              'header'=>Yii::t('app','Status'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return Complaint::statusNames()[$model->status];
                      },
             'attribute'=>'status',
             'filter'=>Complaint::statusNames(),
            ],
               ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{reqaction}',
            
              'buttons'=>[
                'reqaction'=>function($url,$model,$key)
                {
                 if ($model->status==Complaint::PENDING_FOR_ENQUIRY)
                  {
                    $x='';
                    foreach ($model->markings as $marking)
                    {
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
                    $x.=Html::a('<button class="btn btn-success">'.'File ATR for'.$marking->receiver1->name_en.'</button>',Url::to(['/complaint/complaint/fileatr?id='.$model->id]).'&markingid='.$marking->id.'&returnurl='.urlencode(Url::to(['/complaint/complaint'])));
                    }
                    return $x;
                  }
                     else if ($model->status==Complaint::ATR_RECEIVED)
                       {
                        $x='';
                    foreach ($model->markings as $marking)
                    {
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