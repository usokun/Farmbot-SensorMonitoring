<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class SoilMoistWeekdaysM extends ActiveRecord
{
    public static function tableName()
    {
        return 'soil_moist_t';
    }

    public static function getMoistWeekdaysData()
    {
        $data = self::find()
            ->select([
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 1 THEN SMoist END) AS Sun',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 2 THEN SMoist END) AS Mon',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 3 THEN SMoist END) AS Tue',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 4 THEN SMoist END) AS Wed',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 5 THEN SMoist END) AS Thu',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 6 THEN SMoist END) AS Fri',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 7 THEN SMoist END) AS Sat'
            ])
            ->where(['>=', 'FROM_UNIXTIME(time)', new \yii\db\Expression('DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)')])
            ->orderBy('FROM_UNIXTIME(time)')
            ->asArray()
            ->all();

        $smoist_sun = 0;
        $smoist_mon = 0;
        $smoist_tue = 0;
        $smoist_wed = 0;
        $smoist_thu = 0;
        $smoist_fri = 0;
        $smoist_sat = 0;

        foreach ($data as $row) {
            $smoist_sun += !empty($row['Sun']) ? $row['Sun'] : 0;
            $smoist_mon += !empty($row['Mon']) ? $row['Mon'] : 0;
            $smoist_tue += !empty($row['Tue']) ? $row['Tue'] : 0;
            $smoist_wed += !empty($row['Wed']) ? $row['Wed'] : 0;
            $smoist_thu += !empty($row['Thu']) ? $row['Thu'] : 0;
            $smoist_fri += !empty($row['Fri']) ? $row['Fri'] : 0;
            $smoist_sat += !empty($row['Sat']) ? $row['Sat'] : 0;
        }

        $count = count($data);
        $smoist_sun = $count > 0 ? $smoist_sun / $count : 0;
        $smoist_mon = $count > 0 ? $smoist_mon / $count : 0;
        $smoist_tue = $count > 0 ? $smoist_tue / $count : 0;
        $smoist_wed = $count > 0 ? $smoist_wed / $count : 0;
        $smoist_thu = $count > 0 ? $smoist_thu / $count : 0;
        $smoist_fri = $count > 0 ? $smoist_fri / $count : 0;
        $smoist_sat = $count > 0 ? $smoist_sat / $count : 0;

        return [
            'smoist_sun' => $smoist_sun,
            'smoist_mon' => $smoist_mon,
            'smoist_tue' => $smoist_tue,
            'smoist_wed' => $smoist_wed,
            'smoist_thu' => $smoist_thu,
            'smoist_fri' => $smoist_fri,
            'smoist_sat' => $smoist_sat
        ];
    }
}
