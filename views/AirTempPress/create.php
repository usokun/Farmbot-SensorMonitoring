<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AirTempPressT $model */

$this->title = 'Create Air Temp Press T';
$this->params['breadcrumbs'][] = ['label' => 'Air Temp Press Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="air-temp-press-t-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
