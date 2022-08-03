<?php

namespace app\controllers;

use Yii;
use app\models\Pasien;
use app\models\search\PasienSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['beranda','ubah-profil','logout'],
                        'allow' => true,
                        'matchCallback' => function()
                        {
                            return !Yii::$app->pasien->isGuest;
                        }
                    ],
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'matchCallback' => function()
                        {
                            return !Yii::$app->user->isGuest;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pasien models.
     * @return mixed
     */

    public function actionBeranda()
    {
        return $this->render('beranda');
    }
    
    public function actionIndex()
    {
        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['ahli_gizi_id' => Yii::$app->user->identity->id_ahli]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasien model.
     * @param integer $id_pasien
     * @param integer $ahli_gizi_id
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

        try {
            if ($model->load(Yii::$app->request->post())) {
                $ahliId = Yii::$app->user->identity->id_ahli;
                $model->setPassword($model->password);
                $model->ulangi_password = $model->password;
                $model->ahli_gizi_id = $ahliId;
    
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Data pasien berhasil ditambahkan');
                    return $this->redirect(['view', 'id' => $model->id_pasien]);
                }else{
                    Yii::$app->session->setFlash('error', 'Data pasien gagal ditambahkan');
                }
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        } catch (\Exception $e) {
            throw new ServerErrorHttpException('Terjadi masalah');
        }
        
    }

    /**
     * Updates an existing Pasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_pasien
     * @param integer $ahli_gizi_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUbahProfil()
    {
        $userId = Yii::$app->pasien->identity->id;

        try {
            if($userId){
        
                $model = $this->findModel($userId);
    
                if ($model->load(Yii::$app->request->post()) ) {

                    if($model->password_baru){
                        $model->setPassword($model->password_baru);
                    }

                    if($model->save()){
                        Yii::$app->session->setFlash('success', 'Profil berhasil diubah');
                    }else{
                        Yii::$app->session->setFlash('error', 'Profil gagal diubah');
                    }

                    $model->password_baru = "";
                    $model->ulangi_password_baru = "";
                }
    
                return $this->render('_form-ubah-profil', [
                    'model' => $model,
                ]);
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } catch (\Exception $e) {
            throw new ServerErrorHttpException('Terjadi Masalah');
        }
        
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // try {
            if ($model->load(Yii::$app->request->post())) {
                if($model->password_baru){
                    $model->setPassword($model->password_baru);
                }
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id_pasien]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        // } catch (\Exception $e) {
        //     throw new ServerErrorHttpException('Terjadi masalah');
        // }
    }

    /**
     * Deletes an existing Pasien model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_pasien
     * @param integer $ahli_gizi_id
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
     * @param integer $id_pasien
     * @param integer $ahli_gizi_id
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

    public function actionLogout()
    {
        Yii::$app->pasien->logout();

        return $this->goHome();
    }
}