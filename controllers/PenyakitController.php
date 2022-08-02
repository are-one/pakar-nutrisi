<?php

namespace app\controllers;

use app\models\Model;
use app\models\Pengobatan;
use Yii;
use app\models\Penyakit;
use app\models\PenyakitHasPengobatan;
use app\models\search\PenyakitSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenyakitController implements the CRUD actions for Penyakit model.
 */
class PenyakitController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Penyakit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenyakitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penyakit model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $queryPenyakitPengobatan = PenyakitHasPengobatan::find()->where(['penyakit_id' => $id]);

        $dataProviderPenyakitHasPengobatan = new ActiveDataProvider([
            'query' => $queryPenyakitPengobatan,
            'pagination' => [
                'pageSize' => false,
            ]
        ]);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderPenyakitHasPengobatan' => $dataProviderPenyakitHasPengobatan,
        ]);
    }

    /**
     * Creates a new Penyakit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penyakit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_penyakit]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatePengobatanPenyakit($id)
    {
        // === INSIALISASI MODEL
        $modelPenyakitHasPengobatan = [new PenyakitHasPengobatan()];
        $sql = "SELECT * FROM pengobatan WHERE id_pengobatan NOT IN (SELECT pengobatan_id FROM penyakit_has_pengobatan WHERE penyakit_id='$id')";
        $listPengobatan = Pengobatan::findBySql($sql)->all();

        // === PROSES MENYIMPAN
        if (Yii::$app->request->isPost) {
            $modelPenyakitHasPengobatan = Model::createMultiple(PenyakitHasPengobatan::className());

            Model::loadMultiple($modelPenyakitHasPengobatan, Yii::$app->request->post());

            if (isset($id)) {
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    foreach ($modelPenyakitHasPengobatan as $pengobatanPenyakit) {
                        $pengobatanPenyakit->penyakit_id = $id;

                        if (!($status = $pengobatanPenyakit->save())) {
                            $transaction->rollBack();

                            break;
                        }
                    }

                    if ($status) {
                        $transaction->commit();

                        return $this->redirect(['view', 'id' => $id]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }


        // === MERENDER TAMPILAN
        return $this->render('create-pengobatan-penyakit', [
            'id_penyakit' => $id,
            'modelPenyakitHasPengobatan' => empty($modelPenyakitHasPengobatan) ? [new PenyakitHasPengobatan()] : $modelPenyakitHasPengobatan,
            'listPengobatan' => $listPengobatan,
        ]);
    }

    /**
     * Updates an existing Penyakit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_penyakit]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Penyakit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        if(PenyakitHasPengobatan::deleteAll(['penyakit_id' => $id])){
            Yii::$app->session->setFlash('success', 'Data penyakit berhasil dihapus');
            $this->findModel($id)->delete();
        }else{
            Yii::$app->session->setFlash('error', 'Data penyakit gagal dihapus');
        }

        return $this->redirect(['index']);
    }

    /** =========================================================================================
     =======  AKSI MENGHAPUS DATA PENYAKIT HAS PENGOBATAN  ==============================================
     =============================================================================================*/
     public function actionDeletePenyakitPengobatan($penyakit_id, $pengobatan_id)
     {
         $modelPenangananPenyakit = PenyakitHasPengobatan::find()->where(['penyakit_id' => $penyakit_id, 'pengobatan_id' => $pengobatan_id])->one();
 
         $modelPenangananPenyakit->delete();
 
         return $this->redirect(['view', 'id' => $penyakit_id]);
     }

    /**
     * Finds the Penyakit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Penyakit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penyakit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}