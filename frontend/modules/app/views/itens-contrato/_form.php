<?php

use common\components\Layout;
use kartik\datecontrol\DateControl;
use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItensContrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-body">
    <?= $this->render('@app/modules/app/views/grupo/botoes-topo', [
        'idGrupo' => $model->idGrupo
    ]); ?>
    <hr class="mb-5">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'statusItem')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'statusHomologacao')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'codCliente')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'codCremer')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'unidadeMedida')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'consumoAnual')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'preco')->widget(NumberControl::className(),[
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'valorMedioAnual')->widget(NumberControl::className(),[
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'allowMinus' => false
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'vigencia')->widget(DateControl::classname(), [
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
        <div class="col-md-9">
            <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="form-group mt-5">
        <?= Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, Url::to(['index', 'idGrupo' => $model->idGrupo]), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
