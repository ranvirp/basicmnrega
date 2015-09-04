    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $models[0],
        'formId' => 'dynamic-form',
        'formFields' => $formfields,
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-zoom-in"></i> <?=$title?> 
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
            <?php foreach ($models as $i => $model): ?>
                <div class="item panel panel-default" item-index="{$i}" id="item-{$i}"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><?=$title1?></h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $model->isNewRecord) {
                                echo Html::activeHiddenInput($model, "[{$i}]id");
                            }
                        ?>
                        <?php 
                        $url=Url::to(['/complaint/complaint_subtype/get?code=']);
                        ?>
                        
                       <div class="row">
                           <div class="col-sm-6">
                            <?= $form->field($modelComplaintPoint, "[{$i}]complaint_type")->dropDownList(ArrayHelper::Map(Complaint_type::find()->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None','onChange' => 'populateDropdown("'.$url.'"+$(this).val(),"complaintpoint-"+_count1($(this))+"-complaint_subtype")']) ?>
                           </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelComplaintPoint, "[{$i}]complaint_subtype")->dropDownList(ArrayHelper::Map(Complaint_subtype::find()->where(['complaint_type_code'=>$modelComplaintPoint->complaint_type])->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None']) ?>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($modelComplaintPoint, "[{$i}]description")->textArea(['onclick' => 'hindiEnable($(this))']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelComplaintPoint, "[{$i}]attachments")->widget(\app\modules\reply\widgets\FileWidget::classname())?>
                            </div>
                            
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>