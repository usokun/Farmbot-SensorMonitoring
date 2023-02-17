<?php

namespace app\controllers;

use app\models\SoilMoistT;
use app\models\SoilMoistTSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SoilMoistTController implements the CRUD actions for SoilMoistT model.
 */
class SoilMoistTController extends Controller
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
     * Lists all SoilMoistT models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SoilMoistTSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoilMoistT model.
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
     * Creates a new SoilMoistT model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SoilMoistT();

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
     * Updates an existing SoilMoistT model.
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
     * Deletes an existing SoilMoistT model.
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
     * Finds the SoilMoistT model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $val_id Val ID
     * @return SoilMoistT the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($val_id)
    {
        if (($model = SoilMoistT::findOne(['val_id' => $val_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
