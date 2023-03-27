<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soil_moist_p".
 *
 * @property int $id
 * @property string $timestamp
 * @property float $temp
 * @property float $smoist
 * @property string $moist_state
 */
class SoilMoistP extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soil_moist_p';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['temp', 'smoist', 'moist_state'], 'required'],
            [['temp', 'smoist'], 'number'],
            [['moist_state'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'temp' => 'Temp',
            'smoist' => 'Smoist',
            'moist_state' => 'Moist State',
        ];
    }
}
