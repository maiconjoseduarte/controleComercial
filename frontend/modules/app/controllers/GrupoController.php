<?php

namespace app\modules\app\controllers;

use common\components\AuthController;
use common\exceptions\FeedbackException;
use common\models\Filial;
use common\models\ItensContrato;
use Yii;
use common\models\Grupo;
use frontend\modules\app\models\GrupoSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends AuthController
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
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $filiais = new ActiveDataProvider([
            'query' => Filial::find()->where(['idGrupo' => $model->id]),
            'pagination' => false
        ]);

        $itensContrato = new ActiveDataProvider([
            'query' => ItensContrato::find()->where(['idGrupo' => $model->id]),
            'pagination' => false
        ]);

        return $this->render('view', [
            'model' => $model,
            'filiais' => $filiais,
            'itensContrato' => $itensContrato
        ]);
    }

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grupo();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->save() === false) {
                    throw new FeedbackException("Ocorreu um erro ao salvar o registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Grupo cadastrado com sucesso.');

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
     * Updates an existing Grupo model.
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
                    throw new FeedbackException("Ocorreu um erro ao editar o registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Grupo atualizado com sucesso.');

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
     * Deletes an existing Grupo model.
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
                Yii::$app->session->addFlash('success', 'Grupo excluido com sucesso.');

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
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
