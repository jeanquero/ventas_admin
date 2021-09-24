<?php
require_once __DIR__ ."/../db/conexion.php";
class Company {

    private $db;

    function __construct() {
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
      //  mysqli_rollback($this->db->getConnect());
    }
    public function postCreateCompany(CompanyDTO $company) {
       // INSERT INTO  company  ( id ,  name ,  document_number ,  id_document_type , 
       // address ,  activity ,  billing ,  id_county ,  participants_number ,  total )
       // VALUES (null,'TPT','777777',2,'PERU','CARNE','2345',1,2,774);
       $name=$company->getName();
       $address=$company->getAddress();
       $participantsNumber = $company->getParticipantsNumber();
       $document = $company->getDocumentNumber();
       $activity = $company->getActivity();
       $id_country = $company->getIdCountry();
       $total = $company->getTotal();
       $documentType = $company->getIdDocumentType();
       $billing = $company->getBilling();

       $findCompany = $this->getCompanyDocumentNumber($document);

       if(count($findCompany) == 0){
           $sql="INSERT INTO company (name,document_number,id_document_type,address , activity ,  billing ,  id_county ,  participants_number ,  total ) 
                       VALUES('$name','$document','$documentType','$address','$activity','$billing','$id_country',$participantsNumber, '$total')";
           try {
              // echo json_encode($sql);
               $this->db->executeInstruction($sql);
               return ["error" => "false", "message"=>"Se registro la empresa exitosamente!"];
           }catch (Exception $e){
               return ["error" => "true", "message"=>"Error al guardar la empresa!"];
           }
       }else{
           return ["error" => "true", "message"=>"Error ya se encuentra registrado este RUC."];
       }

    }

    public function postCreateRelCompanyPerson($id_company, $id_person) {
           $sql="INSERT INTO company_person_rel (id_company,id_person) 
                        VALUES('$id_company','$id_person')";
                       
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro la empresa exitosamente!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>"Error al guardar la empresa!"];
            }
       
 
     }
 

    public function getCompanyDocumentNumber($document_number) {
        $sql="SELECT * FROM company where document_number ='$document_number'";
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

    public function getCompany() {
        $sql = "Select c.id numero_identificacion, c.name as name_company, c.document_number, c.address,c2.name as country, c.activity,c.billing,

        (select count(*) from person tr, company_person_rel rel_tr
         where tr.id= rel_tr.id_person AND rel_tr.id_company= c.id AND tr.id_person_type = 3) as workers,
        (select count(*) from payment pay WHERE pay.company_id = c.id) as  payment,(select re.name from person re, company_person_rel rel_re
                                                                                    where re.id= rel_re.id_person AND rel_re.id_company= c.id AND re.id_person_type = 2) as nombre_representante,
                                                                                     c.id, c.id_county
 from company c
          INNER JOIN country c2 on c.id_county = c2.id WHERE c.id_document_type = 3";
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

    public function getCompanyAVEN() {
        $sql = "Select c.id numero_identificacion, c.name as name_company, c.document_number, c.address,c2.name as country, c.activity,c.billing,

        (select count(*) from person tr, company_person_rel rel_tr
         where tr.id= rel_tr.id_person AND rel_tr.id_company= c.id AND tr.id_person_type = 3) as workers,
        (select count(*) from payment pay WHERE pay.company_id = c.id) as  payment,(select re.name from person re, company_person_rel rel_re
                                                                                    where re.id= rel_re.id_person AND rel_re.id_company= c.id AND re.id_person_type = 2 LIMIT 1) as nombre_representante,
                                                                                     c.id, c.id_county
 from company c
          INNER JOIN country c2 on c.id_county = c2.id WHERE c.id_document_type = 2";
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

    public function getCompanyRegular() {
        $sql = "Select c.id numero_identificacion, c.name as name_company, c.document_number, c.address,c2.name as country,c.activity, c.billing,

        (select count(*) from person tr, company_person_rel rel_tr
         where tr.id= rel_tr.id_person AND rel_tr.id_company= c.id AND tr.id_person_type = 3) as workers,
        (select count(*) from payment pay WHERE pay.company_id = c.id) as  payment,(select re.name from person re, company_person_rel rel_re
                                                                                    where re.id= rel_re.id_person AND rel_re.id_company= c.id AND re.id_person_type = 2 LIMIT 1) as nombre_representante,
                                                                                     c.id, c.id_county
 from company c
          INNER JOIN country c2 on c.id_county = c2.id WHERE c.id_document_type = 1";
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


    public function getCompanyPago() {
        $sql = "SELECT c.name as name_company,c.document_number, 
        (select CONCAT(re.name , ', ' , re.last_name) from person re, company_person_rel rel_re where re.id= rel_re.id_person AND rel_re.id_company= c.id AND re.id_person_type = 2 LIMIT 1) as nombre_representante,
dt.name,c.participants_number, c.total,
(select count(*) from payment pay WHERE pay.company_id = c.id) as  type_payment,
pay.bank , pay.reference, 
         CONCAT('ID', c.id, '-', pay.voucher) as voucher,
(select count(*) from payment pay WHERE pay.company_id = c.id) as  payment,
        
                                                                                     c.id
FROM payment pay JOIN company c ON c.id = pay.company_id 
          JOIN country c2 on c.id_county = c2.id
          JOIN document_type dt ON dt.id = c.id_document_type     ";
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

    public function getPeoplePago() {
       

          $sql="SELECT dt.name as document, p.name,p.last_name,p.document_number,p.email, p.centro,p.total,
          (select count(*) from payment pay WHERE pay.person_id = p.id) as  type_payment,
          (select pay2.bank from payment pay2 WHERE pay2.person_id = p.id) as bank,
          (select pay3.reference from payment pay3 WHERE pay3.person_id = p.id) reference,
          CONCAT('ID', p.id, '-', (select pay4.voucher from payment pay4 WHERE pay4.person_id = p.id))  as voucher,
          (select count(*) from payment pay WHERE pay.person_id = p.id) as  payment,
           p.id 
          FROM person p
          JOIN document_type dt ON dt.id = p.id_document_type 
           where p.id_person_type = 1";
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
    public function getPrecio() {
        $sql = "SELECT d.name, t.precio_individual, t.precio_corparativo, t.divisa, t.estado, t.id, t.id_document_type
        FROM pagos t join document_type d on d.id = t.id_document_type";
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

  

}
