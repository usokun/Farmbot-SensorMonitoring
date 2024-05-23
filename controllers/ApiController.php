<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\LoraNpkT;
use app\models\AirTempPressT;

class ApiController extends Controller
{
    public function actionGetCurrentSensorData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Retrieve the current soil humidity and temperature from the LoraNpkT model
        $current_soil_humidity = LoraNpkT::find()->select('H')->orderBy(['val_id' => SORT_DESC])->scalar();
        $current_soil_temp = LoraNpkT::find()->select('T')->orderBy(['val_id' => SORT_DESC])->scalar();
        $current_air_temp = AirTempPressT::find()->select('ATemp')->orderBy(['val_id' => SORT_DESC])->scalar();

        // Combine the humidity and temperature into an associative array
        $data = [
            'current_soil_humidity' => $current_soil_humidity,
            'current_soil_temp' => $current_soil_temp,
            'current_air_temp' => $current_air_temp

        ];

        return $data;
    }
}
