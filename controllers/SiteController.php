<?php

namespace app\controllers;

use Yii;
use yii\httpclient\Client;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\LoraNpkT;
use app\models\LoraNpkTSearch;
use app\models\SoilMoistT;
use app\models\SoilMoistTSearch;
use app\models\SoilMoistP;
use app\models\AirTempPressT;
use app\models\AirTempPressTSearch;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // return $this->render('index');
        $searchModelNPK = new LoraNpkTSearch();
        $dataProviderNPK = $searchModelNPK->search($this->request->queryParams);
        $dataProviderNPK->pagination = ['pageSize' => 10];

        $searchModelSMoist = new SoilMoistTSearch();
        $dataProviderSMoist = $searchModelSMoist->search($this->request->queryParams);
        $dataProviderSMoist->pagination = ['pageSize' => 10];

        $searchModelAirTempPress = new AirTempPressTSearch();
        $dataProviderAirTempPress = $searchModelAirTempPress->search($this->request->queryParams);
        $dataProviderAirTempPress->pagination = ['pageSize' => 10];


        return $this->render('index', [
            'searchModelNPK' => $searchModelNPK,
            'dataProviderNPK' => $dataProviderNPK,
            'searchModelSMoist' => $searchModelSMoist,
            'dataProviderSMoist' => $dataProviderSMoist,
            'searchModelAirTempPress' => $searchModelAirTempPress,
            'dataProviderAirTempPress' => $dataProviderAirTempPress

        ]);
    }
    public function actionDashboard()
    {
        $searchModelNPK = new LoraNpkTSearch();
        $dataProviderNPK = $searchModelNPK->search($this->request->queryParams);
        $dataProviderNPK->pagination = ['pageSize' => 10];

        $searchModelSMoist = new SoilMoistTSearch();
        $dataProviderSMoist = $searchModelSMoist->search($this->request->queryParams);
        $dataProviderSMoist->pagination = ['pageSize' => 10];

        $searchModelAirTempPress = new AirTempPressTSearch();
        $dataProviderAirTempPress = $searchModelAirTempPress->search($this->request->queryParams);
        $dataProviderAirTempPress->pagination = ['pageSize' => 10];


        return $this->render('dashboard', [
            'searchModelNPK' => $searchModelNPK,
            'dataProviderNPK' => $dataProviderNPK,
            'searchModelSMoist' => $searchModelSMoist,
            'dataProviderSMoist' => $dataProviderSMoist,
            'searchModelAirTempPress' => $searchModelAirTempPress,
            'dataProviderAirTempPress' => $dataProviderAirTempPress

        ]);
    }

    /**
     * Displays a single SensorV model.
     * @param int $val_id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('../LoraNpk/view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Finds the SensorV model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SensorV the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LoraNpkT::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // /**
    //  * Displays contact page.
    //  *
    //  * @return Response|string
    //  */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPrediction()
    {
        // Create a new HTTP client instance
        $client = new Client();

        // Send a GET request to the /predict endpoint
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://127.0.0.1:5000/predict')
            ->send();

        // Check if the request was successful
        if ($response->isOk) {
            // Parse the JSON response
            $data = json_decode($response->content, true);

            // Extract the response data
            $data = $response->getData();

            $dataProvider = new ArrayDataProvider([
                'allModels' => $data,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'attributes' => ['timestamp', 'temp', 'smoist', 'moist_state'],
                ],
            ]);

            return $this->render('prediction', [
                'dataProvider' => $dataProvider,
                'title' => 'Soil Moisture Prediction'
            ]);
        } else {
            // Handle the error case
            Yii::error('Failed to fetch data from /predict: ' . $response->content);
            throw new \yii\web\HttpException(500, 'Failed to fetch data from /predict');
        }

        // Instantiate the httpclient component
        $client = Yii::$app->httpclient;

        // Send a GET request to the /predict endpoint
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('/predict')
            ->send();
    }
}
