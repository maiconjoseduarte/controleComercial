<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ItensContrato */

$this->title = ($model) ? "{$model->grupo->id} - {$model->grupo->nome}" : '';
$this->params['breadcrumbs'][] = ['label' => 'Itens Contratos', 'url' => ['index', 'idGrupo' => $model->idGrupo]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-body">
                <?= $this->render('@app/modules/app/views/grupo/botoes-topo', [
                    'idGrupo' => $model->idGrupo
                ]); ?>
                <hr class="mb-5">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'idGrupo',
                        'statusItem',
                        'statusHomologacao',
                        'codCliente',
                        'codCremer',
                        'descricao',
                        'unidadeMedida',
                        'consumoAnual',
                        'preco',
                        'valorMedioAnual',
                        'vigencia',
                        'observacao',
                        'create_at',
                        'update_at',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
