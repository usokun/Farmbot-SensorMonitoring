<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lora_npk_t".
 *
 * @property int $val_id
 * @property int $s_group_id
 * @property float $T
 * @property float $H
 * @property float $PH
 * @property float $N
 * @property float $P
 * @property float $K
 * @property int $time
 */
class LoraNpkT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lora_npk_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_group_id', 'T', 'H', 'PH', 'N', 'P', 'K', 'time'], 'required'],
            [['s_group_id', 'time'], 'integer'],
            [['T', 'H', 'PH', 'N', 'P', 'K'], 'number'],
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
            'T' => 'T',
            'H' => 'H',
            'PH' => 'Ph',
            'N' => 'N',
            'P' => 'P',
            'K' => 'K',
            'time' => 'Time',
        ];
    }
}
