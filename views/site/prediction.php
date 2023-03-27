<?php

use yii\helpers\Html;
use yii\httpclient\Client;
use kartik\grid\GridView;
use deyraka\materialdashboard\widgets\Card;

$this->title = $title;

?>
<div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
    <?php
    Card::begin([
        'id' => 'predict-table',
        'color' => Card::COLOR_INFO,
        'headerIcon' => 'table_rows',
        'collapsable' => false,
        'title' => 'Soil Moist Prediction',
        'titleTextType' => Card::TYPE_INFO,
        'showFooter' => true,
        'footerContent' => '',
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'timestamp',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model['timestamp']);
                },
            ],
            [
                'attribute' => 'temp',
                'label' => 'Forcasted Temprature'
            ],
            [
                'attribute' => 'smoist',
                'label' => 'Predicted Soil Moisture'
            ],
            [
                'attribute' => 'moist_state',
                'label' => 'Predicted Soil State'
            ],
        ],
    ]); ?>

    <?php Card::end(); ?>