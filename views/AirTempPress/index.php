<?php

use app\models\AirTempPressT;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AirTempPressTSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Air Temp Press Ts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="air-temp-press-t-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Air Temp Press T', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'val_id',
            's_group_id',
            'ATemp',
            'APress',
            'time:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AirTempPressT $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'val_id' => $model->val_id]);
                 }
            ],
        ],
    ]); ?>


</div>
