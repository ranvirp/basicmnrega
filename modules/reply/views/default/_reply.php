<?php
use \kartik\helpers\Enum;
?>
<style>
.comment-author
{
 border-bottom: 1px solid;
    display: block;
    padding: 5px;
    font-style:italics;
}
.comment-body
{
 
}
.comment-container
{
 background:white;
 border:1px solid;
 border-radius:2px;
}
</style>
 <div class="col-md-8 comment-container">
	<p class="comment-author">
		<csmall>Posted by <?php $user=\app\modules\users\models\Designation::findOne($reply->author_id);
		    $name='name_'.Yii::$app->language;
			echo $user?$user->$name:'';?></csmall>|
		<csmall2>Posted  <?=\kartik\helpers\Enum::timeElapsed(date("F j, Y, g:i a",$reply->create_time))?></csmall2>
		
	</p>
	<p class="comment-body">
	<?=$reply->content?>
		
	</p>
		<div class="pull-right">
		<h4> Attachments</h4>
		<div class="hline"></div>
		<p></p>
			<?=\app\modules\reply\models\File::showAttachmentsInline($reply,'attachments')?>
		</div>
	   </div>
	

</div>
	
