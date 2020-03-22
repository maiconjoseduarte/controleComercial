<?php

namespace app\modules\app\controllers;

use common\components\AuthController;
use common\exceptions\FeedbackException;
use Yii;
use common\models\Contrato;
use frontend\modules\app\models\ContratoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratoController implements the CRUD actions for Contrato model.
 */
class ContratoController extends AuthController
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
     * Lists all Contrato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contrato model.
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
     * Creates a new Contrato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contrato();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->save() === false) {
                    throw new FeedbackException("Ocorreu um erro ao salvar registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Contrato cadastrado com sucesso.');

                return $this->redirect(['index']);
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
     * Updates an existing Contrato model.
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
                Yii::$app->session->addFlash('success', 'Contrato editado com sucesso.');

                return $this->redirect(['index']);
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
     * Deletes an existing Contrato model.
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
                Yii::$app->session->addFlash('success', 'Contrato excluido com sucesso.');

                return $this->redirect(['index']);
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
     * Finds the Contrato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contrato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contrato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
