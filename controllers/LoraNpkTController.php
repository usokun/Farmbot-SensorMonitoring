<?php

namespace app\controllers;

use app\models\LoraNpkT;
use app\models\LoraNpkTSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoraNpkTController implements the CRUD actions for LoraNpkT model.
 */
class LoraNpkTController extends Controller
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
     * Lists all LoraNpkT models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LoraNpkTSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LoraNpkT model.
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
     * Creates a new LoraNpkT model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LoraNpkT();

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
     * Updates an existing LoraNpkT model.
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
     * Deletes an existing LoraNpkT model.
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
     * Finds the LoraNpkT model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $val_id Val ID
     * @return LoraNpkT the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($val_id)
    {
        if (($model = LoraNpkT::findOne(['val_id' => $val_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
