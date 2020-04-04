<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\app\models\ItensContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itens-contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idGrupo') ?>

    <?= $form->field($model, 'statusItem') ?>

    <?= $form->field($model, 'statusHomologacao') ?>

    <?= $form->field($model, 'codCliente') ?>

    <?php // echo $form->field($model, 'codCremer') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'unidadeMedida') ?>

    <?php // echo $form->field($model, 'consumoAnual') ?>

    <?php // echo $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'valorMedioAnual') ?>

    <?php // echo $form->field($model, 'vigencia') ?>

    <?php // echo $form->field($model, 'observacao') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
