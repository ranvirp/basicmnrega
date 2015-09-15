<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\reply\widgets;
use Yii;
use yii\helpers\Html;

/**
 * Description of FileWidget
 *
 * @author Ranvir Prasad<ranvir.prasad@gmail.com>
 */
class FileWidget  extends \yii\base\Widget{
	//put your code here
	public $model;
	public $attribute;
	public $name='';
	public function run() {
		parent::run();
		$model=$this->model;
		$attribute=$this->attribute;
		// Normal parent select
		$lang=Yii::$app->language;
	$modelName=\yii\helpers\StringHelper::basename(get_class($model));	
	//echo '<style> .file-drop-zone{height:0%}</style>';
	$y=[];
	$z1='';	
	//$attribute=Html::getAttributeName($attribute);
	//echo $model->$attribute;
	
	if (! is_array(Html::getAttributeValue($model, $attribute)))
	{
		foreach (explode(",",Html::getAttributeValue($model, $attribute)) as $id)
		{
		if (is_numeric($id))
		{
			$file = \app\modules\reply\models\File::findOne($id);
			if ($file)
			{
				$z1 .= "<input type=hidden name='".
			Html::getInputName($model,$attribute).'[]'."' value=\"".$file->id.'">'."\n";
				//echo '<div>'.$z1.'</div>';
				
			if ($file->mime=='img/jpeg')
				$y[]=Html::img($file->url,['class'=>'file-preview-image','title'=>$file->title]);
			else $y[]='<a href="'.$file->url.'">'.$file->title.'</a>';
			}
			}
		}
	}
	echo '<style>';
	echo ".file-preview-frame{height:5px;}";
	echo '</style>';
	echo '<div class="col-lg-12">';
	
 echo \kartik\file\FileInput::widget( [
	'model'=>$model,
	'attribute'=>$attribute.'[]',
    'options' => ['multiple' => true],
	'pluginOptions'=>
	[
		'uploadUrl'=>  yii\helpers\Url::to(['/reply/file/upload']),
		
		'uploadExtraData'=>['model'=>get_class($model),'attribute'=>$attribute],
		'browseLabel'=>'Select files',
		'dropZoneEnabled'=>false,
		'showPreview'=>true,
		//'showCaption' => false,
        'showRemove' => true,
        'showUpload' => true,
        //'browseClass' => 'btn btn-primary btn-block',
        //'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        //'browseLabel' =>  'Select Photo',
		'previewSettings'=>['image'=>['width'=>"75px",'height'=>'75px']],
		 'initialPreview'=>$y,
        'overwriteInitial'=>false,
		//'previewTemplates'=>[],
		'layoutTemplates'=>[
		  'footer'=>'<div class="file-thumbnail-footer">' .
        '    <div class="file-caption-name">{caption}</div>' .
        '    {actions}' .
        '<div>Title:<input class="activeInput hindiinput" name="title[{fileindex}]" id="title-{fileindex}" onClick="js:hindiEnable()" /></div>'
       	.'</div>'
		  ],
	],
	 
	     'pluginEvents' => [
            "filepreupload" => "function(event, data, previewId, index) {
               var form = data.form, files = data.files, extra = data.extra,
               response = data.response, reader = data.reader;
               var  flag=false;
               $('.activeInput').each(function() {
               if ($(this).val()=='') {
               alert('Title of file compulsory.');
               $(this).focus();
               flag=true;
              
               }
               
                 data.form.append($(this).attr('name'),$(this).val());
               });
               if (flag==true) 
               {
               
               
               return {message:'title compulsory',data:{}};
               }

             }",
			   "fileuploaded" => "function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;

                for (ind=0;ind<data.response.length;ind++)
                 {
                  //alert(data.response[ind]);
                  $('#".Html::getInputId($model,$attribute).'_hi'."').append('<input type=hidden name=".
			      Html::getInputName($model,$attribute).'[]'." value=\"'+data.response[ind]+'\">');
                 }

                 }",
                 'filecustomerror'=>"function(event,params){}",
    
    ],
	  
]); 
 //echo $z1;
 echo '<div id="'.Html::getInputId($model,$attribute).'_hi" >'.$z1.'</div>';
 echo '</div>';
 
 
	}
	
}
