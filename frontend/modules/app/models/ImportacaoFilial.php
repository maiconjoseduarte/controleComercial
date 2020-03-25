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

                $codBPSC = $this->getNumber($sheet, "A{$row->getRowIndex()}");
                $idGrupo = $this->getNumber($sheet, "B{$row->getRowIndex()}");
                $nome = $this->getString($sheet, "C{$row->getRowIndex()}");
                $codIsoWeb = $this->getNumber($sheet, "D{$row->getRowIndex()}");
                $documento = $this->getString($sheet, "E{$row->getRowIndex()}");
                $uf = $this->getString($sheet, "F{$row->getRowIndex()}");
                $nomeCidade = $this->getString($sheet, "G{$row->getRowIndex()}");
                $especialidade = $this->getString($sheet, "J{$row->getRowIndex()}");
                $icms = $this->getFloat($sheet, "K{$row->getRowIndex()}");
                $cdFaturamento = $this->getString($sheet, "L{$row->getRowIndex()}");
                $ledTime = $this->getNumber($sheet, "M{$row->getRowIndex()}");

                $filial = new Filial();

                $filial->id = $codBPSC;
                $filial->idGrupo = $idGrupo;
                $filial->nome = $nome;
                $filial->codIsoWeb = $codIsoWeb;
                $filial->documento = $documento;
                $filial->uf = $uf;
                $filial->nomeCidade = $nomeCidade;
                $filial->especialidade = $especialidade;
                $filial->icms = $icms;
                $filial->cdFaturamento = $cdFaturamento;
                $filial->ledTime = $ledTime;

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
