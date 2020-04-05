<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Filial */

$this->title = ($model) ? "{$model->grupo->id} - {$model->grupo->nome}" : '';
$this->params['breadcrumbs'][] = ['label' => 'Filial', 'url' => ['index', 'idGrupo' => $model->idGrupo]];
$this->params['breadcrumbs'][] = $this->title;
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
