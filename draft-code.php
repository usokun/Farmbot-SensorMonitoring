<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\httpclient\Client;
use kartik\grid\GridView;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\Cardstats;
use app\models\LoraNpkT;
use yii\widgets\ActiveForm;
?>
<?php
$loraData = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
$H_v = $loraData->H;
?>
<div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
    <?php
    Card::begin([
        'id' => 'predict-table',
        'color' => Card::COLOR_INFO,
        'headerIcon' => 'table_rows',
        'collapsable' => false,
        'title' => 'Prediksi Kelembaban Tanah Hari ini',
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

                'attribute' => 'time',
                'value' => function ($model) {
                    // Convert milliseconds to seconds by dividing by 1000
                    $timestampInSeconds = $model['time'] / 1000;

                    // Create a DateTime object with the timestamp in UTC
                    $dateTime = new DateTime('@' . $timestampInSeconds);
                    $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok')); // Set the appropriate time zone identifier

                    // Format the DateTime object as a date
                    return $dateTime->format('d-m-Y H:i:s');
                },
                'label' => 'Waktu'

            ],
            [
                'attribute' => 'humidity_value',
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
    public function createAPIRequest()
    {
    $client = new Client();

    $request = $client->createRequest()
    ->setMethod('GET')
    ->setUrl('http://127.0.0.1:5000/predict');

    $url = $request->getUrl();
    $method = $request->getMethod();
    $headers = $request->getHeaders() ? $request->getHeaders()->toArray() : [];
    $data = $request->getData() ? $request->getData()->toArray() : [];

    $ch = curl_init();
    curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POSTFIELDS => $data,
    ]);

    $handles[] = $ch;

    $mh = curl_multi_init();
    curl_multi_add_handle($mh, $ch);

    $active = null;
    do {
    $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
    do {
    $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
    }

    $responses = [];
    foreach ($handles as $ch) {
    $responses[] = curl_multi_getcontent($ch);
    curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);

    // Process responses
    foreach ($responses as $response) {
    // Handle responses here
    $data = json_decode($response, true);
    if ($data !== null) {
    return $data;
    } else {
    Yii::error('Failed to parse JSON response: ' . $response);
    throw new \yii\web\HttpException(500, 'Failed to parse JSON response');
    }
    }

    Yii::error('No response received');
    throw new \yii\web\HttpException(500, 'No response received');
    }

    <?php
    $script = <<<JS
$('#prediction-form').on('beforeSubmit', function (e) {
    e.preventDefault();

    var form = $(this);
    var sh = form.find('#predictionform-sh').val();
    var st = form.find('#predictionform-st').val();
    console.log('sh:', sh);
    console.log('st:', st);
    
    $.ajax({
        url: form.attr('action'),
        type: 'get',
        data: { sh: sh, st: st },
        success: function (data) {
            if (data.error) {
                $('#prediction-result').html('<div class="alert alert-danger">' + data.error + '</div>');
            } else {
                $('#prediction-result').html('<pre>' + JSON.stringify(data, null, 4) + '</pre>');
            }
        },
        error: function () {
            alert('Error occurred while making prediction request.');
        }
    });
    return false;
});
JS;
    $this->registerJs($script);
    ?>