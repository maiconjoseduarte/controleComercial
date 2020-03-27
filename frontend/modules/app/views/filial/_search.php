<?php

use common\components\Layout;
use common\models\Grupo;
use frontend\modules\app\models\FilialSearch;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model FilialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'idGrupo')->widget(Select2::className(), [
                'data' => Grupo::select2Data(),
                'options' => ['placeholder' => 'Selecione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'documento') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'pageSize')->dropDownList(FilialSearch::$OPCOES_PAGINACAO) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Layout::BTN_FILTER_LABEL, ['class' => Layout::BTN_FILTER]) ?>
        <?= Html::resetButton(Layout::BTN_LIMPAR_LABEL, ['class' => Layout::BTN_LIMPAR]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
