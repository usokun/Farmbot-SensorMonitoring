<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class AirTempPressWeekdaysM extends ActiveRecord
{
    public static function tableName()
    {
        return 'air_temp_press_t';
    }

    public static function getAirTempPressWeekdaysData()
    {
        $data = self::find()
            ->select([
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 1 THEN ATemp END) AS Sun_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 2 THEN ATemp END) AS Mon_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 3 THEN ATemp END) AS Tue_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 4 THEN ATemp END) AS Wed_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 5 THEN ATemp END) AS Thu_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 6 THEN ATemp END) AS Fri_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 7 THEN ATemp END) AS Sat_ATemp',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 1 THEN APress END) AS Sun_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 2 THEN APress END) AS Mon_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 3 THEN APress END) AS Tue_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 4 THEN APress END) AS Wed_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 5 THEN APress END) AS Thu_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 6 THEN APress END) AS Fri_APress',
                'AVG(CASE WHEN DAYOFWEEK(FROM_UNIXTIME(time)) = 7 THEN APress END) AS Sat_APress',
            ])
            ->where(['>=', 'FROM_UNIXTIME(time)', new \yii\db\Expression('DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)')])
            ->orderBy('FROM_UNIXTIME(time)')
            ->asArray()
            ->all();

        $atemp_sun = 0;
        $atemp_mon = 0;
        $atemp_tue = 0;
        $atemp_wed = 0;
        $atemp_thu = 0;
        $atemp_fri = 0;
        $atemp_sat = 0;

        $apress_sun = 0;
        $apress_mon = 0;
        $apress_tue = 0;
        $apress_wed = 0;
        $apress_thu = 0;
        $apress_fri = 0;
        $apress_sat = 0;

        foreach ($data as $row) {
            $atemp_sun += !empty($row['Sun_ATemp']) ? $row['Sun_ATemp'] : 0;
            $atemp_mon += !empty($row['Mon_ATemp']) ? $row['Mon_ATemp'] : 0;
            $atemp_tue += !empty($row['Tue_ATemp']) ? $row['Tue_ATemp'] : 0;
            $atemp_wed += !empty($row['Wed_ATemp']) ? $row['Wed_ATemp'] : 0;
            $atemp_thu += !empty($row['Thu_ATemp']) ? $row['Thu_ATemp'] : 0;
            $atemp_fri += !empty($row['Fri_ATemp']) ? $row['Fri_ATemp'] : 0;
            $atemp_sat += !empty($row['Sat_ATemp']) ? $row['Sat_ATemp'] : 0;

            $apress_sun += !empty($row['Sun_APress']) ? $row['Sun_APress'] : 0;
            $apress_mon += !empty($row['Mon_APress']) ? $row['Mon_APress'] : 0;
            $apress_tue += !empty($row['Tue_APress']) ? $row['Tue_APress'] : 0;
            $apress_wed += !empty($row['Wed_APress']) ? $row['Wed_APress'] : 0;
            $apress_thu += !empty($row['Thu_APress']) ? $row['Thu_APress'] : 0;
            $apress_fri += !empty($row['Fri_APress']) ? $row['Fri_APress'] : 0;
            $apress_sat += !empty($row['Sat_APress']) ? $row['Sat_APress'] : 0;
        }

        $count = count($data);
        $atemp_sun = $count > 0 ? $atemp_sun / $count : 0;
        $atemp_mon = $count > 0 ? $atemp_mon / $count : 0;
        $atemp_tue = $count > 0 ? $atemp_tue / $count : 0;
        $atemp_wed = $count > 0 ? $atemp_wed / $count : 0;
        $atemp_thu = $count > 0 ? $atemp_thu / $count : 0;
        $atemp_fri = $count > 0 ? $atemp_fri / $count : 0;
        $atemp_sat = $count > 0 ? $atemp_sat / $count : 0;

        $apress_sun = $count > 0 ? $apress_sun / $count : 0;
        $apress_mon = $count > 0 ? $apress_mon / $count : 0;
        $apress_tue = $count > 0 ? $apress_tue / $count : 0;
        $apress_wed = $count > 0 ? $apress_wed / $count : 0;
        $apress_thu = $count > 0 ? $apress_thu / $count : 0;
        $apress_fri = $count > 0 ? $apress_fri / $count : 0;
        $apress_sat = $count > 0 ? $apress_sat / $count : 0;

        return [
            'atemp_sun' => round($atemp_sun, 2),
            'atemp_mon' => round($atemp_mon, 2),
            'atemp_tue' => round($atemp_tue, 2),
            'atemp_wed' => round($atemp_wed, 2),
            'atemp_thu' => round($atemp_thu, 2),
            'atemp_fri' => round($atemp_fri, 2),
            'atemp_sat' => round($atemp_sat, 2),

            'apress_sun' => round($apress_sun, 2),
            'apress_mon' => round($apress_mon, 2),
            'apress_tue' => round($apress_tue, 2),
            'apress_wed' => round($apress_wed, 2),
            'apress_thu' => round($apress_thu, 2),
            'apress_fri' => round($apress_fri, 2),
            'apress_sat' => round($apress_sat, 2)
        ];
    }
}
