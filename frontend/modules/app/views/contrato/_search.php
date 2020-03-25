<?php

use common\components\Layout;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\app\models\ContratoSearch */
/* @var $form yii\widgets\ActiveForm */

$data = \common\models\Grupo::select2Data();
?>

<div class="contrato-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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
    </div>

    <div class="form-group">
        <?= Html::submitButton(Layout::BTN_FILTER_LABEL, ['class' => Layout::BTN_FILTER]) ?>
        <?= Html::resetButton(Layout::BTN_LIMPAR_LABEL, ['class' => Layout::BTN_LIMPAR]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
