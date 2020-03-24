<?php

use common\components\Layout;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Grupo */
/* @var $filiais \yii\data\ActiveDataProvider */


$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                <div class="row">
                    <div class="col-md-2">
                        <?= Html::button('Informações Gerais', [
                            'id' => 'info-gerais',
                            'class' => Layout::BTN_OPCOES_GRUPO .' active-info'
                        ])?>
                    </div>
                    <div class="col-md-2">

                        <?= Html::button('Informações Jurídico', [
                            'id' => 'info-juridico',
                            'class' => Layout::BTN_OPCOES_GRUPO
                        ])?>
                    </div>
                    <div class="col-md-2">
                        <?= Html::button('Filiais', [
                            'id' => 'filiais',
                            'class' => Layout::BTN_OPCOES_GRUPO
                        ])?>
                    </div>
                    <div class="col-md-2">
                        <?= Html::button('Itens Contrato', [
                            'id' => 'itens-contrato',
                            'class' => Layout::BTN_OPCOES_GRUPO
                        ])?>
                    </div>
                </div>

                <br><br>

                <div class="row">
                    <div class="col-md-12 col-xs-12" id="conteudo" >

                        <div class="collapse show info-grupo" id="conteudoinfo-gerais">
                            <div class="card card-block">
                                <?= $this->render('_info', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        </div>

                        <div class="collapse info-grupo" id="conteudoinfo-juridico">
                            <div class="card card-block">
                                <?php $this->render('_info-juridico', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        </div>

                        <div class="collapse info-grupo" id="conteudofiliais">
                            <div class="card card-block">
                                <?= $this->render('_info-filiais', [
                                    'model' => $model,
                                    'filiais' => $filiais
                                ]) ?>
                            </div>
                        </div>

                        <div class="collapse info-grupo" id="conteudoitens-contrato">
                            <div class="card card-block">
                                <?= $this->render('_info-itens-contrato', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
    $(document).ready(function(){
    
        $(".btn").click(function() {
            $(".info-grupo").slideUp(500);
    
             $(".btn").removeClass("active-info");
            $("#"+$(this).attr('id')).addClass("active-info");
    
            $("#conteudo"+$(this).attr('id')).slideDown(500);
        });
    });
	
JS
);

$this->registerCss(<<<CSS
.active-info {
    font-weight: bold;
    color: #0ba360;
}

.btn-opcoes-grupo {
    margin-top: 5px;
    width: 99%;
}
CSS
);