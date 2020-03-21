<?php

use common\components\Icones;
use common\components\Layout;
use common\models\Colaborador;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\app\models\ColaboradorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colaboradores';
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
                        <?= Html::a('<i class="'. Icones::ADD .'"></i> '. Layout::BTN_ADD_LABEL, ['create'], ['class' => Layout::BTN_NOVO]) ?>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'panel' => [
                        'type' => GridView::TYPE_DEFAULT,
                        'heading' => false
                    ],
                    'toolbar' => [
                        '<div class="pull-right">{export}</div>',
                    ],
                    'columns' => [
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'headerOptions' => ['style' => 'width: 20px;'],
                            'buttons' => [
                                'view' => function ($url) {
                                    $icon = Html::tag('i', null, ['class' => Icones::VIEW]);
                                    $span = Html::tag('span', $icon, ['class' => Layout::BADGE_LIGHT]);
                                    $html = Html::a($span, $url);

                                    return $html;
                                },
                                'update' => function ($url) {

                                    $icon = Html::tag('i', null, ['class' => Icones::EDIT]);
                                    $span = Html::tag('span', $icon, ['class' => Layout::BADGE_WARNING]);
                                    $html = Html::a($span, $url);

                                    return $html;
                                },
                                'delete' => function ($url) {

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
                        'id',
                        'nome',
                        [
                            'attribute' => 'cargo',
                            'value' => function (Colaborador $model) {
                                return Colaborador::$OPCOES_CARGO[$model->cargo] ?? null;
                            }
                        ]
                    ],
                    'export' => [
                        'header' => html_entity_decode('<li role="presentation" class="dropdown-header">Opções:</li>'),
                        'label' => 'Download',
                        'showConfirmAlert' => false,
                        'fontAwesome' => false,
                        'target' => GridView::TARGET_BLANK,
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
