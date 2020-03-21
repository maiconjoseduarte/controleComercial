<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Filial */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Filial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <?= $this->title; ?>
                </div>

                <ul class="nav">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
            <div class="card-body">
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
                        'codResponsavel',
                        'codSuporte',
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
