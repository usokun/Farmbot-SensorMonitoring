<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoraNpkT $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lora-npk-t-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_group_id')->textInput() ?>

    <?= $form->field($model, 'T')->textInput() ?>

    <?= $form->field($model, 'H')->textInput() ?>

    <?= $form->field($model, 'PH')->textInput() ?>

    <?= $form->field($model, 'N')->textInput() ?>

    <?= $form->field($model, 'P')->textInput() ?>

    <?= $form->field($model, 'K')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
