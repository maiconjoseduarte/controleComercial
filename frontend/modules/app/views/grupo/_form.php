<?php

use common\components\Layout;
use common\models\Colaborador;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'id')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(\common\models\Grupo::$OPCOES_STATUS, ['prompt' => '']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'idGestor')->widget(\kartik\select2\Select2::className(), [
                'data' => Colaborador::select2Data(Colaborador::GESTOR),
                'options' => ['placeholder' => 'Selecione ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'idSuporte')->widget(\kartik\select2\Select2::className(), [
                'data' => Colaborador::select2Data(Colaborador::SUPORTE),
                'options' => ['placeholder' => 'Selecione ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group ">
        <?= Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, Url::to(['index']), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>




