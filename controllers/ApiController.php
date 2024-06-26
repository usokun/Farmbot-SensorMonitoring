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

    public function actionCheckJadwalNyiram()
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

    public function actionCheckCurrentHourJadwalNyiram()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;


        $currentTimestamp = time();

        // Calculate the start and end of the current hour
        $startOfHour = strtotime(date('Y-m-d H:00:00', $currentTimestamp)) * 1000;
        $endOfHour = strtotime(date('Y-m-d H:59:59', $currentTimestamp)) * 1000;

        // Check if data is available for the current hour
        $is_current_hour_data_available = JadwalNyiram::find()
            ->where(['between', 'time', $startOfHour, $endOfHour])
            ->exists();

        if ($is_current_hour_data_available) {
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

    public function actionGetCurrentHourJadwal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $currentTimestamp = time();

        // Calculate the start and end of the current hour
        $startOfHour = strtotime(date('Y-m-d H:00:00', $currentTimestamp)) * 1000;
        $endOfHour = strtotime(date('Y-m-d H:59:59', $currentTimestamp)) * 1000;

        // Check if data is available for the current hour
        $current_hour_data = JadwalNyiram::find()
            ->where(['between', 'time', $startOfHour, $endOfHour])
            ->all();

        if ($current_hour_data) {
            $data['status'] = 1; // Today's data is available
        } else {
            $data['status'] = 0; // Today's data is not available
        }
        return $data;
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

        $is_available = $this->actionCheckCurrentHourJadwalNyiram();

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

    public function actionDeleteTodayJadwal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $currentTimestamp = time();

        // Calculate the start and end of the current hour
        $startOfHour = strtotime(date('Y-m-d H:00:00', $currentTimestamp));
        $endOfHour = strtotime(date('Y-m-d H:59:59', $currentTimestamp));

        // Logging timestamps for debugging
        Yii::info("Start of hour: $startOfHour", __METHOD__);
        Yii::info("End of hour: $endOfHour", __METHOD__);

        // Check if data is available for the current hour and delete it
        $deleteCount = JadwalNyiram::deleteAll(['between', 'time', $startOfHour, $endOfHour]);

        // Logging the result of the delete operation
        Yii::info("Deleted rows count: $deleteCount", __METHOD__);

        return ['deleted' => $deleteCount];
    }
}
