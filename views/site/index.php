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


use kartik\grid\ActionColumn as GridActionColumn;
use kartik\grid\GridView;
use yii\grid\ActionColumn;



/** @var yii\web\View $this */
/** @var app\models\LoraNpkT $model */

$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="body-content">
        <h3>WELCOME TO DASHBOARD</h3>
        <br>

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
        <div class="row">
            <?php
            $loraData = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
            $T_v = $loraData->T;
            $H_v = $loraData->H;
            $PH_v = $loraData->PH;
            $N_v = $loraData->N;
            $P_v = $loraData->P;
            $K_v = $loraData->K;
            $loraTime_v = $loraData->time;

            $smoistData = SoilMoistT::find()->orderBy(['val_id' => SORT_DESC])->one();
            $SMoist_v = $smoistData->SMoist;
            $smoistTime_v = $smoistData->time;

            $air_temp_pressData = AirTempPressT::find()->orderBy(['val_id' => SORT_DESC])->one();
            $ATemp_v = $air_temp_pressData->ATemp;
            $APress_v = $air_temp_pressData->APress;

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
        <!------- end row npk ------->

        <!------- start tables row here  ------->
        <div class="row">
            <div class="col-md-3 col-md-12 col-sm-12" style="background: #e6e6e6;">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="npk-btn" type="button" class="btn btn-secondary"
                        style="background-color: #df286a; color: white; font-weight: 600;">NPK</button>
                    <button id="smoist-btn" type="button" class="btn btn-secondary"
                        style="background-color: white;">Soil
                        Moist</button>
                    <button id="air-temp-btn" type="button" class="btn btn-secondary"
                        style="background-color: white;">Air
                        Temp. & Press.</button>
                </div>

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
                    'title' => '',
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
                                    return date('Y-m-d H:i:s', $model->time);
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

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?=
                    CardChart::widget(
                        [
                            "idchart" => 'saleschart',
                            "color" => CardChart::COLOR_WARNING,
                            "url" => Url::to(['/site/contact']),
                            "title" => "Feel Excellent Panorama with Us",
                            "description" => "The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to 'Naviglio' where you can enjoy the main night life in Barcelona.",
                            "footerTextLeft" => "$10,000/night",
                            "footerTextRight" => "Barcelona",
                            "footerTextType" => CardChart::TYPE_INFO,
                        ]
                    )
                    ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <?=
                    CardStats::widget(
                        [
                            "color" => Cardstats::COLOR_PRIMARY,
                            "headerIcon" => "weekend",
                            "title" => "Today's sale",
                            "subtitle" => "184",
                            "footerIcon" => "warning",
                            "footerText" => "Check this out",
                            "footerUrl" => Url::to(['site/login']),
                            "footerTextType" => Cardstats::TYPE_INFO,
                        ]
                    )
                    ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#npk-btn").click(function () {
                if ($("#npk-table").css("display") == "block") {
                    $("#smoist-table").hide();
                    $("#npk-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });

                } else {
                    $("#npk-table").show();
                    $("#npk-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
                    $("#smoist-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                    $("#air-temp-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                    $("#smoist-table").hide();
                    $("#smoist-btn").css("background-color", "white");
                    $("#air-temp-btn").css("background-color", "white");

                }
            })
            $("#smoist-btn").click(function () {
                if ($("#smoist-table").css("display") == "none") {
                    $("#npk-table").hide();
                    $("#air-temp-table").hide();
                    $("#smoist-table").show();
                    $("#npk-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                    $("#smoist-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
                    $("#air-temp-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                } else {
                    $("#npk-table").hide();
                    $("#air-temp-table").hide();
                }
            })
            $("#air-temp-btn").click(function () {
                if ($("#air-temp-table").css("display") == "none") {
                    $("#smoist-table").hide();
                    $("#npk-table").hide();
                    $("#air-temp-table").show();
                    $("#npk-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                    $("#smoist-btn").css({ "background-color": "white", "color": "black", "font-weight": "300" });
                    $("#air-temp-btn").css({ "background-color": "#df286a", "color": "white", "font-weight": "600" });
                } else {
                    $("#npk-table").hide();
                    $("#smoist-table").hide();
                }
            });
        });

        //SCRIPT FOR LINE AND BAR CHART
        var data = {
            // A labels array that can contain any sort of values
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            // Our series array that contains series objects or in this case series data arrays
            series: [
                [5, 2, 4, 2, 1],
                [3, 2, 9, 5, 4],
            ]
        };
        // We are setting a few options for our chart and override the defaults
        var options = {
            // Don't draw the line chart points
            showPoint: true,
            // Disable line smoothing
            lineSmooth: true,
            // X-Axis specific configuration
            axisX: {
                // We can disable the grid for this axis
                showGrid: true,
                // and also don't show the label
                showLabel: true
            },
            // Y-Axis specific configuration
            axisY: {
                // Lets offset the chart a bit from the labels
                offset: 60,
                // The label interpolation function enables you to modify the values
                // used for the labels on each axis. Here we are converting the
                // values into million pound.
                labelInterpolationFnc: function (value) {
                    return 'Rp ' + value + 'jt';
                }
            }
        };

        // Create a new line chart object where as first parameter we pass in a selector
        // that is resolving to our chart container element. The Second parameter
        // is the actual data object.
        // new Chartist.Bar('.ct-chart', data, options);
        new Chartist.Bar('#saleschart', data, options);
        new Chartist.Line('#daychart', data, options);
        new Chartist.Line('#yourchart', data, options);
        // new Chartist.Bar('#herchart', data, options);

        //SCRIPT FOR PIE CHART
        var data2 = {
            labels: ['Bananas', 'Apples', 'Grapes'],
            series: [20, 15, 40]
        };

        var options2 = {
            labelInterpolationFnc: function (value) {
                return value[0]
            }
        };

        var responsiveOptions = [
            ['screen and (min-width: 640px)', {
                chartPadding: 30,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function (value) {
                    return value;
                }
            }],
            ['screen and (min-width: 1024px)', {
                labelOffset: 80,
                chartPadding: 20
            }]
        ];

        new Chartist.Pie('#herchart', data2, options2, responsiveOptions);

        new Chartist.Pie('#yourchart', {
            series: [20, 10, 30, 40]
        }, {
            donut: true,
            donutWidth: 20,
            donutSolid: true,
            startAngle: 270,
            showLabel: true
        });
    </script>
</div>