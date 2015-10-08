<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="correspondence-default-index">
    <ul>
        <li><?= Html::a('Mark Correspondence',Url::to(['/corr/marking']))?></li>
    </ul>
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
