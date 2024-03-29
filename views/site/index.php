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

use app\models\NpkThisWeekTempMoist;


use app\models\NpkModel;

use app\assets\AppAsset;

use kartik\grid\ActionColumn as GridActionColumn;
use kartik\grid\GridView;
use yii\grid\ActionColumn;

use yii\bootstrap4\Button;
use yii\bootstrap4\Widget;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;

AppAsset::register($this);


/** @var yii\web\View $this */
/** @var app\models\LoraNpkT $model */

$this->title = 'Home';
?>

<div class="site-index">
    <div class="body-content">
        <?php
        $loraData = LoraNpkT::find()->orderBy(['val_id' => SORT_DESC])->one();
        $T_v = $loraData->T;
        $H_v = $loraData->H;

        $lora_temp_moist = NpkThisWeekTempMoist::getThisWeekTempMoist();
        $temp_sun = $lora_temp_moist['temp_sun'] . json_encode($this);
        $temp_mon = $lora_temp_moist['temp_mon'] . json_encode($this);
        $temp_tue = $lora_temp_moist['temp_tue'] . json_encode($this);
        $temp_wed = $lora_temp_moist['temp_wed'] . json_encode($this);
        $temp_thu = $lora_temp_moist['temp_thu'] . json_encode($this);
        $temp_fri = $lora_temp_moist['temp_fri'] . json_encode($this);
        $temp_sat = $lora_temp_moist['temp_sat'] . json_encode($this);

        $moist_sun = $lora_temp_moist['moist_sun'] . json_encode($this);
        $moist_mon = $lora_temp_moist['moist_mon'] . json_encode($this);
        $moist_tue = $lora_temp_moist['moist_tue'] . json_encode($this);
        $moist_wed = $lora_temp_moist['moist_wed'] . json_encode($this);
        $moist_thu = $lora_temp_moist['moist_thu'] . json_encode($this);
        $moist_fri = $lora_temp_moist['moist_fri'] . json_encode($this);
        $moist_sat = $lora_temp_moist['moist_sat'] . json_encode($this);
        ?>
        
        <div id="npk-card" class="row npk">
            <!-- T CARD -->
            <div class="col-lg-6 col-md-6 col-sm-6">
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

            <!-- H CARD -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?php
                echo Cardstats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        "headerIcon" => "water_drop",
                        "title" => "Soil Moisture",
                        "subtitle" => $H_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 80% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>
            
        <!-- NPK CHART -->
        <div id="npk-chart" class="row npk">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?=
                CardChart::widget(
                    [
                        "idchart" => 'temp-moist',
                        "color" => CardChart::COLOR_INFO,
                        "url" => "",
                        "title" => "SOIL CONDITION CHART",
                        "description" => "This chart displays this week's temperature(white) and soil moisture data(red)",
                    ]
                )
                ?>
            </div>
        </div> <!-- id="npk-chart" class="row npk" -->

        <!----------- END OF NPK SECTION ------------>

        <?php
        echo "<script>
            var temp_sun = $temp_sun;
            var temp_mon = $temp_mon;
            var temp_tue = $temp_tue;
            var temp_wed = $temp_wed;
            var temp_thu = $temp_thu;
            var temp_fri = $temp_fri;
            var temp_sat = $temp_sat;

            var moist_sun = $moist_sun;
            var moist_mon = $moist_mon;
            var moist_tue = $moist_tue;
            var moist_wed = $moist_wed;
            var moist_thu = $moist_thu;
            var moist_fri = $moist_fri;
            var moist_sat = $moist_sat;
            
            </script>";
        ?>

    </div> <!-- body content -->
</div> <!-- site index -->