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
        $thisWeekStart = date('Y-m-d', strtotime('last sunday + 1 day'));
        $thisWeekEnd = date('Y-m-d', strtotime('this saturday'));
        $prevWeekStart = date('Y-m-d', strtotime('last sunday - 6 days'));
        $prevWeekEnd = date('Y-m-d', strtotime('last sunday'));

        $data = self::find()
            ->select([
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(T) ELSE NULL END AS this_week_T ',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(H) ELSE NULL END AS this_week_H',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(PH) ELSE NULL END AS this_week_PH',

                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(N) ELSE NULL END AS this_week_N',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(P) ELSE NULL END AS this_week_P',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :thisWeekStart AND DATE(FROM_UNIXTIME(time)) <= :thisWeekEnd THEN avg(K) ELSE NULL END AS this_week_K',

                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(T) ELSE NULL END AS prev_week_T ',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(H) ELSE NULL END AS prev_week_H',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(PH) ELSE NULL END AS prev_week_PH',

                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(N) ELSE NULL END AS prev_week_N',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(P) ELSE NULL END AS prev_week_P',
                'CASE WHEN DATE(FROM_UNIXTIME(time)) >= :prevWeekStart AND DATE(FROM_UNIXTIME(time)) <= :prevWeekEnd THEN avg(K) ELSE NULL END AS prev_week_K',
            ])
            ->params([
                ':thisWeekStart' => $thisWeekStart,
                ':thisWeekEnd' => $thisWeekEnd,
                ':prevWeekStart' => $prevWeekStart,
                ':prevWeekEnd' => $prevWeekEnd,
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
            'this_week_T' => round($this_week_T,2),
            'this_week_H' => round($this_week_H,2),
            'this_week_PH' => round($this_week_PH,2),
            'this_week_N' => round($this_week_N,2),
            'this_week_P' => round($this_week_P,2),
            'this_week_K' => round($this_week_K,2),

            'prev_week_T' => round($prev_week_T,2),
            'prev_week_H' => round($prev_week_H,2),
            'prev_week_PH' => round($prev_week_PH,2),
            'prev_week_N' => round($prev_week_N,2),
            'prev_week_P' => round($prev_week_P,2),
            'prev_week_K' => round($prev_week_K,2),
        ];
    }
}

?>