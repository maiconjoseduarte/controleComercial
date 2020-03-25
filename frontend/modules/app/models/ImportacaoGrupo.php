<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use common\models\Grupo;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportacaoGrupo extends Importacao
{
    public $nome = 'Grupo';
    /**
     * Processa o arquivo de grupos
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
            $transaction = Grupo::getDb()->beginTransaction();
            try {

                $codigo = $this->getNumber($sheet, "A{$row->getRowIndex()}");
                $nome = $this->getString($sheet, "B{$row->getRowIndex()}");
                $status = $this->getNumber($sheet, "C{$row->getRowIndex()}");
                $idGestor = $this->getNumber($sheet, "D{$row->getRowIndex()}");
                $idSuporte = $this->getNumber($sheet, "E{$row->getRowIndex()}");

                $grupo = new Grupo();

                $grupo->id =$codigo;
                $grupo->nome = $nome;
                $grupo->status = $status;
                $grupo->idGestor = ($idGestor === 0) ? null : $idGestor;
                $grupo->idSuporte = ($idSuporte === 0) ? null : $idSuporte;

                if ($grupo->save() === false) {
                    throw new FeedbackException(sprintf('%s<br>%s', 'Erro ao salvar o grupo.', implode('<br>', $grupo->getFirstErrors())));
                }

                $this->processamentosSucesso[] = [
                    'linha' => $row->getRowIndex(),
                    'mensagem' => "Grupo {$grupo->nome} cadastrado com sucesso."
                ];

                $transaction->commit();
            } catch (\Exception $e) {
                $mensagem = "Erro ao importar o grupo.";
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
