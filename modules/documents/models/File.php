<?php

namespace app\modules\reply\models;

use Yii;

/**
 * This is the model class for table "document_file".
 *
 * @property integer $id
 * @property string $model_type
 * @property string $model_pk
 * @property integer $size
 
 * @property string $mime
 * @property string $url
 * @property string $path
 * @property string $filename
 * @property integer $uploaded_by
 * @property integer $uploaded_at
 
 */
class DocumentFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
			[['uploaded_by', 'uploaded_at'], 'integer'],
            [['url', 'path', 'filename'], 'string'],
            [[ 'document_id'], 'string', 'max' => 20],
            [['mime','uniqid'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_id' => 'Document Id',
            'size' => 'Size',
            'height' => 'Height',
            'width' => 'Width',
            'mime' => 'Mime',
            'url' => 'Url',
            'path' => 'Path',
            'filename' => 'Filename',
        ];
    }
	public static function showAttachments($model,$attribute)
	{
		$str='';
	   if ($model->$attribute)
	   {
		   $str.='<table class="table">';
		   foreach (explode(",",$model->$attribute) as $fileid)
		   {
		    if (!is_numeric($fileid)) continue;
			
			   $file=self::findOne($fileid);
			   if ($file)
			   {
				   $str.='<tr><td>'.$file->title.
					   '</td>';
				   $str.='<td>'.\yii\helpers\Html::a($file->filename,$file->url,['data'=>['pjax'=>"0"]]).
					     '</td></tr>';
			   }
		   }
		   $str.="</table>";
		     $str1='<div class="panel panel-default small">
  <div class="panel-heading">
    <h3 class="panel-title">Attachments</h3>
  </div>
  <div class="panel-body">'.
   $str.
  '</div>
</div>';
            return $str1;
	   }
	return '';
}
	public static function showAttachmentsInline($model,$attribute)
	{
		$str='';
	   if ($model->$attribute)
	   {
		   $str.='<table class="table table-striped table-bordered small">';
		   foreach (explode(",",$model->$attribute) as $fileid)
		   {
		    if (!is_numeric($fileid)) continue;
			   $file=\app\modules\reply\models\File::findOne($fileid);
			   if ($file)
			   {
				   $str.='<tr><td>'.$file->title.
					   '</td>';
				   $str.='<td>'.\yii\helpers\Html::a($file->filename,$file->url,['data'=>['pjax'=>"0"]]).
					     '</td></tr>';
			   }
		   }
		   $str.="</table>";
		     $str1='<div class="hidden-print">'.
  
   $str.
  '</div>';
            return $str1;
	   }
	return '';
}
}