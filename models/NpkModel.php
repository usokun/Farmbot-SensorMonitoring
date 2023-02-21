<?php
namespace app\models;

use Yii;
use yii\db\Query;

class NpkModel extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'lora_npk_t';
    }

    public function getNpkData()
    {
        $thisWeekStart = date('Y-m-d', strtotime('last Sunday + 1 day'));
        $thisWeekEnd = date('Y-m-d', strtotime('next Sunday'));
        $prevWeekStart = date('Y-m-d', strtotime('2 weeks ago last Sunday + 1 day'));
        $prevWeekEnd = date('Y-m-d', strtotime('last Sunday'));

        $query = new Query();
        $data = $query->select("
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$thisWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$thisWeekEnd}' THEN N ELSE NULL END AS this_week_N,
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$thisWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$thisWeekEnd}' THEN P ELSE NULL END AS this_week_P,
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$thisWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$thisWeekEnd}' THEN K ELSE NULL END AS this_week_K,
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$prevWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$prevWeekEnd}' THEN N ELSE NULL END AS prev_week_N,
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$prevWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$prevWeekEnd}' THEN P ELSE NULL END AS prev_week_P,
            CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$prevWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$prevWeekEnd}' THEN K ELSE NULL END AS prev_week_K
        ")
        ->from(self::tableName())
        ->where([
            'OR',
            ['BETWEEN', 'DATE(FROM_UNIXTIME(time))', $thisWeekStart, $thisWeekEnd],
            ['BETWEEN', 'DATE(FROM_UNIXTIME(time))', $prevWeekStart, $prevWeekEnd],
        ])
        ->groupBy(new \yii\db\Expression("CASE WHEN DATE(FROM_UNIXTIME(time)) >= '{$thisWeekStart}' AND DATE(FROM_UNIXTIME(time)) <= '{$thisWeekEnd}' THEN 'this_week' ELSE 'prev_week' END"))
        ->createCommand()
        ->queryAll();

        $this_week_N = !empty($data[0]->this_week_N) ? $data[0]->this_week_N : 0;
        $this_week_P = !empty($data[0]->this_week_P) ? $data[0]->this_week_P : 0;
        $this_week_K = !empty($data[0]->this_week_K) ? $data[0]->this_week_K : 0;
        $prev_week_N = !empty($data[1]->prev_week_N) ? $data[1]->prev_week_N : 0;
        $prev_week_P = !empty($data[1]->prev_week_P) ? $data[1]->prev_week_P : 0;
        $prev_week_K = !empty($data[1]->prev_week_K) ? $data[1]->prev_week_K : 0;

        return compact('this_week_N', 'this_week_P', 'this_week_K', 'prev_week_N', 'prev_week_P', 'prev_week_K');
    }
}