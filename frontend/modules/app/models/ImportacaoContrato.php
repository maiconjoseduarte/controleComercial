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

                $idGrupo = $this->getString($sheet, "A{$row->getRowIndex()}");
                $dataInicio = \DateTime::createFromFormat('!d/m/Y', $this->getString($sheet, "B{$row->getRowIndex()}"));
                $totalReceitaLiquidaInicio = $this->getFloat($sheet, "C{$row->getRowIndex()}");
                $margemBrutaPonderada = $this->getFloat($sheet, "D{$row->getRowIndex()}");
                $dataUltimaRenovacao = \DateTime::createFromFormat('!d/m/Y', $this->getString($sheet, "E{$row->getRowIndex()}"));
                $vencimento = \DateTime::createFromFormat('!d/m/Y', $this->getString($sheet, "F{$row->getRowIndex()}"));
                $reajustePonderado = $this->getFloat($sheet, "G{$row->getRowIndex()}");
                $margemBrutaPonderadaRenovacao = $this->getFloat($sheet, "H{$row->getRowIndex()}");
                $totalReceitaLiquidaRenovacao = $this->getFloat($sheet, "I{$row->getRowIndex()}");
                $condicaoPagamento = $this->getString($sheet, "J{$row->getRowIndex()}");
                $minimo = $this->getFloat($sheet, "K{$row->getRowIndex()}");
                $numeroLeitos = $this->getNumber($sheet, "L{$row->getRowIndex()}");
                $tabela = $this->getString($sheet, "M{$row->getRowIndex()}");
                $icms = $this->getFloat($sheet, "N{$row->getRowIndex()}");
                $enquadramento = $this->getFloat($sheet, "O{$row->getRowIndex()}");
//                if (is_float($enquadramento) === false || $enquadramento <= 0) {
//                    throw new FeedbackException("O valor {} deve ser válido e maior que 0.");
//                }

                $contrato = new Contrato();

                $contrato->idGrupo = $idGrupo;
                $contrato->dataInicio = $dataInicio->format('Y-m-d');
                $contrato->totalReceitaLiquidaInicio = $totalReceitaLiquidaInicio;
                $contrato->margemBrutaPonderada = $margemBrutaPonderada;
                $contrato->dataUltimaRenovacao = $dataUltimaRenovacao->format('Y-m-d');
                $contrato->vencimento = $vencimento->format('Y-m-d');
                $contrato->reajustePonderado = $reajustePonderado;
                $contrato->margemBrutaPonderadaRenovacao = $margemBrutaPonderadaRenovacao;
                $contrato->totalReceitaLiquidaRenovacao = $totalReceitaLiquidaRenovacao;
                $contrato->condicaoPagamento = $condicaoPagamento;
                $contrato->minimo = $minimo;
                $contrato->numeroLeitos = $numeroLeitos;
                $contrato->tabela = $tabela;
                $contrato->icms = $icms;
                $contrato->enquadramento =$enquadramento;

                if ($contrato->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar o contrato.', implode('<br>', $contrato->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Contrato {$contrato->id} cadastrado com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar o contrato.";
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
