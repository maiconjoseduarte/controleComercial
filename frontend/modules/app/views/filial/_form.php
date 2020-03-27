<?php

use common\components\Layout;
use common\models\Grupo;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Filial */
/* @var $form yii\widgets\ActiveForm */

$data = Grupo::select2Data();
?>
<div class="card-body">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'idGrupo')->widget(Select2::className(), [
                'data' => $data,
                'options' => ['placeholder' => 'Selecione ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'codIsoWeb')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'id')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'documento')->widget(MaskedInput::className(), [
                'mask' => '99.999.999/9999-99'
            ]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'uf')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'especialidade')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'icms')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'cdFaturamento')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'ledTime')->textInput() ?>
        </div>
    </div>

    <div class="form-group mt-5">
        <?= Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, Url::to(['index']), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
