<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\Cardstats;
use app\models\LoraNpkT;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $data array */
/* @var $model app\models\PredictionForm */

$this->title = $title;
?>
<div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6; padding: 1rem">
    <h4 style="font-weight: 400; padding: 5px 5px; color: grey">Kostumisasi Prediksi</h4>
    <div class="col-lg-4 col-md-6 col-sm-6" style="background: white; padding: 1rem; border-radius: 5px; box-shadow: 7px 6px 12px -7px rgba(0,0,0,0.51); -webkit-box-shadow: 7px 6px 12px -7px rgba(0,0,0,0.51); -moz-box-shadow: 7px 6px 12px -7px rgba(0,0,0,0.51); margin-left:12px;">
        <div class="prediction-form">
            <?php $form = ActiveForm::begin([
                'id' => 'prediction-form',
            ]); ?>

            <?= $form->field($model, 'sh')->textInput(['type' => 'number', 'step' => '0.01'])->label('Nilai Kelembaban Tanah') ?>
            <?= $form->field($model, 'st')->textInput(['type' => 'number', 'step' => '0.01'])->label('Nilai Suhu Tanah') ?>

            <div class="form-group">
                <?= Html::submitButton('Predict', ['class' => 'btn btn-primary', 'id' => 'predict-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <div id="prediction-result"></div>
    </div>
</div>


<div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <?php
        if (!empty($data)) {
            $latest_data = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
            echo Cardstats::widget([
                "color" => Cardstats::COLOR_PRIMARY,
                "headerIcon" => "water_drop",
                "title" => "Nilai Kelembaban Tanah Terbaru",
                "subtitle" => $latest_data['H'],
                "footerIcon" => "",
                "footerText" => "10% - 80% is expected.",
                "footerTextType" => Cardstats::TYPE_INFO,
            ]);
        }
        ?>
    </div>
    <?php
    Card::begin([
        'id' => 'predict-table',
        'color' => Card::COLOR_INFO,
        'headerIcon' => 'table_rows',
        'collapsable' => false,
        'title' => 'Prediksi Kelembaban Tanah Hari Ini',
        'titleTextType' => Card::TYPE_INFO,
        'showFooter' => true,
        'footerContent' => '',
    ]);
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
                    return $dateTime->format('l, d-m-Y H:i:s');
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
</div>

<?php
// Register JavaScript to handle form submission and AJAX request
$this->registerJs(
    <<<JS
$('#prediction-form').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    var form = $(this);
    var sh = form.find('#predictionform-sh').val();
    var st = form.find('#predictionform-st').val();

    // Validate if sh and st are not empty
    if (!sh || !st) {
        alert('Nilai Kelembaban Tanah dan Nilai Suhu Tanah diperlukan.');
        return false;
    }

    // Make a GET request to the API endpoint with parameters
    fetch('http://127.0.0.1:5000/predict-custom?sh=' + sh + '&st=' + st)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            if (data.error) {
                $('#prediction-result').html('<div class="alert alert-danger">' + data.error + '</div>');
            } else {
                $('#prediction-result').html('<pre>' + JSON.stringify(data, null, 4) + '</pre>');
            }
        })
        .catch(function(error) {
            console.error('Error occurred while making prediction request:', error);
            alert('Error occurred while making prediction request.');
        });

    return false;
});
JS
);
?>