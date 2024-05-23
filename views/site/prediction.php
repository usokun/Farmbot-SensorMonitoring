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
                    // Convert milliseconds to seconds by dividing by 1000
                    $timestampInSeconds = $model['timestamp'] / 1000;

                    // Create a DateTime object with the timestamp in UTC
                    $dateTime = new DateTime('@' . $timestampInSeconds);
                    $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok')); // Set the appropriate time zone identifier

                    // Format the DateTime object as a date
                    return $dateTime->format('Y-m-d H:i:s');
                },
                'label' => 'Time'

            ],
            [
                'attribute' => 'air_temp',
                'label' => 'Forcasted Air Temprature',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'air_humidity',
                'label' => 'Forcasted Air Humidity',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'soil_humidity',
                'label' => 'Predicted Soil Moisture',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'humidity_state',
                'label' => 'Predicted Soil State'
            ],
        ],
    ]); ?>

    <?php Card::end(); ?>