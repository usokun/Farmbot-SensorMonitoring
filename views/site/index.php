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
        <h3>FARMBOT SENSOR MONITORING</h3>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button id="npk-btn" type="button" class="btn btn-secondary"
                style="background-color: #df286a; color: white; font-weight: 600;">NPK Data</button>
            <button id="smoist-btn" type="button" class="btn btn-secondary" style="background-color: white;">Soil
                Moisture Data</button>
            <button id="air-temp-btn" type="button" class="btn btn-secondary" style="background-color: white;">Air
                Temp. & Press. Data</button>
        </div>
        <?php
        /* =======================================================
        Example of using Card Widget
        'id' and 'title' are MUST BE INITIALIZE and MUST BE UNIQUE Parameter.
        'color', 'headerIcon', 'collapsable', 'titleTextType', 'showFooter', and 'footerContent' are optional.
        'color' has a const value. Default is COLOR::INFO (another options are COLOR::ROSE, DANGER, WARNING, PRIMARY, SUCCESS).
        'headerIcon' has default value 'room'. See https://material.io/resources/icons/?style=baseline for further reference.
        'collapsable' and 'showFooter' are boolean with default value false. 
        If you enabling showFooter, don't forget to initialize 'footerContent'.
        'titleTextType' has a const value. Default is TYPE::MUTED (another option are TYPE::INFO, SUCCESS, DANGER, PRIMARY, and WARNING).
        ==========================================================
        */
        ?>

        <!------- start row npk -------->
        <div id="npk-card" class="row">
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

            // $filtered_T_v = $filterNpkDataByDay->T;
            
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

            // print_r($data);
            // echo '<pre>';
            // print_r($getNpkDataThisAndPreviousWeek);
            // echo '</pre>';
            
            // coloring
            $color = "";

            ?>
            <!-- T -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "device_thermostat",
                        "title" => "Temperature",
                        "subtitle" => $T_v,
                        "footerIcon" => "",
                        "footerText" => "25 - 32 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>

            </div>

            <!-- H -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "water_drop",
                        "title" => "Humidity",
                        "subtitle" => $H_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 80% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>

            <!-- PH -->
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

            <!-- N -->
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
            <!-- P -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "science",
                        "title" => "Phosphorus (P)",
                        "subtitle" => $P_v,
                        "footerIcon" => "",
                        "footerText" => "10 - 100 is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>

            <!-- K -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "science",
                        "title" => "Potassium (K)",
                        "subtitle" => $P_v,
                        "footerIcon" => "",
                        "footerText" => "50 - 200 is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>
        </div>

        <!-- row for SMoist -->
        <div id="smoist-card" class="row" style="display: none">
            <!-- SMoist -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "opacity",
                        "title" => "Soil Moisture",
                        "subtitle" => $SMoist_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 90% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>
        </div>

        <!-- row for ATemp -->
        <div id="air-temp-card" class="row" style="display: none">
            <!-- ATemp -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "thermostat",
                        "title" => "Air Temperature",
                        "subtitle" => $ATemp_v,
                        "footerIcon" => "",
                        "footerText" => "23 - 26 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>

            <!-- APress -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "compress",
                        "title" => "Air Pressure",
                        "subtitle" => $APress_v,
                        "footerIcon" => "",
                        "footerText" => "23 - 26 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                    ?>
            </div>
        </div>
        <!-- NPK CHART DATA -->
        <div id="npk-chart" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?=
                    CardChart::widget(
                        [
                            "idchart" => 'saleschart',
                            "color" => CardChart::COLOR_INFO,
                            "url" => "",
                            "title" => "NPK CHART DATA",
                            "description" => "This chart displays comparison between `previous week average (blue)` and `this week average (red)` NPK data",
                        ]
                    )
                    ?>
            </div>
        </div>


        <!------- start tables row here  ------->
        <div class="row">
            <div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">

                <!-- =======================================================
                    Example of using Card Widget
                    'id' and 'title' are MUST BE INITIALIZE and MUST BE UNIQUE Parameter.
                    'color', 'headerIcon', 'collapsable', 'titleTextType', 'showFooter', and 'footerContent' are optional.
                    'color' has a const value. Default is COLOR::INFO (another options are COLOR::ROSE, DANGER, WARNING, PRIMARY, SUCCESS).
                    'headerIcon' has default value 'room'. See https://material.io/resources/icons/?style=baseline for further reference.
                    'collapsable' and 'showFooter' are boolean with default value false. 
                    If you enabling showFooter, don't forget to initialize 'footerContent'.
                    'titleTextType' has a const value. Default is TYPE::MUTED (another option are TYPE::INFO, SUCCESS, DANGER, PRIMARY, and WARNING).
                ========================================================== -->
                <?php

                Card::begin([
                    'id' => 'card1',
                    'color' => Card::COLOR_INFO,
                    'headerIcon' => 'table_rows',
                    'collapsable' => false,
                    'title' => 'NPK TABLE DATA',
                    'titleTextType' => Card::TYPE_INFO,
                    'showFooter' => true,
                    'footerContent' => '',
                ])
                    ?>

                <!-- START your <body> content of the Card below this line  -->
                <div id="npk-table" style="display:block"
                    style="background-color: #df286a; color: white, font-weight: 600;">
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
                                    return date('l Y-m-d H:i:s', $model->time);
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
                </div>

                <div id="smoist-table" style="display:none">
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
                                    return date('Y-m-d H:i:s', $model->time);
                                },
                            ],
                            'SMoist',
                        ],
                    ]); ?>
                    <!-- END your <body> content of the Card above this line, right before "Card::end()"  -->
                </div>
                <div id="air-temp-table" style="display:none">
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
                                    return date('Y-m-d H:i:s', $model->time);
                                },
                            ],
                            'ATemp',
                            'APress'
                        ],
                    ]); ?>
                    <!-- END your <body> content of the Card above this line, right before "Card::end()"  -->
                </div>
                <?php Card::end(); ?>




            </div>
        </div>
    </div>
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
    
    </script>";
    ?>
    <script src="js/cardchart.js"></script>
</div>