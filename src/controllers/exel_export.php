<?php
require __DIR__. '/../../vendor/autoload.php';
require_once __DIR__ . "/../repository/company.php";
require_once __DIR__ . "/../conf/monolog.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelExport {
    private $spreadsheet;
    /**
     * @var Worksheet
     */
    private $sheet;
    private $time;
    private $company;
    private $table;
    /**
     * @var Monolog
     */
    private $log;
    /**
     * @var string
     */
    private $nomArch;
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet =  $this->spreadsheet->getActiveSheet();
        $this->time = new DateTime();
        $this->company = new Company();
        $this->table = $this->company->getCompany();
        $this->nomArch = "empresas".$this->time->format('YmdHis').".xlsx";
        $this->log = new Monolog();
    }

    /**
     *
     */
    public function exportCompany(){
        $this->sheet->setTitle("Empresas");
        $header = ["Empresa", "RUC/Equivalente", "Dirección", "Pais", "Rubro","Contacto Contable","Participantes","Estado","Nombre del Registrador"];
        $this->sheet->fromArray($header);
        $fila = 2;
        foreach ($this->table as $value){
            $estado = $value['payment'] == 0 ? 'Incompleto' : 'Completo';
            $this->sheet->setCellValueByColumnAndRow(1,$fila,$value['name_company']);
            $this->sheet->setCellValueByColumnAndRow(2,$fila,$value['document_number']);
            $this->sheet->setCellValueByColumnAndRow(3,$fila,$value['address']);
            $this->sheet->setCellValueByColumnAndRow(4,$fila, $value['country']);
            $this->sheet->setCellValueByColumnAndRow(5,$fila,$value['activity']);
            $this->sheet->setCellValueByColumnAndRow(6,$fila,$value['billing']);
            $this->sheet->setCellValueByColumnAndRow(7,$fila, $value['workers']);
            $this->sheet->setCellValueByColumnAndRow(8,$fila,$estado);
            $this->sheet->setCellValueByColumnAndRow(9,$fila,$value['nombre_representante']);
            $fila++;
        }
        header('Content-Disposition: attachment;filename='.$this->nomArch.'');
        header('Cache-Control: max-age=0');
        try {
            $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            $this->log->Logger($e->getMessage(), 'error');
            exit;
        }

    }

}
