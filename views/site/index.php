<?php

/* @var $this yii\web\View */

use deyraka\materialdashboard\widgets\CardStats;
use deyraka\materialdashboard\widgets\CardChart;
use app\models\LoraNpkT;
use app\models\NpkThisWeekTempMoist;
use app\assets\AppAsset;
use app\models\JadwalNyiram;

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

        // if (!empty($predictData)) {
        //     $data = $predictData;
        // } else {
        //     throw new Exception('No data found');
        // }

        // if (!empty($jadwalData)) {
        //     $data_jadwal = $jadwalData;
        // } else {
        //     throw new Exception('No data found');
        // }

        $data = $predictData;
        $data_jadwal = $jadwalData;

        $latest_data = end($data);
        $h_state = $latest_data->humidity_state;

        $time_to_water_array = [];

        $day_map = [
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
            'Sun' => 'Minggu'
        ];

        $no_schedule = 'Tidak Ada Jadwal Penyiraman Hari Ini';

        foreach ($data_jadwal as $item) {
            if ($data_jadwal == null) {
                echo "No data Available";
            } else {

                $milliseconds = $item['time'];

                // Convert milliseconds to seconds and create a DateTime object
                $datetime = DateTime::createFromFormat('U', $milliseconds / 1000);
                // Set the timezone to UTC
                $datetime->setTimezone(new DateTimeZone('UTC'));
                // Convert to local timezone (UTC+7)
                $datetime->setTimezone(new DateTimeZone('Asia/Jakarta'));
                // Format datetime as desired
                $day = $datetime->format('D');
                $formatted_time = $datetime->format('M Y H:i');
                // Replace the English day with the Indonesian day
                $formatted_time_with_day = $day_map[$day] . ', ' . $formatted_time;
                $time_to_water_array[] = $formatted_time_with_day;
            }
        }


        ?>



        <h3>FARMBOT SENSOR MONITORING</h3>
        <div class="row" style="padding: 14px 14px">
            <div class="moist-status container-fluid">
                <span id="moist-status">Status Kelembaban Tanah: <span id="moist-status-stat"></span><?= $h_state ?></span>
                <span id="eta">Jadwal Penyiraman Selanjutnya: <span id="eta-time"></span><?php if (empty($time_to_water_array[0])) {
                                                                                                echo "Tidak Ada Jadwal Penyiraman Hari ini";
                                                                                            } else {
                                                                                                echo $time_to_water_array[0];
                                                                                            } ?>
                </span>
            </div>
        </div>

        <div id="npk-card" class="row npk">
            <!-- T CARD -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?php
                echo CardStats::widget(
                    [
                        "color" => CardStats::COLOR_PRIMARY,
                        "headerIcon" => "device_thermostat",
                        "title" => "Suhu",
                        "subtitle" => $T_v,
                        "footerIcon" => "",
                        "footerText" => "25 - 32 degree is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => CardStats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <!-- H CARD -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <?php
                echo CardStats::widget(
                    [
                        "color" => CardStats::COLOR_PRIMARY,
                        "headerIcon" => "water_drop",
                        "title" => "Kelembaban Tanah",
                        "subtitle" => $H_v,
                        "footerIcon" => "",
                        "footerText" => "10% - 80% is expected. ",
                        // "footerUrl" => Url::to(['site/login']),
                        "footerTextType" => CardStats::TYPE_INFO,
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
                        "idchart" => 'temp-moist',
                        "color" => CardChart::COLOR_INFO,
                        "url" => "",
                        "title" => "Chart Kondisi Tanah",
                        "description" => "Chart ini menampilkan kondisi suhu(putih) dan data kelembaban tanah(merah) pada minggu ini",
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