<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use common\models\Filial;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportacaoFilial extends Importacao
{
    public $nome = 'Filiais';
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
            $transaction = Filial::getDb()->beginTransaction();
            try {

                $filial = new Filial();

                $filial->id = $this->getString($sheet, "A{$row->getRowIndex()}");
                $filial->nome = $this->getString($sheet, "B{$row->getRowIndex()}");
                $filial->idGrupo = $this->getString($sheet, "c{$row->getRowIndex()}");
                $filial->codIsoWeb = $this->getString($sheet, "D{$row->getRowIndex()}");
                $filial->documento = $this->getString($sheet, "E{$row->getRowIndex()}");
                $filial->uf = $this->getString($sheet, "F{$row->getRowIndex()}");
                $filial->nomeCidade = $this->getString($sheet, "G{$row->getRowIndex()}");
                $filial->especialidade = $this->getString($sheet, "H{$row->getRowIndex()}");
                $filial->codResponsavel = $this->getString($sheet, "I{$row->getRowIndex()}");
                $filial->codSuporte = $this->getString($sheet, "J{$row->getRowIndex()}");
                $filial->icms = $this->getString($sheet, "K{$row->getRowIndex()}");
                $filial->cdFaturamento = $this->getString($sheet, "L{$row->getRowIndex()}");
                $filial->ledTime = $this->getString($sheet, "M{$row->getRowIndex()}");

                if ($filial->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar a filial.', implode('<br>', $filial->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Filial {$filial->nome} cadastrada com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar a filial.";
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
