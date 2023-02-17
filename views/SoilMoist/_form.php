<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SoilMoistT $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="soil-moist-t-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_group_id')->textInput() ?>

    <?= $form->field($model, 'SMoist')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
