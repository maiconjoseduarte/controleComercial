<?php

use common\components\Layout;
use kartik\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Grupo */
/* @var $itensContrato \common\models\ItensContrato */

?>
<h3 class="box-title-grupo">Itens de Contrato</h3>
<hr>
<p></p>

<?= GridView::widget([
    'dataProvider' => $itensContrato,
    'bordered' => false,
    'hover' => true,
    'layout' => Layout::GRID_LAYOUT,
    'columns' => [
        'statusItem',
        'statusHomologacao',
        'codCliente',
        'codCremer',
        'descricao',
        'unidadeMedida',
        'consumoAnual',
        'preco',
        'valorMedioAnual',
        'vigencia' ,
        [
            'attribute' => 'observacao',
            'value' => function (\common\models\ItensContrato $model) {
                return $model->observacao ?? '';
            }
        ],
    ]
]) ?>