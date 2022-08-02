<?php

namespace app\controllers;

use app\models\Diagnosis;
use app\models\JenisKelamin;
use Yii;
use app\models\Pasien;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PasienController implements the CRUD actions for Pasien model.
 */
class PasienController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-diagnosa' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pasien models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pasien::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasien model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pasien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pasien();
        $data_jk = (new JenisKelamin())->find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->setPassword($model->password);

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id_pasien]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data_jk' => $data_jk,
        ]);
    }

    /**
     * Updates an existing Pasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_jk = (new JenisKelamin())->find()->all();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->password_baru != "") {
                $model->setPassword($model->password_baru);
            }

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id_pasien]);
            }
        }

        // print_r($model->getErrors());
        // die;

        return $this->render('update', [
            'model' => $model,
            'data_jk' => $data_jk,
        ]);
    }

    /**
     * Deletes an existing Pasien model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pasien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLaporan()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pasien::find()->joinWith('diagnoses', true, 'INNER JOIN'),
        ]);

        return $this->render('laporan', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteDiagnosa($id)
    {
        $modelDiagnosis = Diagnosis::findOne($id);

        if ($modelDiagnosis->delete()) {
            Yii::$app->session->setFlash("success", "Data <strong>berhasil</strong> dihapus.");
        } else {
            Yii::$app->session->setFlash("danger", "Data <strong>gagal</strong> diubah.");
        }
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Pasien::find()->joinWith('diagnoses', true, 'INNER JOIN'),
        // ]);

        return $this->redirect(['laporan']);
    }
}