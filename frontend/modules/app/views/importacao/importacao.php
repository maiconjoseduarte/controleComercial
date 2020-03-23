<?php

use common\components\Layout;
use common\models\Grupo;
use frontend\modules\app\models\Importacao;
use common\components\Icones;
use frontend\modules\app\models\ImportacaoContrato;
use frontend\modules\app\models\ImportacaoFilial;
use frontend\modules\app\models\ImportacaoJuridico;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $importacao Importacao */

$this->title = 'Importação '. $importacao->nome ?? null;
?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <?= $this->title; ?>
                </div>

                <ul class="nav">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
            <div class="card-body">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'autocomplete' => 'off']]); ?>

        <div class="row">
            <?php
                if (
                        $importacao instanceof ImportacaoFilial ||
                        $importacao instanceof ImportacaoContrato ||
                        $importacao instanceof ImportacaoJuridico
                ):
            ?>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($importacao, 'idGrupo')->widget(\kartik\select2\Select2::className(), [
                    'data' => Grupo::select2Data(),
                    'options' => ['placeholder' => 'Selecione um grupo ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <?php
                endif;
            ?>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($importacao, 'formatacaoTexto')->dropDownList([
                    Importacao::IMPORTACAO_TEXTO_FORMATACAO_ORIGINAL => 'Original',
                    Importacao::IMPORTACAO_TEXTO_FORMATACAO_PRIMEIRA_LETRA_MAIUSCULA => 'Primeira letra maiúscula'
                ]); ?>
            </div>
            <div class="sm-12 col-md-6 col-lg-6">
                <?= $form->field($importacao, 'arquivo')->widget(FileInput::classname(), [
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showUpload' => false,
                        'showRemove' => true,
                        'browseLabel' => 'Selecionar ...',
                        'browseIcon' => Html::tag('i', null, ['class' => Icones::FILE]),
                        'removeLabel' => '',
                    ],
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($importacao, 'continuarProcessamento')->checkbox(['label' => 'Não interromper importação com erros.']); ?>
            </div>
            <?php if (property_exists($importacao, 'somarSaldoInicial')): ?>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($importacao, 'somarSaldoInicial')->checkbox(['label' => 'Somar valores no saldo inicial.']); ?>
            </div>
            <?php endif; ?>
        </div>

        <?= Html::submitButton('Processar', ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<?php

if (Yii::$app->request->isPost) {
    echo $this->render('resultado',
        [
            'processamentosSucesso' => count($importacao->processamentosSucesso),
            'processamentosErro' => count($importacao->processamentosErro)
        ]
    );
    echo $this->render('grid-erros',
        [
            'processamentos' => $importacao->processamentosErro,
            'titulo' => 'Processamentos com erro.',
            'estiloBox' => 'box-danger'
        ]
    );

    if (property_exists($importacao, 'processamentosSucesso') && empty($importacao->processamentosSucesso) === false) {
        echo $this->render('grid-erros',
            [
                'processamentos' => $importacao->processamentosSucesso,
                'titulo' => 'Processamentos com sucesso.',
                'estiloBox' => 'box-success'
            ]
        );
    }

    if (property_exists($importacao, 'processamentosIgnorado')) {
        echo $this->render('grid-erros',
            [
                'processamentos' => $importacao->processamentosIgnorado,
                'titulo' => 'Processamentos ignorados.',
                'estiloBox' => 'box-warning'
            ]
        );
    }
}
