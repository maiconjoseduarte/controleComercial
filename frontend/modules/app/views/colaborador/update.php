<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Colaborador */

$this->title = 'Editar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colaboradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
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
            ]) ?>
        </div>
    </div>
</div>
