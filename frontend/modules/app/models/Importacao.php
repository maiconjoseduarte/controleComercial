<?php

namespace frontend\modules\app\models;

use common\exceptions\FeedbackException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\BaseReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use yii\base\Model;
use yii\db\Exception;
use yii\web\UploadedFile;

/**
 * Class Importacao
 *
 * @property UploadedFile $arquivo
 * @property integer $idAdministradora
 * @property integer $idCondominio
 *
 *
 * @package backend\modules\app\models
 */
abstract class Importacao extends Model
{
    const MASCARA_CNPJ = '%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s';
    const MASCARA_CPF = '%s%s%s.%s%s%s.%s%s%s-%s%s';
    const MASCARA_CEP = '%s%s%s%s%s-%s%s%s';

    /** @var UploadedFile */
    public $arquivo;

    /**
     * Continuar se algum erro acontecer no processamento de dados.
     *
     * @var boolean
     */
    public $continuarProcessamento = true;

    /**
     * Armazena a linha e o erro da importação.
     *
     * @var array $processamentosErro
     */
    public $processamentosErro = [];
    public $processamentosSucesso = [];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['arquivo'], 'required'],
            [['continuarProcessamento'], 'default', 'value' => true],
            [['continuarProcessamento'], 'boolean', 'trueValue' => true, 'falseValue' => false],
            [['arquivo'], 'file', 'extensions' => ['xlsx', 'xlsm', 'xltx', 'xltm', 'xls', 'xlt', 'xlm', 'ods', 'ots'], 'maxSize' => 1024*1024*5, 'checkExtensionByMimeType' => false],
        ];
    }

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'arquivo' => 'Arquivo',
            'continuarProcessamento' => 'Não interromper importação com erros.',
        ];
    }

    /**
     * Processar o arquivo de importação
     * .
     * @throws FeedbackException
     */
    public function run()
    {
        try {
            /** Identificar o tipo do arquivo. **/
            $inputFileType = IOFactory::identify($this->arquivo->tempName);

            /**
             * Criar um novo leitor baseado no tipo de arquivo.
             * @var BaseReader $reader
             **/
            $reader = IOFactory::createReader($inputFileType);
            $reader->setReadDataOnly(true);

            /**
             * Carregar os dados em uma classe SpreadSheet iterável.
             * @var Spreadsheet $spreadSheet
             **/
            $spreadSheet = $reader->load($this->arquivo->tempName);

            $this->process($spreadSheet->getActiveSheet());
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            throw new FeedbackException('Erro ao ler o arquivo. ' . $e->getMessage());
        } catch (FeedbackException $e) {
            throw new FeedbackException('Erro ao processar o arquivo. ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new FeedbackException('Erro ao processar o arquivo.');
        }
    }

    /**
     * Função abstrata necessária em todas as importações.
     *
     * @param Worksheet $sheet
     * @throws FeedbackException Exceção da classe filha
     * @throws \yii\db\Exception Exceção da classe filha
     * @return mixed
     */
    protected abstract function process(Worksheet $sheet);

    /**
     * Retorna um valor texto.
     *
     * @param Worksheet $sheet
     * @param string $coordenada
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function getString(Worksheet $sheet, string $coordenada, $default = null)
    {
        $valor = trim($sheet->getCell($coordenada)->getValue());

        return empty($valor) ? $default : $valor;
    }

    /**
     * Busca somente números.
     *
     * @param Worksheet $sheet
     * @param string $coordenada
     * @return null|string|string[]
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function getNumber(Worksheet $sheet, string $coordenada, $default = 0)
    {
        $valor = preg_replace('/[^0-9]/', '', trim($sheet->getCell($coordenada)->getValue()));
        return empty($valor) ? $default : $valor;
    }

    /**
     * Retorna um valor de ponto flutuante.
     *
     * @param Worksheet $sheet
     * @param string $coordenada
     * @return null|string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function getFloat(Worksheet $sheet, string $coordenada)
    {
        return floatval(trim($sheet->getCell($coordenada)->getValue()));
    }

    /**
     * Retorna um object \DateTime ou false caso a conversão falhou.
     *
     * @param Worksheet $sheet
     * @param string $coordenada
     * @param string $format
     * @return bool|\DateTime
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function getDate(Worksheet $sheet, string $coordenada, $format = 'd/m/Y')
    {
        $date = trim($sheet->getCell($coordenada)->getValue());
        $date = \DateTime::createFromFormat($format, $date);

        return $date->format('Y-m-d');
    }

    /**
     * Formatação de valores.
     *
     * @param string $formatacao
     * @param null $valor
     * @return string
     * @throws FeedbackException
     */
    protected function format($valor, string $formatacao)
    {
        try {
            return vsprintf($formatacao, str_split($valor));
        } catch (\Exception $e) {
            throw new FeedbackException("Erro ao formatar o valor <strong>{$valor}</strong> com a máscara <strong>{$formatacao}</strong>.");
        }
    }

    /**
     * Completar uma string com zeros a esquerda.
     *
     * @param $valor
     * @param $tamanho
     * @return string
     */
    protected function padLeftZero($valor, $tamanho)
    {
        return $this->pad($valor, $tamanho, 0);
    }

    /**
     * Aplicar a complementação de valores.
     *
     * @param $valor
     * @param $tamanho
     * @param $complemento
     * @return string
     */
    private function pad($valor, $tamanho, $complemento)
    {
        return str_pad($valor, $tamanho, $complemento);
    }
}
