<?php

namespace app\models;

use Yii;

class NpkThisWeekTempMoist extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'lora_npk_t';
    }

    public static function getThisWeekTempMoist()
    {
        $data = self::find()
            ->select([
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 1 THEN T END AS temp_sun',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 2 THEN T END AS temp_mon',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 3 THEN T END AS temp_tue',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 4 THEN T END AS temp_wed',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 5 THEN T END AS temp_thu',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 6 THEN T END AS temp_fri',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 7 THEN T END AS temp_sat',

                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 1 THEN H END AS moist_sun',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 2 THEN H END AS moist_mon',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 3 THEN H END AS moist_tue',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 4 THEN H END AS moist_wed',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 5 THEN H END AS moist_thu',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 6 THEN H END AS moist_fri',
                'CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 7 THEN H END AS moist_sat',
            ])
            ->where(['>=', 'FROM_UNIXTIME(time)', new \yii\db\Expression('DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)')])
            ->orderBy('FROM_UNIXTIME(time)')
            ->asArray()
            ->all();

        $temp_sun = 0;
        $temp_mon = 0;
        $temp_tue = 0;
        $temp_wed = 0;
        $temp_thu = 0;
        $temp_fri = 0;
        $temp_sat = 0;

        $moist_sun = 0;
        $moist_mon = 0;
        $moist_tue = 0;
        $moist_wed = 0;
        $moist_thu = 0;
        $moist_fri = 0;
        $moist_sat = 0;


        foreach ($data as $row) {

            $temp_sun += !empty($row['temp_sun']) ? $row['temp_sun'] : 0;
            $temp_mon += !empty($row['temp_mon']) ? $row['temp_mon'] : 0;
            $temp_tue += !empty($row['temp_tue']) ? $row['temp_tue'] : 0;
            $temp_wed += !empty($row['temp_wed']) ? $row['temp_wed'] : 0;
            $temp_thu += !empty($row['temp_thu']) ? $row['temp_thu'] : 0;
            $temp_fri += !empty($row['temp_fri']) ? $row['temp_fri'] : 0;
            $temp_sat += !empty($row['temp_sat']) ? $row['temp_sat'] : 0;

            $moist_sun += !empty($row['moist_sun']) ? $row['moist_sun'] : 0;
            $moist_mon += !empty($row['moist_mon']) ? $row['moist_mon'] : 0;
            $moist_tue += !empty($row['moist_tue']) ? $row['moist_tue'] : 0;
            $moist_wed += !empty($row['moist_wed']) ? $row['moist_wed'] : 0;
            $moist_thu += !empty($row['moist_thu']) ? $row['moist_thu'] : 0;
            $moist_fri += !empty($row['moist_fri']) ? $row['moist_fri'] : 0;
            $moist_sat += !empty($row['moist_sat']) ? $row['moist_sat'] : 0;
        }

        $count = count($data);
        $temp_sun = $count > 0 ? $temp_sun / $count : 0;
        $temp_mon = $count > 0 ? $temp_mon / $count : 0;
        $temp_tue = $count > 0 ? $temp_tue / $count : 0;
        $temp_wed = $count > 0 ? $temp_wed / $count : 0;
        $temp_thu = $count > 0 ? $temp_thu / $count : 0;
        $temp_fri = $count > 0 ? $temp_fri / $count : 0;
        $temp_sat = $count > 0 ? $temp_sat / $count : 0;

        $moist_sun = $count > 0 ? $moist_sun / $count : 0;
        $moist_mon = $count > 0 ? $moist_mon / $count : 0;
        $moist_tue = $count > 0 ? $moist_tue / $count : 0;
        $moist_wed = $count > 0 ? $moist_wed / $count : 0;
        $moist_thu = $count > 0 ? $moist_thu / $count : 0;
        $moist_fri = $count > 0 ? $moist_fri / $count : 0;
        $moist_sat = $count > 0 ? $moist_sat / $count : 0;

        return [
            'temp_sun' => $temp_sun,
            'temp_mon' => $temp_mon,
            'temp_tue' => $temp_tue,
            'temp_wed' => $temp_wed,
            'temp_thu' => $temp_thu,
            'temp_fri' => $temp_fri,
            'temp_sat' => $temp_sat,

            'moist_sun' => $moist_sun,
            'moist_mon' => $moist_mon,
            'moist_tue' => $moist_tue,
            'moist_wed' => $moist_wed,
            'moist_thu' => $moist_thu,
            'moist_fri' => $moist_fri,
            'moist_sat' => $moist_sat
        ];
    }
}
