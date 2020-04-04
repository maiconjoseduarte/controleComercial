<?php

use common\components\Icones;
use common\components\Layout;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\app\models\ItensContratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $idGrupo string */

$this->title = 'Itens Contrato';
$this->params['breadcrumbs'][] = $this->title;

$canCreate = Yii::$app->user->can('app/itens-contrato/create');
$canUpdate = Yii::$app->user->can('app/itens-contrato/update');
$canDelete = Yii::$app->user->can('app/itens-contrato/delete');


$create = ($canCreate) ? Html::a('<i class="' . Icones::ADD . '"></i> ' . Layout::BTN_ADD_LABEL, ['create', 'idGrupo' => $idGrupo], ['class' => Layout::BTN_NOVO, 'style' => 'margin-right: 3px;']) : ''

?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-body">
                <?= $this->render('@app/modules/app/views/grupo/botoes-topo', [
                    'idGrupo' => $idGrupo
                ]); ?>
                <hr class="mb-5">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'panel' => [
                        'type' => GridView::TYPE_DEFAULT,
                        'heading' => false
                    ],
                    'toolbar' => [
                        [
                            'content'=>
                                $create
                        ],
                        '<div class="pull-right">{export}</div>',
                    ],
                    'columns' => [
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'header' => '',
                            'headerOptions' => ['style' => 'min-width: 170px;'],
                            'buttons' => [
                                'view' => function ($url) {
                                    $icon = Html::tag('i', null, ['class' => Icones::VIEW]);
                                    $span = Html::tag('span', $icon, ['class' => Layout::BADGE_LIGHT]);
                                    $html = Html::a($span, $url);

                                    return $html;
                                },
                                'update' => function ($url) use ($canUpdate) {
                                    if ($canUpdate === false) {
                                        return '';
                                    }
                                    $icon = Html::tag('i', null, ['class' => Icones::EDIT]);
                                    $span = Html::tag('span', $icon, ['class' => Layout::BADGE_WARNING]);
                                    $html = Html::a($span, $url);

                                    return $html;
                                },
                                'delete' => function ($url) use ($canDelete) {
                                    if ($canDelete === false) {
                                        return '';
                                    }
                                    $icon = Html::tag('i', null, ['class' => Icones::DELETE]);
                                    $span = Html::tag('span', $icon, ['class' => Layout::BADGE_DANGER]);
                                    $html = Html::a($span, $url, [
                                        'data-method' => 'post',
                                        'data-confirm' => "Deseja realmente excluir este item? "
                                    ]);

                                    return $html;
                                },
                            ],
                            'urlCreator' =>  function($action, $model, $key, $index) {
                                if ($action === 'view') {
                                    return Url::to(['view', 'id' => $model->id]);
                                } else if ($action === 'update') {
                                    return Url::to(['update', 'id' => $model->id]);
                                } else if ($action === 'delete') {
                                    return Url::to(['delete', 'id' => $model->id]);
                                }
                            },
                        ],
//                        'id',
                        [
                            'label' => 'Grupo',
                            'attribute' => 'grupo.nome',
                        ],                        'statusItem',
                        'statusHomologacao',
                        'codCliente',
                        'codCremer',
                        'descricao',
                        'unidadeMedida',
//                        'consumoAnual',
//                        'preco',
//                        'valorMedioAnual',
//                        'vigencia',
                        //'observacao',
                        //'create_at',
                        //'update_at',

                    ],
                    'export' => [
                        'header' => html_entity_decode('<li role="presentation" class="dropdown-header">Opções:</li>'),
                        'label' => 'Download',
                        'showConfirmAlert' => false,
                        'fontAwesome' => false,
                        'target' => \kartik\grid\GridView::TARGET_BLANK,
                        'options' => ['title' => 'Download', 'class' => Layout::BTN_EXPORT],
                        'icon' => Icones::EXPORT,
                    ],
                    'exportContainer' => ['class' => 'hidden-xs hidden-sm'],
                    'pjax' => Layout::GRID_PAJAX,
                    'bordered' => Layout::GRID_BORDERED,
                    'hover' => Layout::GRID_HOVER,
                    'striped' => Layout::GRID_STRIPED,
                    'condensed' => Layout::GRID_CONDENSED,
                    'exportConfig' => [
                        GridView::PDF => [
                            'filename' => $this->title,
                            'config' => [
                                'mode' => 'utf-8',
                                'format' => 'A4',
                                'destination' => 'I',
                                'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
                                'defaultFontSize' => 12,
                                'marginBottom' => 20,
                                'marginLeft' => 10,
                                'marginRight' => 10,
                                'cssInline' => '.kv-grid-table, .kv-page-summary{font-size: 10px;}',
                                'methods' => [
                                    'SetHTMLHeader' => '',
                                    'SetFooter' => '{PAGENO}'
                                ],
                                'options' => [
                                    'setAutoTopMargin' => 'stretch',
                                    'title' => $this->title
                                ],
                            ]
                        ],
                        GridView::EXCEL => ['filename' => $this->title],
                        GridView::HTML => ['filename' => $this->title],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
