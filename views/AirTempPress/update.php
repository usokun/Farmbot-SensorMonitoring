<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AirTempPressT $model */

$this->title = 'Update Air Temp Press T: ' . $model->val_id;
$this->params['breadcrumbs'][] = ['label' => 'Air Temp Press Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->val_id, 'url' => ['view', 'val_id' => $model->val_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="air-temp-press-t-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
