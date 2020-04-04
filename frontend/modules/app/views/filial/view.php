<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Filial */
/* @var $idGrupo bool */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Filial', 'url' => ['index', 'idGrupo' => $idGrupo]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-body">
                <?= $this->render('@app/modules/app/views/grupo/botoes-topo', [
                    'idGrupo' => $idGrupo
                ]); ?>
                <hr class="mb-5">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'idGrupo',
                        'nome',
                        'codIsoWeb',
                        'documento',
                        'uf',
                        'nomeCidade',
                        'especialidade',
                        'icms',
                        'cdFaturamento',
                        'ledTime:datetime',
                        'create_at',
                        'update_at',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
