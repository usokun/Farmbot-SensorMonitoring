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
        $data = $this->createAPIRequest();

        return $this->render('index', [
            'predictData' => $data,
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

    public function createAPIRequest()
    {
        $client = new Client();

        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://127.0.0.1:5000/predict');

        $url = $request->getUrl();
        $method = $request->getMethod();
        $headers = $request->getHeaders() ? $request->getHeaders()->toArray() : [];
        $data = $request->getData() ? $request->getData()->toArray() : [];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data,
        ]);

        $handles[] = $ch;

        $mh = curl_multi_init();
        curl_multi_add_handle($mh, $ch);

        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        $responses = [];
        foreach ($handles as $ch) {
            $responses[] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);

        // Process responses
        foreach ($responses as $response) {
            // Handle responses here
            $data = json_decode($response, true);
            if ($data !== null) {
                return $data;
            } else {
                Yii::error('Failed to parse JSON response: ' . $response);
                throw new \yii\web\HttpException(500, 'Failed to parse JSON response');
            }
        }

        Yii::error('No response received');
        throw new \yii\web\HttpException(500, 'No response received');
    }


    public function actionPrediction()
    {
        // Call the sendSoilHumidityToFlask function
        $data = $this->createAPIRequest();
        // You can return any response you want, depending on the result of the function
        // For example, if the function returns data, you can return it as JSON

        // Yii::$app->response->format = Response::FORMAT_JSON;
        // return $data;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 500,
            ],
            'sort' => [
                // 'attributes' => ['timestamp', 'air_temp', 'air_humidity', 'soil_humidity', 'humidity_state'],
                'attributes' => ['timestamp', 'air_temp', 'soil_humidity', 'humidity_state'],
            ],
        ]);

        return $this->render('prediction', [
            'dataProvider' => $dataProvider,
            'title' => 'Soil Moisture Prediction'
        ]);
    }
}
