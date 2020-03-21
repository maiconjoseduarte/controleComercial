<?php

use common\components\Layout;
use common\models\Colaborador;
use frontend\modules\app\models\GrupoSearch;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\app\models\GrupoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaborador-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'nome') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(\common\models\Grupo::$OPCOES_STATUS, ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'idGestor')->widget(Select2::className(), [
                'data' => Colaborador::select2Data(Colaborador::GESTOR),
                'options' => ['placeholder' => 'Selecione ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'idSuporte')->widget(Select2::className(), [
                'data' => Colaborador::select2Data(Colaborador::SUPORTE),
                'options' => ['placeholder' => 'Selecione ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'pageSize')->dropDownList(GrupoSearch::$OPCOES_PAGINACAO) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Layout::BTN_FILTER_LABEL, ['class' => Layout::BTN_FILTER]) ?>
        <?= Html::resetButton(Layout::BTN_LIMPAR_LABEL, ['class' => Layout::BTN_LIMPAR]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
