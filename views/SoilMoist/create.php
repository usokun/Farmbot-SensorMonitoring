<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SoilMoistT $model */

$this->title = 'Create Soil Moist T';
$this->params['breadcrumbs'][] = ['label' => 'Soil Moist Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soil-moist-t-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
