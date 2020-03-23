<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportacaoJuridico extends Importacao
{
    public $nome = 'Jurídico';
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
            $transaction = Juridico::getDb()->beginTransaction();
            try {

                $juridico = new Juridico();

                $juridico->idGrupo = $this->idGrupo;
                $juridico->status = $this->getString($sheet, "B{$row->getRowIndex()}");
                $juridico->dataInicio = $this->getString($sheet, "C{$row->getRowIndex()}");
                $juridico->dataUltimaRenovacao = $this->getString($sheet, "D{$row->getRowIndex()}");
                $juridico->vencimento = $this->getString($sheet, "E{$row->getRowIndex()}");
                $juridico->multa = $this->getString($sheet, "F{$row->getRowIndex()}");
                $juridico->juros = $this->getString($sheet, "G{$row->getRowIndex()}");
                $juridico->minutaAditivo = $this->getString($sheet, "H{$row->getRowIndex()}");
                $juridico->statusAtual = $this->getString($sheet, "I{$row->getRowIndex()}");
                $juridico->comentario = $this->getString($sheet, "J{$row->getRowIndex()}");
                $juridico->email = $this->getString($sheet, "L{$row->getRowIndex()}");
                $juridico->telefone = $this->getString($sheet, "M{$row->getRowIndex()}");

                if ($juridico->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar o juridico.', implode('<br>', $juridico->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Juridico {$juridico->nome} cadastrado com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar o juridico.";
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
