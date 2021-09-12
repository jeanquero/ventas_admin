<?php
require __DIR__. '/../../vendor/autoload.php';
require_once __DIR__ . "/../repository/company.php";
require_once __DIR__ . "/../repository/person.php";
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
    private $dataPerson;
    private $person;
    private $fila;
    /**
     * @var Monolog
     */
    private $log;
    private $format;
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet =  $this->spreadsheet->getActiveSheet();
        $this->time = new DateTime();
        $this->company = new Company();
        $this->person = new Person();
        $this->table = $this->company->getCompany();
        $this->dataPerson = $this->person->getPerson(null,null);
        $this->format = $this->time->format('YmdHis').".xlsx";
        $this->fila = 2;
        $this->log = new Monolog();
    }

    /**
     *
     * Método para exportar un archivo excel de
     * empresas.
     *
     * @author <Jose>
     * @acces public
     */
    public function exportCompany(){
        $this->sheet->setTitle("Empresas");
        $header = ["Empresa", "RUC/Equivalente", "Dirección", "Pais", "Rubro","Contacto Contable","Participantes","Estado","Nombre del Registrador"];
        $this->header($header);
        foreach ($this->table as $value){
            $estado = $value['payment'] == 0 ? 'Incompleto' : 'Completo';
            $this->sheet->setCellValueByColumnAndRow(1,$this->fila,$value['name_company'])->getColumnDimension('A')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(2,$this->fila,$value['document_number'])->getColumnDimension('B')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(3,$this->fila,$value['address'])->getColumnDimension('C')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(4,$this->fila, $value['country'])->getColumnDimension('D')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(5,$this->fila,$value['activity'])->getColumnDimension('E')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(6,$this->fila,$value['billing'])->getColumnDimension('F')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(7,$this->fila, $value['workers'])->getColumnDimension('G')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(8,$this->fila,$estado)->getColumnDimension('H')->setAutoSize(true);
            $this->sheet->setCellValueByColumnAndRow(9,$this->fila,$value['nombre_representante'])->getColumnDimension('I')->setAutoSize(true);
            $this->fila++;
        }

        header('Content-Disposition: attachment;filename='.'empresas'.$this->format.'');
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

    /**
     *
     * Método para exportar un archivo excel de
     * personas.
     *
     * @author <Jose>
     * @acces public
     */
    public function exportPerson(){
        $this->sheet->setTitle("Personas");
        $header = ["Nombres", "Apellidos", "Doc. Identidad", "Correo", "Celular","Ciudad","Cargo","Invitado","Empresa"];
        $this->header($header);
        foreach ($this->dataPerson as $value){
            $this->sheet->setCellValueByColumnAndRow(1,$this->fila,$value['name'])->getColumnDimension('A')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(2,$this->fila,$value['last_name'])->getColumnDimension('B')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(3,$this->fila,$value['document_number'])->getColumnDimension('C')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(4,$this->fila, $value['email'])->getColumnDimension('D')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(5,$this->fila,$value['phone_number'])->getColumnDimension('E')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(6,$this->fila,$value['city'])->getColumnDimension('F')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(7,$this->fila, $value['position'])->getColumnDimension('G')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(9,$this->fila,$value['guest'])->getColumnDimension('H')->getAutoSize();
            $this->sheet->setCellValueByColumnAndRow(10,$this->fila,$value['company_name'])->getColumnDimension('H')->getAutoSize();
            $this->fila++;
        }
        header('Content-Disposition: attachment;filename='.'personas'.$this->format.'');
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

    public function header(array $header){
        $this->sheet->fromArray($header);
    }

}
