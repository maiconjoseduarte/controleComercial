<?php

use common\components\Layout;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $idGrupo string */

?>
<div class="row">
    <div class="col-md-2">
        <?= Html::a('Informações Gerais', Url::to(['grupo/view', 'id' => $idGrupo]), [
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
        <?= Html::a('Filiais', Url::to(['filial/index', 'idGrupo' => $idGrupo]), [
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
