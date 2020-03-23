<?php

use common\components\Icones;
use common\components\Layout;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/* @var array|null $processamentos */
/* @var string $titulo */
/* @var string $estiloBox */

if (count($processamentos) == 0) {
    return null;
}
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
                <?= GridView::widget([
                    'dataProvider' => new ArrayDataProvider([
                        'allModels' => $processamentos,
                        'pagination' => [
                            'pageSize' => false,
                        ],
                    ]),
                    'layout' => '{items}',
                    'toolbar' => null,
                    'hover' => Layout::GRID_HOVER,
                    'striped' => Layout::GRID_STRIPED,
                    'columns' => [
                        [
                            'label' => 'Linha do arquivo',
                            'format' => 'raw',
                            'attribute' => 'linha'
                        ],
                        [
                            'label' => 'Mensagem',
                            'format' => 'raw',
                            'attribute' => 'mensagem'
                        ]
                    ],
                    'pjax' => Layout::GRID_PAJAX,
                    'responsive' => Layout::GRID_RESPONSIVE,
                    'responsiveWrap' => Layout::GRID_RESPONSIVE_WRAP,
                    'bordered' => Layout::GRID_BORDERED,
                    'condensed' => Layout::GRID_CONDENSED
                ]); ?>
            </div>
        </div>
    </div>
</div>
