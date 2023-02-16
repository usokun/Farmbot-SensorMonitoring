<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoraNpkTSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lora-npk-t-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'val_id') ?>

    <?= $form->field($model, 's_group_id') ?>

    <?= $form->field($model, 'T') ?>

    <?= $form->field($model, 'H') ?>

    <?= $form->field($model, 'PH') ?>

    <?php // echo $form->field($model, 'N') ?>

    <?php // echo $form->field($model, 'P') ?>

    <?php // echo $form->field($model, 'K') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
