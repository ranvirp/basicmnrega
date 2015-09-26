<form method="GET">
<?php
\yii\widgets\PjaxAsset::register($this);

 $url="'/".Yii::getAlias('@web')."/jsons/"."'+$(this).val()+'.json'";
			
echo \yii\helpers\Html::dropDownList('district',$district,\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\District::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en'),['prompt'=>'None','onchange'=>'populateDropdown("'.Yii::getAlias('@web')."/jsons/".'"+$(this).val()+".json","block")']);
echo \yii\helpers\Html::dropDownList('block',$block,\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->orderBy('name_en desc')->where(['district_code'=>$district])->asArray()->all(),'code','name_en'),['id'=>'block']);
echo '<button type="submit" value="Submit">Submit</button>';
echo '</form>';
\yii\widgets\Pjax::begin(['id'=>'rating-div','timeout'=>false]);
\yii\widgets\Pjax::end();
echo '<div id="portfoliowrap">';
        echo yii\widgets\ListView::widget([
'dataProvider'=>$dataProvider,
'itemView'=>function($photo,$key,$index,$widget)
{
$workrating=\app\modules\work\models\WorkRating::find()->where(['work_type'=>'pond','workid'=>$photo->bwid,'photo_id'=>$photo->id,'rating_by'=>Yii::$app->user->id])->one();
$workratings=\app\modules\work\models\WorkRating::find()->where(['work_type'=>'pond','workid'=>$photo->bwid,'photo_id'=>$photo->id])->all();
$ratingstring='<strong>Rating:</strong>';
$ratingOptions=\app\modules\work\models\WorkRating::ratingOptions();

foreach ($workratings as $workratingone)
{
 $ratingstring.=$ratingOptions[$workratingone->rating].' by '.\app\modules\users\models\User::findOne($workratingone->rating_by)->username.' ';
}
if (!$workrating)
 $workrating= new \app\modules\work\models\WorkRating;
          return '		
				   
				<div class="col-md-6" style="margin-bottom:15px">
 <img height="250px" width="100%" alt="'.$photo->id.'" title="'.$photo->title.'" src="'.$photo->url.'"></img>
 <p class="text-center">'.$photo->id.'.'.$photo->title.'<p class="text-center"><strong>Panchayat -</strong>'.$photo->panchayat.'
 <strong>Block -</strong>'.$photo->block.' <strong>District -</strong>'.$photo->district.'</p>
 <p class="text-center"> <strong>Work Id -</strong>'.$photo->bwid.'  '.$ratingstring.'
</p>
<p>'.$this->render('@app/modules/work/views/work-rating/tinyform',['photoid'=>$photo->id,'work_type'=>'pond','workid'=>$photo->bwid,'model'=>$workrating]).'</p></div>';
						
				;
}        
 ]);        
                    
            
        echo '
	 </div>';