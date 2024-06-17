<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jadwal_nyiram".
 *
 * @property int $id
 * @property float $humidity_value
 * @property string $humidity_state
 * @property int $time
 */
class JadwalNyiram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jadwal_nyiram';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['humidity_value', 'humidity_state', 'time'], 'required'],
            [['humidity_value'], 'number'],
            [['time'], 'integer'],
            [['humidity_state'], 'string', 'max' => 50],
            [['time'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'humidity_value' => 'Humidity Value',
            'humidity_state' => 'Humidity State',
            'time' => 'Time',
        ];
    }
}
