<?php

use common\components\Layout;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model \common\models\Grupo */
/* @var $filiais \yii\data\ActiveDataProvider */

$ss= $model->filiais;
?>
<h3 class="box-title-grupo">Filiais</h3>
<hr>
<p></p>

<?= GridView::widget([
    'dataProvider' => $filiais,
    'bordered' => false,
    'hover' => true,
    'layout' => Layout::GRID_LAYOUT,
    'columns' => [
        'codIsoWeb',
        'codResponsavel',
        'id',
        'nome',
        'documento',
        'uf',
        'icms',
        'cdFaturamento',
        'ledTime',
    ]
]) ?>