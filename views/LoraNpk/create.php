<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LoraNpkT $model */

$this->title = 'Create Lora Npk T';
$this->params['breadcrumbs'][] = ['label' => 'Lora Npk Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lora-npk-t-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
