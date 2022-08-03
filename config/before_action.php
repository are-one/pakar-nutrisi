<?php

use yii\helpers\Url;
use yii\web\NotFoundHttpException;

return  function ($event) {

    $controller_ahli_gizi = ['ahli-gizi','pasien', 'penyakit', 'pengobatan','default','diagnosis'];
    $controller_pasien = ['pasien', 'diagnosis','default'];
    $controller = $event->action->controller->id;
    // print_r($controller);die;

    if (!Yii::$app->user->isGuest) {
        Yii::$app->layout = 'ahli-gizi';

        if (!in_array($controller, $controller_ahli_gizi)) {
            return Yii::$app->response->redirect(Url::to(['ahli-gizi/beranda']));
        }
    } elseif (!Yii::$app->pasien->isGuest) {
        Yii::$app->layout = 'pasien';

        if (!in_array($controller, $controller_pasien)) {
            return Yii::$app->response->redirect(Url::to(['pasien/beranda']));

            // throw new NotFoundHttpException("Halaman tidak ditemukan");
        }
    } elseif (in_array($controller, $controller_ahli_gizi)) {
        // return Yii::$app->response->redirect(Url::to(['site/login']));

        throw new NotFoundHttpException("Halaman tidak ditemukan");
    }
};