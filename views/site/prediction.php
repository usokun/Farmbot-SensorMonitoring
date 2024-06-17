<?php

use yii\helpers\Html;
use yii\httpclient\Client;
use kartik\grid\GridView;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\Cardstats;
use app\models\LoraNpkT;

$this->title = $title;


?>
<?php
$loraData = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
$H_v = $loraData->H;
?>
<div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <?php
        echo Cardstats::widget(
            [
                "color" => Cardstats::COLOR_PRIMARY,
                "headerIcon" => "water_drop",
                "title" => "Kelembaban Tanah",
                "subtitle" => $H_v,
                "footerIcon" => "",
                "footerText" => "10% - 80% is expected. ",
                // "footerUrl" => Url::to(['site/login']),
                "footerTextType" => Cardstats::TYPE_INFO,
            ]
        )
        ?>
    </div>
    <?php
    Card::begin([
        'id' => 'predict-table',
        'color' => Card::COLOR_INFO,
        'headerIcon' => 'table_rows',
        'collapsable' => false,
        'title' => 'Prediksi Kelembaban Tanah',
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
                    return $dateTime->format('l, d-m-Y H:i:s');
                },
                'label' => 'Waktu'

            ],
            [
                'attribute' => 'air_temp',
                'label' => 'Prakiraan Suhu Udara',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'air_humidity',
                'label' => 'Prakiraan Kelembaban Udara',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'soil_humidity',
                'label' => 'Prediksi Kelembaban Tanah',
                'format' => ['decimal', 2],
            ],
            [
                'attribute' => 'humidity_state',
                'label' => 'Prediksi Status Kelembaban'
            ],
        ],
    ]); ?>

    <?php Card::end(); ?>