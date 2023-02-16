<?php

/* @var $this yii\web\View */
use deyraka\materialdashboard\widgets\Cardstats;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\CardChart;
use deyraka\materialdashboard\widgets\Progress;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\LoraNpkT;
use app\models\LoraNpkTSearch;
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
    <div class="row">
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

        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php
                Card::begin([
                    'id' => 'card3',
                    'color' => Card::COLOR_INFO,
                    'headerIcon' => 'update',
                    'collapsable' => false,
                    'title' => 'REAL-TIME SENSOR DATA',
                    'titleTextType' => Card::TYPE_INFO,
                    'showFooter' => false,
                ]);
            // ?>


            <?php
                $last_sensor = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();

                $T_v = $last_sensor->T;
                $H_v = $last_sensor->H;
                $PH_v = $last_sensor->PH;
                $N_v = $last_sensor->N;
                $P_v = $last_sensor->P;
                $K_v = $last_sensor->K;

                $color_T = '';
                $color_H = '';
                $color_PH = '';
                $color_N = '';
                $color_P = '';
                $color_K = '';
                
                // USABLE COLOR: COLOR_WARNING(yellow), DANGER(red), DEFAULT(blue), INFO(green)
                if ($T_v < 23.00) {
                    $color_T = Progress::COLOR_DEFAULT;}
                elseif ($T_v >=23.00 && $T_v <= 26.00) {
                    $color_T = Progress::COLOR_INFO;}
                else {
                    $color_T = Progress::COLOR_DANGER;
                }

                //moist val: <25 = Terlalu Basah ; <40 & >25 = Lembab ; <60 & >40 = Sedang ; >60 = Kering
                if ($H_v < 25.00) {
                    $color_H = Progress::COLOR_DANGER;}
                elseif($H_v >=25.00 && $H_v < 40.00) {
                    $color_H = Progress::COLOR_DEFAULT;}
                elseif($H_v >40.00 && $H_v < 60.00) {
                    $color_H = Progress::COLOR_WARNING;}
                else{
                    $color_H = Progress::COLOR_DANGER;
                }


                // USABLE COLOR: COLOR_WARNING(yellow), DANGER(red), DEFAULT(blue), INFO(green)
                /* =======================================================
                    Example of using Progress Widget
                    'title' and 'value' are MUST BE INITIALIZE.
                    'value' has range value where value-min is '0' and value-max is '100'.
                    'color', 'isBarStrip', 'isBarAnimated', 'titleTextType' are optional.
                    'color' has a const value. Default is COLOR::INFO (another options are COLOR::ROSE, DANGER, WARNING, PRIMARY, SUCCESS).
                    'isBarStrip' and 'isBarAnimated' are boolean with default value false.
                    'titleTextType' has a const value. Default is TYPE::MUTED (another option are TYPE::INFO, SUCCESS, DANGER, PRIMARY, and WARNING).
                ==========================================================*/
                    
                echo Progress::widget([
                    'title' => 'TEMPERATURE - LoRa NPK Sensor',
                    'value' => $T_v,
                    'color' => $color_T,
                    'isBarStrip' => true,
                    'isBarAnimated' => true,
                    'titleTextType' => Progress::TYPE_MUTED
                ]);

                echo Progress::widget([
                    'title' => 'Humidity - LoRa NPK Sensor',
                    'value' => $H_v,
                    'color' => $color_H,
                    'isBarStrip' => true,
                    'isBarAnimated' => true,
                    'titleTextType' => Progress::TYPE_MUTED
                ]);
            ?>         
            <!-- END your <body> content of the Card above this line, right before "Card::end()"  -->
            
            <?php Card::end(); ?>
            <br>

        </div>
    </div>
    </div>

    <!-- 2nd row here -->
    <div class="row">
            <!-- card 2 -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <?php
            $card_color ='';

            if ($T_v < 25.00) {
                $card_color = Cardstats::COLOR_DANGER;}
            elseif($T_v >=25.00 && $T_v < 40.00) {
                $card_color = Cardstats::COLOR_PRIMARY;}
            elseif($T_v >40.00 && $T_v < 60.00) {
                $card_color = Cardstats::COLOR_WARNING;}
            else{
                $card_color= Cardstats::COLOR_DANGER;
            }

           echo Cardstats::widget(
                [
                    "color" => Cardstats::COLOR_PRIMARY,
                    "headerIcon" => "device_thermostat",
                    "title" => "Temperature",
                    "subtitle" => $T_v,
                    "footerIcon" => "",
                    "footerText" => "23 - 26 degree is expected. ",
                    // "footerUrl" => Url::to(['site/login']),
                    "footerTextType" => Cardstats::TYPE_INFO,
                ]
            )
            ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <?php

            $card_color ='';

            if($H_v >=23.00 && $H_v <= 26.00){
                $card_color = Cardstats::COLOR_PRIMARY;
            }
            elseif($H_v <23.00){
                $card_color = Cardstats::COLOR_WARNING;
            }else{
                $card_color = Cardstats::COLOR_DANGER;

            }
            echo Cardstats::widget(
                [
                    "color" => Cardstats::COLOR_ROSE,
                    "headerIcon" => "water_drop",
                    "title" => "Soil Humidity",
                    "subtitle" => $H_v,
                    "footerIcon" => "",
                    "footerText" => "30% - 50% value is expected",
                    // "footerUrl" => Url::to(['site/contact']),
                    "footerTextType" => Cardstats::TYPE_PRIMARY,
                ]
            )
            ?>
        </div>
    </div>

    <!-- 3rd row here -->
    <div class="row">
        <div class="col-md-3 col-md-12 col-sm-12">
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
                Card::begin([  
                    'id' => 'card1', 
                    'color' => Card::COLOR_INFO, 
                    'headerIcon' => 'table_rows', 
                    'collapsable' => false, 
                    'title' => 'DATA TABLE', 
                    'titleTextType' => Card::TYPE_INFO, 
                    'showFooter' => true,
                    'footerContent' => 'Data description is displayed here in table.',
                ])
            ?>
            <!-- START your <body> content of the Card below this line  -->
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => '\kartik\grid\SerialColumn'],
                    'T',
                    'P',
                    'PH',
                    'N',
                    'P',
                    'K',
            ],
            ]); ?>
            <!-- END your <body> content of the Card above this line, right before "Card::end()"  -->                
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

    <script>
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
                labelInterpolationFnc: function(value) {
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
        labelInterpolationFnc: function(value) {
            return value[0]
        }
        };

        var responsiveOptions = [
        ['screen and (min-width: 640px)', {
            chartPadding: 30,
            labelOffset: 100,
            labelDirection: 'explode',
            labelInterpolationFnc: function(value) {
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
