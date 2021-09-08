<?php
require __DIR__."/../../db/conexion.php";
require __DIR__."/../dto/PersonDTO.php";
class Person {

    private $db;

    function __construct() {
        $this->db = new MysqlDB();
        $this->db->connect();
    }


    public function getDocumentType()
    {
        $sql="SELECT * FROM person ORDER BY id";
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


    public function getPersonId($id) {
        $sql="SELECT * FROM person where id ='$id'";
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

    public function getPersonDocumentNumber($document_number, $email) {
        $sql="SELECT * FROM person where document_number ='$document_number' or email = '$email'";
        //echo $sql. "---";
        $consulta = array();
        try {
            if (isset($this)) {
                $consulta = $this->db->getDataSingle($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        if($consulta){
            return $consulta;
        }
        return [];

    }

    public function postCreatePerson(PersonDTO $person) {
        //INSERT INTO `person` (`id`, `name`, `last_name`, `email`, `document_number`, `phone_number`, `id_document_type`,
        // `position`, `column_9`, `company_name`, `id_person_type`, `total`)
        // VALUES (NULL, 'ASD', 'ASD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        
        $name=$person->getName();
        $last_name=$person->getLastName();
        $email = $person->getEmail();
        $document = $person->getDocumentNumber();
        $phone = $person->getPhoneNumer();
        $city = $person->getCity();
        $total = $person->getTotal();
        $documentType = $person->getIdDocumentType();
        $position = $person->getPosition();
        $id_person_type = $person->getIdPersonType();
        $company_name = $person->getCompanyName();
        $invitado = $person->getInvitado();
        $findPerson = $this->getPersonDocumentNumber($document, $email);
        if(count($findPerson) == 0){
            $sql="INSERT INTO person (name,last_name,email,document_number,phone_number,city,total, id_document_type, position,id_person_type,company_name,guest) 
                        VALUES('$name','$last_name','$email','$document','$phone','$city','$total','$documentType','$position','$id_person_type','$company_name','$invitado')";
            
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro el estudiante exitosamente!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>$sql];
            }
        }else{
            return ["error" => "true", "message"=>"Error ya se encuentra registrado el Correo o Dni."];
        }

    }

    public function postCreatePayment(string $sql) {
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
