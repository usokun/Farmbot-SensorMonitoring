<?php

namespace app\controllers;

use app\models\AirTempPressT;
use app\models\AirTempPressTSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AirTempPressTController implements the CRUD actions for AirTempPressT model.
 */
class AirTempPressTController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AirTempPressT models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AirTempPressTSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AirTempPressT model.
     * @param int $val_id Val ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($val_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($val_id),
        ]);
    }

    /**
     * Creates a new AirTempPressT model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AirTempPressT();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'val_id' => $model->val_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AirTempPressT model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $val_id Val ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($val_id)
    {
        $model = $this->findModel($val_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'val_id' => $model->val_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AirTempPressT model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $val_id Val ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($val_id)
    {
        $this->findModel($val_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AirTempPressT model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $val_id Val ID
     * @return AirTempPressT the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($val_id)
    {
        if (($model = AirTempPressT::findOne(['val_id' => $val_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
