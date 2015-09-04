<?php
 use yii\helpers\Html;
 use yii\helpers\Url;
 use yii\helpers\ArrayHelper;

use yii\grid\GridView;
use app\modules\complaint\models\WorkDemand;

use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use yii\widgets\Pjax;

 ?>
 <div class="form-title">
        <div class="form-title-span">
         <span>List of Work Demand</span>
        </div>
    </div>
    <?php Pjax::begin(['enablePushState'=>false, 'id'=>'complaint-lists']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
              'header'=>Yii::t('app','Id'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return Html::a($model->id,Url::to(['/complaint/workdemand/view?id='.$model->id]));
                      },
             'attribute'=>'id',
             'format'=>'html'
            ],
            ['header'=>Yii::t('app','Complainant'),
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
              'header'=>Yii::t('app','District'),
             'value'=>function ($model,$key,$index,$column)
                      {
                         return District::findOne($model->district_code)->name_en;
                      },
             'attribute'=>'district_code',
             'filter'=>ArrayHelper::map(District::find()->asArray()->orderBy('name_en asc')->all(),'code','name_en'),
            ],
             [
              'header'=>Yii::t('app','Block'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        return Block::findOne($model->block_code)->name_en;
                      },
             'attribute'=>'block',
            ],
             [
              'header'=>Yii::t('app','Panchayat'),
             
             'attribute'=>'panchayat',
            ],
              [
              'header'=>Yii::t('app','Status'),
             'value'=>function ($model,$key,$index,$column)
                      {
                        $status=WorkDemand::statusNames();
                        if (array_key_exists($model->status,$status))
                        return $status[$model->status];
                        else
                         return 'Pending';
                      },
             'attribute'=>'status',
             'filter'=>WorkDemand::statusNames(),
            ],
              
              ],
        ])
        
    ?>
    <?php Pjax::end();?>