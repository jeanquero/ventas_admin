<?php
//require_once __DIR__ ."/../db/conexion.php";
//require __DIR__."/../dto/PersonDTO.php";
require_once __DIR__ ."/../db/conexion.php";

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

    public function getPersonDocument($document_number) {
        $sql="SELECT * FROM person where document_number ='$document_number'";
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

    public function getPersonEmail($email) {
        $sql="SELECT * FROM person where  email = '$email'";
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
        $centro = $person->getCentro();
        $codigo_estudiante = $person->getCodigoEstudiante();
        $findPerson = $this->getPersonDocumentNumber($document, $email);
       // echo json_encode($findPerson );
        if(count($findPerson) == 0){
            $sql="INSERT INTO person (name,last_name,email,document_number,phone_number,city,total, id_document_type, position,id_person_type,company_name,guest,centro, codigo_estudiante) 
                        VALUES('$name','$last_name','$email','$document','$phone','$city','$total','$documentType','$position','$id_person_type','$company_name','$invitado', '$centro', '$codigo_estudiante')";
            
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro exitoso!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>"error registrando persona", "sql"=> $sql];
            }
        }else{
            return ["error" => "true", "message"=>"Error ya se encuentra registrado el Correo o Dni."];
        }

    }

    public function postCreateRel(PersonDTO $person,$id_company) {
        //INSERT INTO `person` (`id`, `name`, `last_name`, `email`, `document_number`, `phone_number`, `id_document_type`,
        // `position`, `column_9`, `company_name`, `id_person_type`, `total`)
        // VALUES (NULL, 'ASD', 'ASD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        
        $email = $person->getEmail();
        $document = $person->getDocumentNumber();
       
        $findPerson = $this->getPersonDocumentNumber($document, $email);
      
        if(count($findPerson) > 0){
          //  echo json_encode($findPerson );
            $sql=" INSERT INTO company_person_rel (id_company, id_person) VALUES (".$id_company.", ".$findPerson["id"].")";
          //  echo json_encode($sql);
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro exitoso!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>"error registrando persona", "sql"=> $sql];
            }
        }else{
            return ["error" => "true", "message"=>"Error ya se encuentra registrado el Correo o Dni."];
        }

    }



    public function postUpdatePerson(PersonDTO $person, $id, $old_document, $old_email ) {
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
        $centro = $person->getCentro();
        $codigo_estudiante = $person->getCodigoEstudiante();
        $canUpdate = true;
        
        if($old_document !=$document) {
            $findPerson = [];
            $findPerson = $this->getPersonDocument($document);
            if(count($findPerson) > 0){
                $canUpdate = false;
            }
        } 

        if($canUpdate && $old_email != $email) {
            $findPerson = [];
            $findPerson = $this->getPersonEmail($email);
            if(count($findPerson) > 0){
                $canUpdate = false;
            }
            
        }
        
        if($canUpdate){
            $sql = "UPDATE person t SET t.last_name = '$last_name', t.email = '$email', 
            t.name ='$name', t.document_number= '$document', t.phone_number='$phone', t.city='$city',
             t.position='$position', t.company_name ='$company_name',t.guest='$invitado', t.centro='$centro',
              t.codigo_estudiante = '$codigo_estudiante' WHERE t.id = '$id'";

//echo json_encode($sql);
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro exitoso!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>"error registrando persona", "sql"=> $sql];
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

    public function getPerson($id, $person_type) {
        $sql="";
        if($id == null) {
            $sql="SELECT p.name,p.last_name,p.document_number,p.email,p.phone_number,p.city, p.position,p.guest, p.company_name, p.id FROM person p where p.id_person_type = 2 OR p.id_person_type = 3";
        }
        else {
            $sql="SELECT p.name,p.last_name,p.document_number,p.email,p.phone_number,p.city, p.position,p.guest, p.company_name, p.id FROM person p, company_person_rel rel where rel.id_company ='$id' and rel.id_person = p.id  and p.id_person_type = ".$person_type;

        }
        
        //echo $sql. "---";
        $consulta = array();
        try {
            if (isset($this)) {
                $consulta = $this->db->getData($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        if($consulta){
            return $consulta;
        }
        return [];

    }

    public function getEstudiante() {
        
        $sql="SELECT p.name,p.last_name,p.document_number,p.email,p.phone_number,p.city, p.centro,p.codigo_estudiante, p.id FROM person p where p.id_person_type = 1";
        
        
        //echo $sql. "---";
        $consulta = array();
        try {
            if (isset($this)) {
                $consulta = $this->db->getData($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        if($consulta){
            return $consulta;
        }
        return [];

    }

    public function deletePerson($id) {        
        $sql="DELETE  FROM person p where p.id = '$id'";
     
        try {
            
        $this->db->executeInstruction($sql);
            
        } catch (Exception $e) {
            print $e;
        }
       

    }

}
