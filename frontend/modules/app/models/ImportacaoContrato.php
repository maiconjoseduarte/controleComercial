<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use common\models\Contrato;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportacaoContrato extends Importacao
{
    public $nome = 'Contrato';
    /**
     * Processa o arquivo de filiais
     *
     * @param Worksheet $sheet
     * @return mixed|void
     * @throws FeedbackException
     */
    public function process(Worksheet $sheet)
    {
        foreach ($sheet->getRowIterator() as $row) {
            //Ignorar cabeçalho
            if ($row->getRowIndex() === 1) {
                continue;
            }
            $transaction = Contrato::getDb()->beginTransaction();
            try {

                $contrato = new Contrato();

                $contrato->idGrupo = $this->getString($sheet, "A{$row->getRowIndex()}");
                $contrato->dataInicio = $this->getDate($sheet, "B{$row->getRowIndex()}");
                $contrato->totalReceitaLiquidaInicio = $this->getString($sheet, "C{$row->getRowIndex()}");
                $contrato->margemBrutaPonderada = $this->getString($sheet, "D{$row->getRowIndex()}");
                $contrato->dataUltimaRenovacao = $this->getDate($sheet, "E{$row->getRowIndex()}");
                $contrato->vencimento = $this->getDate($sheet, "F{$row->getRowIndex()}");
                $contrato->reajustePonderado = $this->getString($sheet, "G{$row->getRowIndex()}");
                $contrato->margemBrutaPonderadaRenovacao = $this->getString($sheet, "H{$row->getRowIndex()}");
                $contrato->totalReceitaLiquidaRenovacao = $this->getString($sheet, "I{$row->getRowIndex()}");
                $contrato->condicaoPagamento = $this->getString($sheet, "J{$row->getRowIndex()}");
                $contrato->minimo = $this->getString($sheet, "K{$row->getRowIndex()}");
                $contrato->numeroLeitos = $this->getString($sheet, "L{$row->getRowIndex()}");
                $contrato->tabela = $this->getString($sheet, "M{$row->getRowIndex()}");
                $contrato->icms = $this->getString($sheet, "N{$row->getRowIndex()}");
                $contrato->enquadramento = $this->getString($sheet, "O{$row->getRowIndex()}");

                if ($contrato->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar o contrato.', implode('<br>', $contrato->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Contrato {$contrato->id} cadastrado com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar a filia.";
                if ($e instanceof FeedbackException) {
                    $mensagem = $e->getMessage();
                }

                $transaction->rollBack();
                if ($this->continuarProcessamento) {
                    $this->processamentosErro[] = [
                        'linha' => $row->getRowIndex(),
                        'mensagem' => $mensagem
                    ];
                    continue;
                } else {
                    throw new FeedbackException($mensagem);
                }
            }
        }
    }
}
