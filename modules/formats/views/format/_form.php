<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\formats\models\Format */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_format").on("pjax:end", function() {
            $.pjax.reload({container:"#formats"});  //Reload GridView
        });
    });'
);
?>
<style>
.parameters>div {
    border:1px solid;
    min-height:10px;
}
</style>
<script>

function addParameters(noofp)
{
   // var sprintf = require("sprintf-js").sprintf;
   var div2="<div class='row parameters' row-n='%1\$s'>  \
              <div class='col-sm-1'>%1\$s</div> \
              <div class='col-sm-4'><input class='hindiinput' name='label_hi[%1\$s]'></div> \
              <div class='col-sm-4'><input name='label_en[%1\$s]'></div> \
              <div class='col-sm-2'><select name='type[%1\$s]' type-n='%1\$s' OnChange='addRow($(this))'> \
<option value='n' >Numeric</option> \
<option value='d'>Dropdown</option> \
<option value='c'>Calculated</option> \
<option value='t'>Text</option> \
</select> </div> \
<div class='col-sm-1'><input type='radio' value='%1\$s' name='keyvalue'/>\
              </div>";
    var div1="<div class='row parameters'>  \
              <div class='col-sm-1'>Column</div> \
              <div class='col-sm-4'>Label in Hindi</div> \
              <div class='col-sm-4'>Label in English</div> \
              <div class='col-sm-2'>Type </div> \
              <div class='col-sm-1'>Key? <input type='radio' value='0' name='keyvalue'/></div> \
              </div>";
    $('#parameters').html('');
    $('#parameters').append(div1);
    for(i=1;i<=noofp;i++)
    {
      $('#parameters').append( sprintf(div2,i));  
    }
}
function addRow(th)
{
    if (th.val()==='d') {
        th.parent().find('.addon').remove();
        th.parent().append('<div class="addon">Dropdown values here(one per line):<br><textarea  name="dropdown['+th.attr('type-n')+']"></textarea></div>');
    } else if (th.val()==='c') {
        th.parent().find('.addon').remove();
        th.parent().append('<div class="addon">Formula here(in sprintf format):<input  name="calculated['+th.attr('type-n')+']"></input></div>');
    } 
    else
        th.parent().find('.addon').remove();
}
</script>
<div class="bordered-form format-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Format</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action'=>Url::to(['/formats/format/create']),
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>

   
    <?= $model->showForm($form,"label_hi") ?>

    <?= $model->showForm($form,"label_en") ?>
    <div class="form-group">
        <label class="control-label col-sm-4" for="noofp">No of Columns</label><div class="col-sm-8"><input id="noofp" class="form-control" name="noofp"><button onclick="addParameters($('#noofp').val());return false;">Add</button></div></div>

   <div id="parameters">
   </div>
   

<?php
/*
try {
$x= Utility::rules()["app\modules\formats\models\Format"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("Format");
		if ($x && $model && array_key_exists($changeattribute,$modelArray) && array_key_exists($modelArray[$changeattribute],$x))
		{
			$attribute_value=$modelArray[$changeattribute];
			
			foreach ($x[$attribute_value]["show"] as $field)
			{
			  
				echo "<div class=\"row\">\n";
			
				echo $model->showForm($form,$field);
				echo "</div>";
			
			}
		}
**/
?>    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
