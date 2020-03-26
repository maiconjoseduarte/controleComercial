<?php

use common\components\Layout;
use common\models\Grupo;
use kartik\datecontrol\DateControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contrato */
/* @var $form yii\widgets\ActiveForm */

$data = Grupo::select2Data();
?>

<div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'idGrupo')->widget(\kartik\select2\Select2::className(), [
                'data' => $data,
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'dataInicio')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'displayFormat' => 'php: d/M/Y',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'viewMode' => 0,
                        'minViewMode' => 0
                    ]
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'dataUltimaRenovacao')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'displayFormat' => 'php: d/M/Y',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'viewMode' => 0,
                        'minViewMode' => 0
                    ]
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'vencimento')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'displayFormat' => 'php: d/M/Y',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'viewMode' => 0,
                        'minViewMode' => 0
                    ]
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'margemBrutaPonderada')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'integerDigits' => 3,
                    'digits' => 2,
                    'integerOptional' => true,
                    'digitsOptional' => false,
                    'decimalProtect' => false,
                    'autoUnmask' => true,
                    'removeMaskOnSubmit' => true,
                    'unmaskAsNumber' => true,
                    'enforceDigitsOnBlur' => true,
                    'rightAlign' => false,
                    'allowPlus' => false,
                    'allowMinus' => false,
                    'radixPoint' => ',',
                    'groupSeparator' => '.',
                    'autoGroup' => true
                ],
            ]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'totalReceitaLiquidaInicio')->widget(\kartik\money\MaskMoney::className())?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'reajustePonderado')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'integerDigits' => 3,
                    'digits' => 2,
                    'integerOptional' => true,
                    'digitsOptional' => false,
                    'decimalProtect' => false,
                    'autoUnmask' => true,
                    'removeMaskOnSubmit' => true,
                    'unmaskAsNumber' => true,
                    'enforceDigitsOnBlur' => true,
                    'rightAlign' => false,
                    'allowPlus' => false,
                    'allowMinus' => false,
                    'radixPoint' => ',',
                    'groupSeparator' => '.',
                    'autoGroup' => true
                ],
            ])  ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'margemBrutaPonderadaRenovacao')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'integerDigits' => 3,
                    'digits' => 2,
                    'integerOptional' => true,
                    'digitsOptional' => false,
                    'decimalProtect' => false,
                    'autoUnmask' => true,
                    'removeMaskOnSubmit' => true,
                    'unmaskAsNumber' => true,
                    'enforceDigitsOnBlur' => true,
                    'rightAlign' => false,
                    'allowPlus' => false,
                    'allowMinus' => false,
                    'radixPoint' => ',',
                    'groupSeparator' => '.',
                    'autoGroup' => true
                ],
            ])  ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'totalReceitaLiquidaRenovacao')->widget(\kartik\money\MaskMoney::className()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'condicaoPagamento')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'minimo')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'numeroLeitos')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tabela')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'icms')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'integerDigits' => 3,
                    'digits' => 2,
                    'integerOptional' => true,
                    'digitsOptional' => false,
                    'decimalProtect' => false,
                    'autoUnmask' => true,
                    'removeMaskOnSubmit' => true,
                    'unmaskAsNumber' => true,
                    'enforceDigitsOnBlur' => true,
                    'rightAlign' => false,
                    'allowPlus' => false,
                    'allowMinus' => false,
                    'radixPoint' => ',',
                    'groupSeparator' => '.',
                    'autoGroup' => true
                ],
            ])  ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'enquadramento')->textInput() ?>
        </div>
    </div>

    <div class="form-group ">
        <?= Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, Url::to(['index']), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
