<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Grupo */

?>

<h3 class="box-title-grupo">Informações Gerais</h3>
<hr>
<p></p>


<?php
if ($model->contrato == null) {
    return ;
}
?>
    <br><br><br>

    <table class="table">
        <tr>
            <td>Código Corporativo: <?= $model->id ?></td>
            <td>Cliente: <?= $model->nome ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gestor: <?= $model->gestor->nome ?? null ?></td>
            <td>Suporte: <?= $model->suporte->nome ?? null ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Inicío Contrato: <?= Yii::$app->formatter->asDate($model->contrato->dataInicio, 'dd/MM/Y') ?? null ?></td>
            <td>Reinício: <?= Yii::$app->formatter->asDate($model->contrato->dataInicio, 'dd/MM/Y') ?? null ?></td>
            <td>MB Ponderada: <?= $model->contrato->margemBrutaPonderada ?? null ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Data renovação: <?= Yii::$app->formatter->asDate($model->contrato->dataUltimaRenovacao, 'dd/MM/Y') ?? null ?></td>
            <td>Vencimento: <?= Yii::$app->formatter->asDate($model->contrato->vencimento, 'dd/MM/Y') ?? null ?></td>
            <td></td>
            <td></td>
        </tr
        <tr>
            <td>Reajuste ponderado: <?= $model->contrato->reajustePonderado ?? null ?></td>
            <td>MB ponderada de renovação: <?= $model->contrato->margemBrutaPonderadaRenovacao ?? null ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>ICMS: <?= $model->contrato->icms ?? null ?></td>
            <td>Tabela: <?= $model->contrato->tabela ?? null ?></td>
            <td>Enquadramento: <?= $model->contrato->enquadramento ?? null ?></td>
            <td></td>
        </tr>
        <tr>
            <td>CP: <?= $model->contrato->condicaoPagamento ?? null ?></td>
            <td>Mínimo: <?= $model->contrato->minimo ?? null ?></td>
            <td></td>
            <td></td>
        </tr>
    </table>

<?php
