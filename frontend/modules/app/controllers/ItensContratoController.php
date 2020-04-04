<?php

namespace app\modules\app\controllers;

use common\exceptions\FeedbackException;
use common\models\Grupo;
use Yii;
use common\models\ItensContrato;
use frontend\modules\app\models\ItensContratoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItensContratoController implements the CRUD actions for ItensContrato model.
 */
class ItensContratoController extends Controller
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
     * @param $idGrupo
     * @return string
     */
    public function actionIndex($idGrupo)
    {
        $searchModel = new ItensContratoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $idGrupo);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'idGrupo' => $idGrupo
        ]);
    }

    /**
     * Displays a single ItensContrato model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'idGrupo' => $model->idGrupo,
        ]);
    }

    /**
     * Creates a new ItensContrato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idGrupo)
    {
        $grupo = Grupo::findOne($idGrupo);

        $model = new ItensContrato();
        $model->idGrupo = $grupo->id;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                if ($model->save() === false) {
                    throw new FeedbackException("Ocorreu um erro ao salvar registro.");
                }

                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Item cadastrada com sucesso.');

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
     * Updates an existing ItensContrato model.
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
                Yii::$app->session->addFlash('success', 'Item editada com sucesso.');

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
     * Deletes an existing ItensContrato model.
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
                Yii::$app->session->addFlash('success', 'item excluida com sucesso.');

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
     * Finds the ItensContrato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItensContrato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItensContrato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
