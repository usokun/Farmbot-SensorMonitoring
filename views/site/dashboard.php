<?php

/* @var $this yii\web\View */

use deyraka\materialdashboard\widgets\Cardstats;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\CardChart;
use deyraka\materialdashboard\widgets\Progress;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\i18n\Formatter;
use yii\widgets\DetailView;

use app\models\LoraNpkT;
use app\models\LoraNpkTSearch;

use app\models\SoilMoistT;
use app\models\SoilMoistTSearch;

use app\models\AirTempPressT;
use app\models\AirTempPressTSearch;
use app\models\NpkThisAndPreviousWeekM;
use app\models\SoilMoistWeekdaysM;
use app\models\AirTempPressWeekdaysM;

use app\models\NpkModel;

use app\assets\AppAsset;

use kartik\grid\ActionColumn as GridActionColumn;
use kartik\grid\GridView;
use yii\grid\ActionColumn;

AppAsset::register($this);


/** @var yii\web\View $this */
/** @var app\models\LoraNpkT $model */

$this->title = 'Dashboard';
?>

<div class="site-index">
    <div class="body-content">
        <?php
        $loraData = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
        $T_v = $loraData->T;
        $H_v = $loraData->H;
        $PH_v = $loraData->PH;
        $N_v = $loraData->N;
        $P_v = $loraData->P;
        $K_v = $loraData->K;
        $loraTime_v = $loraData->time;
        ?>

        <?php
        $smoistData = SoilMoistT::find()->orderBy(['val_id' => SORT_DESC])->one();
        $SMoist_v = $smoistData->SMoist;
        $smoistTime_v = $smoistData->time;

        $air_temp_pressData = AirTempPressT::find()->orderBy(['val_id' => SORT_DESC])->one();
        $ATemp_v = $air_temp_pressData->ATemp;
        $APress_v = $air_temp_pressData->APress;

        function getNpkDataByDay($number)
        {
            $dayBasedValue = LoraNpkT::find()
                ->select(['N', 'P', 'K', 'time'])
                ->where(['DAYOFWEEK(FROM_UNIXTIME(time))' => $number])
                ->all();
            return $dayBasedValue;
        }
        $dayBasedValue = LoraNpkT::find()
            ->select(['N', 'P', 'K', 'time'])
            ->where(['DAYOFWEEK(FROM_UNIXTIME(time))' => 2])
            ->all();

        // GET NPK THIS AND PREVIOUS WEEK DATA FROM MODEL
        $getNpkDataThisAndPreviousWeek = NpkThisAndPreviousWeekM::getThisAndPreviousWeekNPK();

        $thisWeekT = $getNpkDataThisAndPreviousWeek['this_week_T'] . json_encode($this);
        $thisWeekH = $getNpkDataThisAndPreviousWeek['this_week_H'] . json_encode($this);
        $thisWeekPH = $getNpkDataThisAndPreviousWeek['this_week_PH'] . json_encode($this);
        $thisWeekN = $getNpkDataThisAndPreviousWeek['this_week_N'] . json_encode($this);
        $thisWeekP = $getNpkDataThisAndPreviousWeek['this_week_P'] . json_encode($this);
        $thisWeekK = $getNpkDataThisAndPreviousWeek['this_week_K'] . json_encode($this);

        $prevWeekT = $getNpkDataThisAndPreviousWeek['prev_week_T'] . json_encode($this);
        $prevWeekH = $getNpkDataThisAndPreviousWeek['prev_week_H'] . json_encode($this);
        $prevWeekPH = $getNpkDataThisAndPreviousWeek['prev_week_PH'] . json_encode($this);
        $prevWeekN = $getNpkDataThisAndPreviousWeek['prev_week_N'] . json_encode($this);
        $prevWeekP = $getNpkDataThisAndPreviousWeek['prev_week_P'] . json_encode($this);
        $prevWeekK = $getNpkDataThisAndPreviousWeek['prev_week_K'] . json_encode($this);

        // GET SMOIST WEEKDAYS DATA FROM MODEL
        $getSoilMoistDataWeekdays = SoilMoistWeekdaysM::getMoistWeekdaysData();

        $smoist_sun = $getSoilMoistDataWeekdays['smoist_sun'] . json_encode($this);
        $smoist_mon = $getSoilMoistDataWeekdays['smoist_mon'] . json_encode($this);
        $smoist_tue = $getSoilMoistDataWeekdays['smoist_tue'] . json_encode($this);
        $smoist_wed = $getSoilMoistDataWeekdays['smoist_wed'] . json_encode($this);
        $smoist_thu = $getSoilMoistDataWeekdays['smoist_thu'] . json_encode($this);
        $smoist_fri = $getSoilMoistDataWeekdays['smoist_fri'] . json_encode($this);
        $smoist_sat = $getSoilMoistDataWeekdays['smoist_sat'] . json_encode($this);

        // GET AIR TEMP AND PRESS WEEKDAYS DATA FROM MODEL
        $getAirTempPressDataWeekdays = AirTempPressWeekdaysM::getAirTempPressWeekdaysData();
        $atemp_sun = $getAirTempPressDataWeekdays['atemp_sun'];
        $atemp_mon = $getAirTempPressDataWeekdays['atemp_mon'];
        $atemp_tue = $getAirTempPressDataWeekdays['atemp_tue'];
        $atemp_wed = $getAirTempPressDataWeekdays['atemp_wed'];
        $atemp_thu = $getAirTempPressDataWeekdays['atemp_thu'];
        $atemp_fri = $getAirTempPressDataWeekdays['atemp_fri'];
        $atemp_sat = $getAirTempPressDataWeekdays['atemp_sat'];

        $apress_sun = $getAirTempPressDataWeekdays['apress_sun'];
        $apress_mon = $getAirTempPressDataWeekdays['apress_mon'];
        $apress_tue = $getAirTempPressDataWeekdays['apress_tue'];
        $apress_wed = $getAirTempPressDataWeekdays['apress_wed'];
        $apress_thu = $getAirTempPressDataWeekdays['apress_thu'];
        $apress_fri = $getAirTempPressDataWeekdays['apress_fri'];
        $apress_sat = $getAirTempPressDataWeekdays['apress_sat'];


        // echo '<pre>';
        // print_r($getAirTempPressDataWeekdays['atemp_mon']);
        // echo '</pre>';

        // coloring
        $color = "";

        ?>

        <h3>FARMBOT SENSOR MONITORING</h3>
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button data-state="active" id="all-btn" type="button" class="btn btn-secondary" style="background-color: #df286a; color: white; font-weight:600;">Semua Data</button>
                <button data-state="inactive" id="npk-btn" type="button" class="btn btn-secondary" style="background-color: white;">Data NPK</button>
                <button data-state="inactive" id="smoist-btn" type="button" class="btn btn-secondary" style="background-color: white; ">Data Kelembaban Tanah</button>
                <button data-state="inactive" id="air-temp-btn" type="button" class="btn btn-secondary" style="background-color: white;">Data Suhu dan Tekanan Atmosfer Udara</button>
            </div>
        </div>

        <!------------- NPK SECTION --------------->
        <div id="npk-card" class="row npk">
            <!-- T CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "device_thermostat",
                        "title" => "Suhu Tanah",
                        "subtitle" => $T_v,
                        "footerIcon" => "",
                        "footerText" => "25 - 32 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- H CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "water_drop",
                        "title" => "Kelemababan Tanah",
                        "subtitle" => $H_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 80% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- PH CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "water_ph",
                        "title" => "pH",
                        "subtitle" => $PH_v,
                        "footerIcon" => "",
                        "footerText" => "6 - 9 pH is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- N CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "science",
                        "title" => "Nitrogen (N)",
                        "subtitle" => $N_v,
                        "footerIcon" => "",
                        "footerText" => "10 - 100 is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- P CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "science",
                        "title" => "Fosfor (P)",
                        "subtitle" => $P_v,
                        "footerIcon" => "",
                        "footerText" => "10 - 100 is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- K CARD -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "science",
                        "title" => "Potasium (K)",
                        "subtitle" => $P_v,
                        "footerIcon" => "",
                        "footerText" => "50 - 200 is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

        </div> <!-- id="npk-card" class="row npk" -->

        <!-- NPK CHART -->
        <div id="npk-chart" class="row npk">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?=
                CardChart::widget(
                    [
                        "idchart" => 'npkchart',
                        "color" => CardChart::COLOR_INFO,
                        "url" => "",
                        "title" => "NPK CHART DATA",
                        "description" => "This chart displays comparison between `previous week average (white)` and `this week average (red)` NPK data",
                    ]
                )
                ?>
            </div>
        </div> <!-- id="npk-chart" class="row npk" -->

        <!-- NPK Table -->
        <div id="npk-table-container" class="row npk">
            <div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
                <?php
                Card::begin([
                    'id' => 'card1',
                    'color' => Card::COLOR_INFO,
                    'headerIcon' => 'table_rows',
                    'collapsable' => false,
                    'title' => 'NPK TABLE',
                    'titleTextType' => Card::TYPE_INFO,
                    'showFooter' => true,
                    'footerContent' => '',
                ])
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderNPK,
                    'layout' => "{items}\n{pager}",
                    // 'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => '\kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'time',
                            'value' => function ($model, $key, $index, $grid) {
                                return date('l, Y-m-d H:i:s', $model->time);
                            },
                        ],
                        'T',
                        'H',
                        'PH',
                        'N',
                        'P',
                        'K',
                    ],
                ]);
                ?>
                <?php Card::end(); ?>
            </div> <!-- class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;" -->
        </div> <!-- id="npk-table" class="row npk" -->
        <!----------- END OF NPK SECTION ------------>


        <!------------- SOIL MOIST SECTION --------------->
        <!-- SMoist Card -->
        <div id="smoist-card" class="row smoist">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "opacity",
                        "title" => "Kelembaban Tanah",
                        "subtitle" => $SMoist_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 90% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div> <!-- class="col-lg-4 col-md-6 col-sm-6" -->
        </div> <!-- id="smoist-card" class="row smoist" -->

        <!-- SoilMoist Chart -->
        <div id="smoist-chart" class="row smoist">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?=
                CardChart::widget(
                    [
                        "idchart" => 'smoistchart',
                        "color" => CardChart::COLOR_SUCCESS,
                        "url" => "",
                        "title" => "SOIL MOIST CHART DATA",
                        "description" => "This chart displays This Week's Average Soil Moisture Data",

                    ]
                )
                ?>
            </div> <!-- class="col-lg-12 col-md-12 col-sm-12" -->
        </div> <!-- id="smoist-chart" class="row smoist" -->

        <!-- SMoist Table -->
        <div id="smoist-table" class="row smoist">
            <div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
                <?php
                Card::begin([
                    'id' => 'card1',
                    'color' => Card::COLOR_INFO,
                    'headerIcon' => 'table_rows',
                    'collapsable' => false,
                    'title' => 'SOIL MOIST TABLE',
                    'titleTextType' => Card::TYPE_INFO,
                    'showFooter' => true,
                    'footerContent' => '',
                ])
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderSMoist,
                    'layout' => "{items}\n{pager}",
                    // 'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => '\kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'time',
                            'value' => function ($model, $key, $index, $grid) {
                                return date('l, Y-m-d H:i:s', $model->time);
                            },
                        ],
                        'SMoist',
                    ],
                ]);
                ?>
                <?php Card::end(); ?>

            </div> <!-- class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;" -->
        </div> <!-- id="smoist-table" class="row smoist" -->
        <!----------- END OF SMOIST SECTION ------------>


        <!------------- AIR TEMP. & PRESS. SECTION --------------->
        <!-- Air Temp Press Card -->
        <div id="air-temp-card" class="row air-temp">
            <!-- Air Temp Card -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "thermostat",
                        "title" => "Suhu Udara",
                        "subtitle" => $ATemp_v,
                        "footerIcon" => "",
                        "footerText" => "23 - 26 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div> <!-- AIR TEMP CARD class="col-lg-4 col-md-6 col-sm-6" -->

            <!-- Air Press Card -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "compress",
                        "title" => "Tekanan Atmosfer",
                        "subtitle" => $APress_v,
                        "footerIcon" => "",
                        "footerText" => "",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div> <!-- AIR PRESS CARD class="col-lg-4 col-md-6 col-sm-6" -->
        </div> <!-- id="air-temp-card" class="row air-temp" -->

        <!-- Air Temp Press Chart -->
        <div id="air-temp-chart" class="row air-temp">
            <!-- Air Temp Chart -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?=
                CardChart::widget(
                    [
                        "idchart" => 'airtempchart',
                        "color" => CardChart::COLOR_PRIMARY,
                        "url" => "",
                        "title" => " CHART DATA SUHU UDARA",
                        "description" => "This chart displays This Week's Air Temperature Data",
                    ]
                )
                ?>
            </div>
            <!-- Air Press Chart -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?=
                CardChart::widget(
                    [
                        "idchart" => 'airpresschart',
                        "color" => CardChart::COLOR_ROSE,
                        "url" => "",
                        "title" => "AIR PRESSURE CHART DATA",
                        "description" => "This chart displays This Week's Air Pressure Data",

                    ]
                )
                ?>
            </div>
        </div> <!-- id="air-temp-chart" class="row air-temp" -->

        <!-- AIR TEMP PRESS TABLE -->

        <div id="air-temp-table" class="row air-temp">
            <div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
                <?php
                Card::begin([
                    'id' => 'card1',
                    'color' => Card::COLOR_INFO,
                    'headerIcon' => 'table_rows',
                    'collapsable' => false,
                    'title' => 'SUHU DAN TEKANAN ATMOSFER UDARA',
                    'titleTextType' => Card::TYPE_INFO,
                    'showFooter' => true,
                    'footerContent' => '',
                ])
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderAirTempPress,
                    'layout' => "{items}\n{pager}",
                    // 'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => '\kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'time',
                            'value' => function ($model, $key, $index, $grid) {
                                return date('l, Y-m-d H:i:s', $model->time);
                            },
                        ],
                        'ATemp',
                        'APress'
                    ],
                ]); ?>
                <!-- END your <body> content of the Card above this line, right before "Card::end()"  -->
                <?php Card::end(); ?>
            </div>
        </div> <!-- id="air-temp-table" class="row air-temp" -->


        <?php
        echo "<script>
            var thisWeek_T = $thisWeekT;
            var thisWeek_H = $thisWeekH;
            var thisWeek_PH = $thisWeekPH;
            var thisWeek_N = $thisWeekN;
            var thisWeek_P = $thisWeekP;
            var thisWeek_K = $thisWeekK;
            var prevWeek_T = $prevWeekT;
            var prevWeek_H = $prevWeekH;
            var prevWeek_PH = $prevWeekPH;
            var prevWeek_N = $prevWeekN;
            var prevWeek_P = $prevWeekP;
            var prevWeek_K = $prevWeekK;

            var smoist_sun = $smoist_sun;
            var smoist_mon = $smoist_mon;
            var smoist_tue = $smoist_tue;
            var smoist_wed = $smoist_wed;
            var smoist_thu = $smoist_thu;
            var smoist_fri = $smoist_fri;
            var smoist_sat = $smoist_sat;
            
            var atemp_sun = $atemp_sun;
            var atemp_mon = $atemp_mon;
            var atemp_tue = $atemp_tue;
            var atemp_wed = $atemp_wed;
            var atemp_thu = $atemp_thu;
            var atemp_fri = $atemp_fri;
            var atemp_sat = $atemp_sat;

            var apress_sun = $apress_sun;
            var apress_mon = $apress_mon;
            var apress_tue = $apress_tue;
            var apress_wed = $apress_wed;
            var apress_thu = $apress_thu;
            var apress_fri = $apress_fri;
            var apress_sat = $apress_sat;

            </script>";
        ?>

    </div> <!-- body content -->
</div> <!-- site index -->