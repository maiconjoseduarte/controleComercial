<?php

/* @var $this yii\web\View */
/* @var $model common\models\Contrato */
/* @var $form yii\widgets\ActiveForm */
/* @var $disabled bool */
/* @var $idGrupo string */

$this->title = ($model) ? "{$model->grupo->id} - {$model->grupo->nome} (Informações Gerais)" : '';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-body">

                <?= $this->render('botoes-topo', [
                    'idGrupo' => $idGrupo
                ]); ?>
                <hr class="mb-5">

                <?php
                    if ($model == false) {
                        return;
                    }

                    echo $this->render('@app/modules/app/views/contrato/_form', [
                        'model' => $model,
                        'disabled' => $disabled
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>
