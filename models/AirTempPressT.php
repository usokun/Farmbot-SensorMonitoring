<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "air_temp_press_t".
 *
 * @property int $val_id
 * @property int $s_group_id
 * @property float $ATemp
 * @property float $APress
 * @property int $time
 */
class AirTempPressT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'air_temp_press_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_group_id', 'ATemp', 'APress', 'time'], 'required'],
            [['s_group_id', 'time'], 'integer'],
            [['ATemp', 'APress'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'val_id' => 'Val ID',
            's_group_id' => 'S Group ID',
            'ATemp' => 'A Temp',
            'APress' => 'A Press',
            'time' => 'Time',
        ];
    }
}
