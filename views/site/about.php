<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$subtitle1_t = $subtitle1;
$subtitle2_t = $subtitle2;
$subtitle3_t = $subtitle3;
$skripsi_text_t = $skripsi_text;
$name_t = $name;
$nim_t = $nim;
$prodi_text_t = $prodi_text;
$fakultas_text_t = $fakultas_text;
$univ_text_t = $univ_text;
$year_t = $year;

?>
<div class="site-about">
    <div class="col-lg-12" style="height:auto; padding: 10px 200px;">
        <div>
            <p class="text-center font-weight-bold" style="font-size: 28px;"><?= $subtitle1_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 28px;"><?= $subtitle2_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 28px;"><?= $subtitle3_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px; padding-top:2rem;"><?= $skripsi_text_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $name_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $nim_t ?></p>
        </div>

        <div style="margin-top: 10px; padding:10px">
            <?= Html::img('@web/images/logo_usu.png', ['alt' => 'logo usu', 'class' => 'mx-auto d-block', 'height' => '200px', 'width' => '200px']); ?>
        </div>
        <div style="margin-top: 25px;">
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $prodi_text_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $fakultas_text_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $univ_text_t ?></p>
            <p class="text-center font-weight-bold" style="font-size: 24px;"><?= $year_t ?></p>
        </div>

    </div>

</div>