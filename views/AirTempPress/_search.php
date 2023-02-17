<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AirTempPressTSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="air-temp-press-t-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'val_id') ?>

    <?= $form->field($model, 's_group_id') ?>

    <?= $form->field($model, 'ATemp') ?>

    <?= $form->field($model, 'APress') ?>

    <?= $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
