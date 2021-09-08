<?php
require __DIR__."/../../db/conexion.php";

class PaymentTddRepository
{
    private $db;
    private $initTransaction;
    private $commitDB;
    private $rollBack;

    public function __construct()
    {
        $this->db = new MysqlDB();
        $this->db->connect();
    }

    public function initTransaction() {
       // mysqli_begin_transaction($this->db->getConnect());
    }

    public function commitDB() {
      //  mysqli_commit($this->db->getConnect());
    }

    public function rollBack() {
       // mysqli_rollback($this->db->getConnect());
    }

    public function postCreatePaymentTdd($sql)
    {
        try {
            $this->db->executeInstruction($sql);
            return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!", "sql"=>$sql];
        } catch (Exception $e) {
            return ["error" => "true", "message"=>$e->getMessage(),'sql'=>$sql];
        }
    }

    public function postCreatePersonStudent($person_nombres,$person_apellidos,$person_email,$person_dni,$person_celular,$person_city,$person_total,$documentType){
        $sql="INSERT INTO person (name,last_name,email,document_number,phone_number,city,total, id_document_type) VALUES('$person_nombres','$person_apellidos','$person_email','$person_dni','$person_celular','$person_city','$person_total','$documentType')";
        try {
            $this->db->executeInstruction($sql);
            return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!"];
        }catch (Exception $e){
            return ["error" => "true", "message"=>"$sql"];
        }
    }

    public function getPaymentTdd($num_transaction){
        $sql="SELECT * FROM payment_tdd WHERE num_transaction = ".$num_transaction;
        try {
            $this->db->getData($sql);
            return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!"];
        }catch (Exception $e){
            return ["error" => "true", "message"=>"$sql"];
        }
    }

    public function updatePaymentTdd($num_transaction, $person_id){
        $sql="UPDATE payment_tdd SET person_id= ".$person_id. "  WHERE num_transaction = ".$num_transaction;

        try {
            $this->db->getData($sql);
            return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!"];
        }catch (Exception $e){
            return ["error" => "true", "message"=>"$sql"];
        }
    }

    public function updatePaymentTddCompany($num_transaction, $company_id){
        $sql="UPDATE payment_tdd SET company_id= ".$company_id. "  WHERE num_transaction = ".$num_transaction;

        try {
            $this->db->getData($sql);
            return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!"];
        }catch (Exception $e){
            return ["error" => "true", "message"=>"$sql"];
        }
    }

    public function getPersonCorreo($email) {
        $sql="SELECT * FROM person where email ='$email'";
        $consulta = [];
        try {
            if (isset($this)) {
                $consulta = $this->db->getDataSingle($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        return $consulta;
    }



}
