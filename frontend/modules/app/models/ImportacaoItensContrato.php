<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use common\models\ItensContrato;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportacaoItensContrato extends Importacao
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
            $transaction = ItensContrato::getDb()->beginTransaction();
            try {

                $idGrupo = $this->idGrupo;
                $statusItem = $this->getString($sheet, "A{$row->getRowIndex()}");
                $statusHomologacao = $this->getString($sheet, "B{$row->getRowIndex()}");
                $codCliente = $this->getNumber($sheet, "C{$row->getRowIndex()}");
                $codCremer = $this->getNumber($sheet, "D{$row->getRowIndex()}");
                $descricao = $this->getString($sheet, "E{$row->getRowIndex()}");
                $unMedida = $this->getString($sheet, "F{$row->getRowIndex()}");
                $consumoAnual = $this->getNumber($sheet, "G{$row->getRowIndex()}");
                $preco = $this->getFloat($sheet, "H{$row->getRowIndex()}");
                $valorAnual = $this->getMoeda($sheet, "I{$row->getRowIndex()}");
                $vigencia = \DateTime::createFromFormat('!d/m/Y', $this->getString($sheet, "J{$row->getRowIndex()}"));
                $obs = $this->getString($sheet, "K{$row->getRowIndex()}");

                $itensContrato = new ItensContrato();

                $itensContrato->idGrupo = $idGrupo;
                $itensContrato->statusItem = $statusItem;
                $itensContrato->statusHomologacao = $statusHomologacao;
                $itensContrato->codCliente = $codCliente;
                $itensContrato->codCremer = $codCremer;
                $itensContrato->descricao = $descricao;
                $itensContrato->unidadeMedida = $unMedida;
                $itensContrato->consumoAnual = $consumoAnual;
                $itensContrato->preco = $preco;
                $itensContrato->valorMedioAnual = $valorAnual;
                $itensContrato->vigencia= $vigencia->format('Y-m-d');
                $itensContrato->observacao = $obs;

                if ($itensContrato->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar o item.', implode('<br>', $itensContrato->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Item do Contrato {$itensContrato->id} cadastrado com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar os itens do contrato.";
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
