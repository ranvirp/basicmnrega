<?php
use \kartik\helpers\Enum;
use app\modules\complaint\models\ComplaintReply;
?>
<div class="reply-view">
<div class="container-fluid">
<div class="col-md-12 reply-type">
<?php
echo 'Id #'.$model->id.' ';
 $types=ComplaintReply::types();
 echo $types[$model->reply_type];
?>
</div>
 	<div class="col-md-12  reply-author">
 		<small>Posted by <?php $user=\app\modules\users\models\Designation::getDesignationByUser($model->author,true);
		    $name='name_'.Yii::$app->language;
			echo $user?$user->$name:'';?>|
			
		<?=date("F j, Y, g:i a",$model->created_at)
		//\kartik\helpers\Enum::timeElapsed(date("F j, Y, g:i a",$model->created_at))
		?></small>
		
	</div>
</div>
	<div class="container-fluid well">
	<p>
	<?=$model->reply?>
		
	</p>
	<?php if ($model->attachments!='') {?>
		<div class="comment-attachments">
		 <p style="text-align:center"><b><?=Yii::t('app','Attachments') ?></b></p>
		<div class="hline"></div>
			<?=\app\modules\reply\models\File::showAttachmentsInline($model,'attachments')?>
		
		</div>
	<?php } ?>
</div>
</div>