<form method="GET">
<?php
 $url="'/".Yii::getAlias('@web')."/jsons/"."'+$(this).val()+'.json'";
			
echo \yii\helpers\Html::dropDownList('district',$district,\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\District::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en'),['prompt'=>'None','onchange'=>'populateDropdown("'.Yii::getAlias('@web')."/jsons/".'"+$(this).val()+".json","block")']);
echo \yii\helpers\Html::dropDownList('block',$block,\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->orderBy('name_en desc')->where(['district_code'=>$district])->asArray()->all(),'code','name_en'),['id'=>'block']);
echo '<button type="submit" value="Submit">Submit</button>';
echo '</form>';
echo '<div id="portfoliowrap">';
        echo yii\widgets\ListView::widget([
'dataProvider'=>$dataProvider,
'itemView'=>function($photo,$key,$index,$widget)
{
          return '		
				   
				<div class="col-md-6" style="margin-bottom:15px">
 <img height="250px" width="100%" alt="'.$photo->id.'" title="'.$photo->title.'" src="'.$photo->url.'"></img>
 <p class="text-center">'.$photo->id.'.'.$photo->title.'<p class="text-center"><strong>Panchayat -</strong>'.$photo->panchayat.'
 <strong>Block -</strong>'.$photo->block.' <strong>District -</strong>'.$photo->district.'</p>
 <p class="text-center"> <strong>Work Id -</strong>'.$photo->bwid.'
</div>'
						
				;
}        
 ]);        
                    
            
        echo '
	 </div>';