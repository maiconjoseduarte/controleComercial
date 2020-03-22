<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\app\models\ContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idGrupo') ?>

    <?= $form->field($model, 'dataInicio') ?>

    <?= $form->field($model, 'totalReceitaLiquidaInicio') ?>

    <?= $form->field($model, 'margemBrutaPonderada') ?>

    <?php // echo $form->field($model, 'dataUltimaRenovacao') ?>

    <?php // echo $form->field($model, 'vencimento') ?>

    <?php // echo $form->field($model, 'reajustePonderado') ?>

    <?php // echo $form->field($model, 'margemBrutaPonderadaRenovacao') ?>

    <?php // echo $form->field($model, 'totalReceitaLiquidaRenovacao') ?>

    <?php // echo $form->field($model, 'condicaoPagamento') ?>

    <?php // echo $form->field($model, 'minimo') ?>

    <?php // echo $form->field($model, 'numeroLeitos') ?>

    <?php // echo $form->field($model, 'tabela') ?>

    <?php // echo $form->field($model, 'icms') ?>

    <?php // echo $form->field($model, 'enquadramento') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
