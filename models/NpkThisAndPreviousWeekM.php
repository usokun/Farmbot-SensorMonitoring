<?php

namespace app\models;

use Yii;

class NpkThisAndPreviousWeekM extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'lora_npk_t';
    }

    public static function getThisAndPreviousWeekNPK()
    {

        $data = self::find()
            ->select([
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN T END) AS this_week_T',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN H END) AS this_week_H',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN PH END) AS this_week_PH',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN N END) AS this_week_N',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN P END) AS this_week_P',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) THEN K END) AS this_week_K',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN T END) AS prev_week_T',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN H END) AS prev_week_H',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN PH END) AS prev_week_PH',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN N END) AS prev_week_N',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN P END) AS prev_week_P',
                'AVG(CASE WHEN YEARWEEK(FROM_UNIXTIME(time)) = YEARWEEK(CURRENT_DATE()) - 1 THEN K END) AS prev_week_K',
            ])
            ->asArray()
            ->one();

        $this_week_T = !empty($data['this_week_T']) ? $data['this_week_T'] : 0;
        $this_week_H = !empty($data['this_week_H']) ? $data['this_week_H'] : 0;
        $this_week_PH = !empty($data['this_week_PH']) ? $data['this_week_PH'] : 0;
        $this_week_N = !empty($data['this_week_N']) ? $data['this_week_N'] : 0;
        $this_week_P = !empty($data['this_week_P']) ? $data['this_week_P'] : 0;
        $this_week_K = !empty($data['this_week_K']) ? $data['this_week_K'] : 0;
        $prev_week_T = !empty($data['prev_week_T']) ? $data['prev_week_T'] : 0;
        $prev_week_H = !empty($data['prev_week_H']) ? $data['prev_week_H'] : 0;
        $prev_week_PH = !empty($data['prev_week_PH']) ? $data['prev_week_PH'] : 0;
        $prev_week_N = !empty($data['prev_week_N']) ? $data['prev_week_N'] : 0;
        $prev_week_P = !empty($data['prev_week_P']) ? $data['prev_week_P'] : 0;
        $prev_week_K = !empty($data['prev_week_K']) ? $data['prev_week_K'] : 0;

        return [
            'this_week_T' => round($this_week_T, 2),
            'this_week_H' => round($this_week_H, 2),
            'this_week_PH' => round($this_week_PH, 2),
            'this_week_N' => round($this_week_N, 2),
            'this_week_P' => round($this_week_P, 2),
            'this_week_K' => round($this_week_K, 2),

            'prev_week_T' => round($prev_week_T, 2),
            'prev_week_H' => round($prev_week_H, 2),
            'prev_week_PH' => round($prev_week_PH, 2),
            'prev_week_N' => round($prev_week_N, 2),
            'prev_week_P' => round($prev_week_P, 2),
            'prev_week_K' => round($prev_week_K, 2),
        ];
    }
}
