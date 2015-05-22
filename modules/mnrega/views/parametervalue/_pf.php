<?php
use \app\modules\mnrega\models\District;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//district parameter_name parameter_value 
NavBar::begin([
                //'brandLabel' => 'KESCO',
                //'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions'=>['class'=>'no-padding no-margin'],
                'options' => [
                    'class' => 'navbar navbar-default no-margin',
                ],
            ]);
            
  $form = ActiveForm::begin([
    'layout' => 'horizontal',
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
]); 
echo '<table class="small table table-striped">';
echo '<tr><th>District</th><th>'.$parameter->name_en.'</th></tr>';
//echo'<tr><td>'.\kartik\
foreach (District::find()->orderBy('district_name asc')->asArray()->all() as $district)
  {
     echo '<tr>';
     echo '<td>';
     echo Html::label($district['district_name']); 
     //echo Html::hiddenInput("p[][".$district['district_code']."]",$district['district_code']);
     echo '</td>';
     echo '<td>';
    // echo Html::label($parameter->name_en); 
     echo Html::textInput("p[".$district['district_code']."][".$parameter->id."]");
     echo '</td>';
     echo '</tr>';
     }
     echo Html::submitButton('Save');
     ActiveForm::end();
     echo '</table>';
?>