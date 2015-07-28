<?php
use \kartik\helpers\Enum;
?>

 	<p class="comment-author">
		<small>Posted by <?php $user=\app\modules\users\models\Designation::getDesignationByUser($reply->author,true);
		    $name='name_'.Yii::$app->language;
			echo $user?$user->$name:'';?>|
		<?=\kartik\helpers\Enum::timeElapsed(date("F j, Y, g:i a",$reply->created_at))?></small>
		
	</p>
	<p class="comment-body">
	<?=$reply->reply?>
		
	</p>
	<?php if ($reply->attachments!='') {?>
		<div class="comment-attachments">
		 <p style="text-align:center"><b><?=Yii::t('app','Attachments') ?></b></p>
		<div class="hline"></div>
			<?=\app\modules\reply\models\File::showAttachmentsInline($reply,'attachments')?>
		
		</div>
	<?php } ?>

	
