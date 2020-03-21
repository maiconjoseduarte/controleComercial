<?php

use common\components\Layout;
use common\models\Colaborador;
use frontend\modules\app\models\ColaboradorSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\app\models\ColaboradorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaborador-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'nome') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'cargo')->dropDownList(Colaborador::$OPCOES_CARGO, ['prompt' => '']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'pageSize')->dropDownList(ColaboradorSearch::$OPCOES_PAGINACAO) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Filtrar', ['class' => Layout::BTN_FILTER]) ?>
        <?= Html::resetButton('Limpar', ['class' => Layout::BTN_LIMPAR]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
