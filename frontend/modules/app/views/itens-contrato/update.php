<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItensContrato */

$this->title = 'Update Itens Contrato: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Itens Contratos', 'url' => ['index', 'idGrupo' => $model->idGrupo]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
