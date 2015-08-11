<?php
use yii\widgets\ActiveForm;
use app\modules\users\models\DesignationType;
\app\assets\AppAssetGoogle::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form',
'options'=>['data-pjax'=>1]
]); ?>
   <?=$this->render('../complaint/singlemarkingform',['form'=>$form,'modelComplaint'=>$modelComplaint,'change'=>$change])?>


 <div class="form-group">
    <?= \yii\helpers\Html::submitButton( 'Create' , ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>