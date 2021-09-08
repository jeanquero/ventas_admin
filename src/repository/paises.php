<?php
//echo __DIR__."/../../db/conexion.php";
//require_once __DIR__."/../../db/conexion.php";

class Pais {
    private $db;

    function __construct() {
        $this->db = new MysqlDB();
        $this->db->connect();
    }
    public function getData()
    {
        $sql="SELECT * FROM country";
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

