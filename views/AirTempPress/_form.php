<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AirTempPressT $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="air-temp-press-t-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_group_id')->textInput() ?>

    <?= $form->field($model, 'ATemp')->textInput() ?>

    <?= $form->field($model, 'APress')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
