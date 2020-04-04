<?php

use common\components\Layout;
use common\models\Grupo;
use kartik\datecontrol\DateControl;
use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contrato */
/* @var $form yii\widgets\ActiveForm */
/* @var $disabled bool */

?>
<div class="card-body">
    <?php $form = ActiveForm::begin(['id' => 'form-contratos']); ?>

    <div class="shadow-sm p-3 mb-3 bg-light rounded shadow-style">Informações Gerais</div>

    <div class="row">
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
            <?= $form->field($model, 'totalReceitaLiquidaInicio')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'allowMinus' => false
                ],
            ])?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'margemBrutaPonderada')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'minimo')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'allowMinus' => false
                ],
            ])?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'condicaoPagamento')->textInput() ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'numeroLeitos')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'tabela')->textInput() ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'enquadramento')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'icms')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
    </div>

    <div class="shadow-sm p-3 mb-3 mt-3 bg-light rounded shadow-style">Renovação do contrato</div>

    <div class="row">
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
        <div class="col-md-3">
            <?= $form->field($model, 'totalReceitaLiquidaRenovacao')->widget(NumberControl::className(),[
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'reajustePonderado')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'margemBrutaPonderadaRenovacao')->widget(NumberControl::className(), [
                'maskedInputOptions' => [
                    'suffix' => ' %',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group mt-5">
        <?= ($disabled) ? '' : Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, Url::to(['index']), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerCss(<<<CSS
.shadow-style {
    background-color: #4f69b7 !important;
    color: white; 
    font-weight: bold; 
    font-size: 14px;
}
CSS
);

if ($disabled) {
$this->registerJs(<<<JS
    jQuery(document).ready(function() {
      const element = jQuery("form#form-contratos input").each((index, element) => {
         jQuery(element).attr("disabled", "disabled");
      });
    });
JS
);
}