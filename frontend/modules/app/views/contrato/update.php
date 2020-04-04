<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contrato */

$this->title = "{$model->grupo->id} - {$model->grupo->nome}";
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->grupo->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
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
            <?= $this->render('_form', [
                'model' => $model,
                'disabled' => false,
            ]) ?>
        </div>
    </div>
</div>
