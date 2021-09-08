<?php
require_once __DIR__ . "/../repository/payment_tdd.php";
require_once __DIR__ . "/../repository/company.php";
require_once __DIR__ . "/../dto/CompanyDTO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $postPayment = new PaymentTddCompany();
        $num_tdd = empty($_POST['num_tdd']) ? isset($_POST['num_tdd']) : 1223133;
        $name = empty($_POST['names']) ? $_POST['names'] : 'Nombre prueba';
        $last_name = empty($_POST['last_name']) ? $_POST['last_name'] : 'Apell Prueba';
        $email = empty($_POST['email']) ? $_POST['email'] : 'lopezasjoseg@gmail.com';
        $num_transaction= empty($_POST['num_transaction'])  ? $_POST['num_transaction'] : '1564562316546';
    }catch (Exception $e){
        echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
        return;
    }

    try {
        $companyDTO = new CompanyDTO();
        $companyDTO->setName(empty($_POST['name']) ? $_POST['name'] : 'Company prueba') ;
        $companyDTO->setAddress($_POST['address'] ?? 'Peru') ;
        $companyDTO->setDocumentNumber($_POST['ruc'] ?? '115645454') ;
        $companyDTO->setParticipantsNumber($_POST['participants_number'] ?? 2 );
        $companyDTO->setIdDocumentType($_POST['documentType'] ?? '1456456121');
        $companyDTO->setTotal($_POST['total'] ?? '45');
        $companyDTO->setActivity($_POST['activity'] ?? 'Banca');
        $companyDTO->setIdCountry($_POST['country'] ?? 'Peru');
        $companyDTO->setBilling($_POST['billing'] ??  'Pr');
    }catch (Exception $e){
        echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
        return;
    }

    try {
        $postPayment->postCreatePaymentTdd($name,$last_name,$email,$num_tdd,$num_transaction,$companyDTO);
    }catch (Exception $e){
        echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
        return;
    }
}

class  PaymentTddCompany {

    public function postCreatePaymentTdd($name,$last_name,$email,$num_tdd,$num_transaction,$companyDTO)
    {
        /* Guardar el pago */
        $repository = new PaymentTddRepository();
        try {
            $sql="INSERT INTO payment_tdd (num_tdd,names,last_name,email,num_transaction) VALUES ($num_tdd,'$name', '$last_name', '$email','$num_transaction');";
        }catch (Exception $e){
            echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
            return;
        }

        $respPayment = '';
        $respPerson = '';
        try {
            $respPayment = $repository->postCreatePaymentTdd($sql);
            //echo json_encode (["error" => "true", "message"=>"Error", "error"=> $respPayment]);
        } catch (Exception $e) {
            echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
            return;
        }
        try {
            $company = new Company();
            $save = $company->postCreateCompany($companyDTO);
            $findCompany = $company->getCompanyDocumentNumber($_POST['ruc']);
            $idCompany = $findCompany['id'];
            if($idCompany){
                $repository->updatePaymentTddCompany($num_transaction, $idCompany);
            }

        }catch (Exception $e){
            echo json_encode(['error' => 'Error al crear Company', 'success' => 'false',"error"=> $e->getMessage()]);
            return;
        }

        echo json_encode(["error" => "false",'message'=>'success']);
    }
}