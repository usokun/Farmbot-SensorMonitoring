<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soil_moist_t".
 *
 * @property int $val_id
 * @property int $s_group_id
 * @property float $SMoist
 * @property int $time
 */
class SoilMoistT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soil_moist_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_group_id', 'SMoist', 'time'], 'required'],
            [['s_group_id', 'time'], 'integer'],
            [['SMoist'], 'number'],
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
            'SMoist' => 'S Moist',
            'time' => 'Time',
        ];
    }
}
