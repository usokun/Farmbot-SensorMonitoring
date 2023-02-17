<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SoilMoistT $model */

$this->title = 'Update Soil Moist T: ' . $model->val_id;
$this->params['breadcrumbs'][] = ['label' => 'Soil Moist Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->val_id, 'url' => ['view', 'val_id' => $model->val_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soil-moist-t-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
