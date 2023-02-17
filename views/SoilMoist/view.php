<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SoilMoistT $model */

$this->title = $model->val_id;
$this->params['breadcrumbs'][] = ['label' => 'Soil Moist Ts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="soil-moist-t-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'val_id' => $model->val_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'val_id' => $model->val_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'val_id',
            's_group_id',
            'SMoist',
            'time:datetime',
        ],
    ]) ?>

</div>
