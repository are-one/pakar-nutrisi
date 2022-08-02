<?php

namespace app\controllers;

use app\models\AturanGejala;
use app\models\Diagnosis;
use app\models\DiagnosisGejala;
use app\models\Gejala;
use app\models\Pasien;
use app\models\Penyakit;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Validasi;
use Exception;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        return $this->render('index');
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

        $model = new Validasi();
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
        Yii::$app->pasien->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionInformasi()
    {
        return $this->render('informasi');
    }



    // public function actionDaftar()
    // {
    //     $model = new Pasien();
    //     $tgl_lama = "";

    //     if (Yii::$app->request->isPost) {
    //         $dataPost = Yii::$app->request->post();


    //         $model->load($dataPost);

    //         if ($model->validate()) {
    //             // Set tgl lahir
    //             $tgl_lama = $model->tgl_lahir;
    //             $tgl_lahir = strtotime($model->tgl_lahir);
    //             $model->tgl_lahir = date('Y-m-d', $tgl_lahir);


    //             // Set Password
    //             $model->setPassword($model->password);

    //             if ($model->save(false)) {
    //                 return $this->redirect(['login']);
    //             }
    //             // print_r($model);
    //             // die;
    //         }
    //     } else {
    //         $model->tgl_lahir = $tgl_lama;
    //     }
    //     return $this->render('daftar', ['model' => $model]);
    // }

    // =====================================================================================
    // DIAGNOSA PENYAKIT
    // =====================================================================================

}