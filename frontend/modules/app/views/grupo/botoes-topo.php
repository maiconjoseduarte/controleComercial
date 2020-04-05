<?php

use common\components\Layout;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $idGrupo string */

$link = $_GET['r'] ?? null;
?>
<div class="row">
    <div class="col-md-2">
        <?= Html::a('Informações Gerais', Url::to(['grupo/view', 'id' => $idGrupo]), [
            'id' => 'info-gerais',
            'class' => Layout::BTN_OPCOES_GRUPO . (strstr($link,'grupo/view') ? ' active-info' : '')
        ])?>
    </div>
    <div class="col-md-2">

        <?= Html::button('Informações Jurídico', [
            'id' => 'info-juridico',
            'class' => Layout::BTN_OPCOES_GRUPO
        ])?>
    </div>
    <div class="col-md-2">
        <?= Html::a('Filiais', Url::to(['filial/index', 'idGrupo' => $idGrupo]), [
            'id' => 'filiais',
            'class' => Layout::BTN_OPCOES_GRUPO . (strstr($link,'filial/') ? ' active-info' : '')
        ])?>
    </div>
    <div class="col-md-2">
        <?= Html::a('Itens Contrato', Url::to(['itens-contrato/index', 'idGrupo' => $idGrupo]), [
            'id' => 'itens-contrato',
            'class' => Layout::BTN_OPCOES_GRUPO . (strstr($link,'itens-contrato/') ? ' active-info' : '')
        ])?>
    </div>
</div>
