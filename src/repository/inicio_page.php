<?php
require_once __DIR__."/../../db/conexion.php";

class Inicio {
    private $db;

    function __construct() {
        $this->db = new MysqlDB();
        $this->db->connect();
    }
    public function getDocumentType()
    {
        $sql="SELECT * FROM document_type";
        $consulta = [];
        try {
            if (isset($this)) {
                $consulta = $this->db->getData($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        return $consulta;
    }

    public function getUser($documentType, $documentNumber)
    {
        $sql = "";
        if($documentType == "4")
           $sql="SELECT * FROM person WHERE id_document_type = '".$documentType."' AND document_number = '".$documentNumber."'";
        else 
           $sql="SELECT * FROM company WHERE id_document_type = '".$documentType."' AND document_number = '".$documentNumber."'";; 

        $consulta = [];
        try {
            if (isset($this)) {
                $consulta = $this->db->getData($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        return $consulta;
    }
}

