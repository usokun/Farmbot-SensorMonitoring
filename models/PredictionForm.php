<?php

namespace app\models;

use yii\base\Model;

class PredictionForm extends Model
{
    public $sh;
    public $st;

    public function rules()
    {
        return [
            [['sh', 'st'], 'required'],
            [['sh', 'st'], 'number'],
        ];
    }
}
