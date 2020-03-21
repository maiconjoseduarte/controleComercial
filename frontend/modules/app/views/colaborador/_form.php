<?php

use common\components\Layout;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Colaborador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'cargo')->dropDownList(\common\models\Colaborador::$OPCOES_CARGO, ['prompt' => '']) ?>
        </div>
    </div>

    <div class="form-group ">
        <?= Html::submitButton(Layout::BTN_SUBMIT_LABEL, ['class' => Layout::BTN_SUBMIT]) ?>
        <?= Html::a(Layout::BTN_VOLTAR_LABEL, \yii\helpers\Url::to(['index']), ['class' => Layout::BTN_DEFAULT]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
