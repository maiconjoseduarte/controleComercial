<?php

namespace app\modules\app\controllers;

use common\components\AuthController;
use common\exceptions\FeedbackException;
use common\models\Grupo;
use Yii;
use common\models\Filial;
use frontend\modules\app\models\FilialSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilialController implements the CRUD actions for Filial model.
 */
class FilialController extends AuthController
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
     * Lists all Filial models.
     * @return mixed
     */
    public function actionIndex($idGrupo)
    {
        $grupo = Grupo::findOne($idGrupo);

        $searchModel = new FilialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $idGrupo);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grupo' => $grupo
        ]);
    }

    /**
     * Displays a single Filial model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Filial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idGrupo)
    {
        $grupo = Grupo::findOne($idGrupo);
        $model = new Filial();
        $model->idGrupo = $grupo->id;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->save() === false) {
                    throw new FeedbackException("Ocorreu um erro ao salvar registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Filial cadastrada com sucesso.');

                return $this->redirect(['index', 'idGrupo' => $model->idGrupo]);
            } catch (FeedbackException $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
                $transaction->rollBack();
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage());
                Yii::$app->session->addFlash('error', 'Ocorreu um erro imprevisto.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Filial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->save() === false) {
                    throw new FeedbackException("Ocorreu um erro ao editar registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Filial editada com sucesso.');

                return $this->redirect(['index', 'idGrupo' => $model->idGrupo]);
            } catch (FeedbackException $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
                $transaction->rollBack();
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage());
                Yii::$app->session->addFlash('error', 'Ocorreu um erro imprevisto.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Filial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->delete() === false) {
                    throw new FeedbackException("Ocorreu um erro ao excluir o registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Filial excluida com sucesso.');

                return $this->redirect(['index', 'idGrupo' => $model->idGrupo]);
            } catch (FeedbackException $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
                $transaction->rollBack();
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage());
                Yii::$app->session->addFlash('error', 'Ocorreu um erro imprevisto.');
            }
        }
    }

    /**
     * Finds the Filial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Filial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Filial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
