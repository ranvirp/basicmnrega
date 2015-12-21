<form action='<?=\yii\helpers\Url::to(['/formats/format/post'])?>' method="POST">
	<?=$form?>
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<?=\yii\helpers\Html::submitButton('Submit')?>
</form>