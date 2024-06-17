<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\LoraNpkT;
use app\models\AirTempPressT;
use app\models\JadwalNyiram;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }


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

    public function actionGetJadwalNyiram()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Calculate the start and end of today in milliseconds
        $startOfDay = strtotime("today midnight") * 1000;
        $endOfDay = strtotime("tomorrow midnight") * 1000 - 1;

        // Check availability of today's data in 'jadwal_nyiram' table
        $is_today_data_available = JadwalNyiram::find()
            ->where(['between', 'time', $startOfDay, $endOfDay])
            ->exists();

        if ($is_today_data_available) {
            $data['status'] = 1; // Today's data is available
        } else {
            $data['status'] = 0; // Today's data is not available
        }
        return $data;
    }

    public function actionGetTodayJadwal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Calculate the start and end of today in milliseconds
        $startOfDay = strtotime("today midnight") * 1000;
        $endOfDay = strtotime("tomorrow midnight") * 1000 - 1;

        // Check availability of today's data in 'jadwal_nyiram' table
        $today_data = JadwalNyiram::find()
            ->where(['between', 'time', $startOfDay, $endOfDay])
            ->all();

        return $today_data;
    }

    public function actionSaveTodayJadwal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->post();

        if (empty($data)) {
            return [
                'status' => 'error',
                'message' => 'No data received',
            ];
        }

        foreach ($data as $entry) {
            $model = new JadwalNyiram();
            $model->humidity_value = $entry['soil_humidity'];
            $model->humidity_state = $entry['humidity_state'];
            $model->time = (int)($entry['timestamp']); // Convert timestamp from milliseconds to seconds

            if (!$model->save()) {
                return [
                    'status' => 'error',
                    'message' => 'Failed to save data',
                    'errors' => $model->errors,
                ];
            }
        }

        return [
            'status' => 'success',
            'message' => 'Data saved successfully',
        ];
    }
}
