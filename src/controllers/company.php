<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once __DIR__ . "/../repository/person.php";
require_once __DIR__ . "/../dto/PersonDTO.php";
require_once __DIR__ . "/../repository/company.php";
require_once __DIR__ . "/../dto/CompanyDTO.php";
$error = '';
$success = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    $company = new Company();
    $company->initTransaction();
    try {
        $persona = new Person();
        $findPerson = $persona->getPersonDocumentNumber($_POST['re_dni'], $_POST['re_correo']);
        if(count($findPerson) > 0){
            echo json_encode(['error' => 'El registrados ya se encuentra registrado', 'success' => 'false']);
            exit(1);
        }
        
        $companyDTO = new CompanyDTO();
        $companyDTO->setName($_POST['name']);
        $companyDTO->setAddress($_POST['address']);
        $companyDTO->setDocumentNumber($_POST['ruc']);
        $companyDTO->setParticipantsNumber($_POST['participants_number']);
        $companyDTO->setIdDocumentType($_POST['documentType']);
        $companyDTO->setTotal($_POST['total']);
        $companyDTO->setActivity($_POST['activity']);
        $companyDTO->setIdCountry($_POST['country']);
        $companyDTO->setBilling($_POST['billing']);

        $save = $company->postCreateCompany($companyDTO);
        if ($save && $save['error'] == 'false') {

            
            $personaDTO = new PersonDTO();
            $personaDTO->setName($_POST['re_nombres']);
            $personaDTO->setLastName($_POST['re_apellidos']);
            $personaDTO->setDocumentNumber($_POST['re_dni']);
            $personaDTO->setEmail($_POST['re_correo']);
            $personaDTO->setPhoneNumer($_POST['re_celular']);
            $personaDTO->setPosition($_POST['position']);
            $personaDTO->setIdDocumentType('2');
            $personaDTO->setTotal(0);
            $personaDTO->setIdPersonType(2);
            $personaDTO->setCompanyName('');
            $personaDTO->setInvitado('');

            $save = $persona->postCreatePerson($personaDTO);

            if ($save && $save['error'] == 'false') {
                $findPerson = $persona->getPersonDocumentNumber($_POST['re_dni'], $_POST['re_correo']);
                $findCompany = $company->getCompanyDocumentNumber($_POST['ruc']);

                $save = $company->postCreateRelCompanyPerson($findCompany["id"], $findPerson["id"]);
                if ($save && $save['error'] == 'false') {
                    
                    $workers = json_decode($_POST["workers"]);                    
                    foreach ($workers as $item) {
                        
                        $worker = new PersonDTO();
                        $worker->setName($item->name);
                        $worker->setLastName($item->lastName);
                        $worker->setDocumentNumber($item->dni);
                        $worker->setEmail($item->email);
                        $worker->setPhoneNumer('');
                        $worker->setPosition($item->position);
                        $worker->setIdDocumentType('2');
                        $worker->setTotal(0);
                        $worker->setIdPersonType(3);
                        $worker->setCompanyName($item->empresa);
                        $worker->setInvitado($item->invitado);
                        
                   
                        $persona->postCreatePerson($worker);
                        $findWorker = $persona->getPersonDocumentNumber($item->dni, $item->email);
                        $company->postCreateRelCompanyPerson($findCompany["id"], $findWorker["id"]);
                    }
                    $company->commitDB();
                    echo json_encode(array('error' => '', 'success' => 'true'));
                    

                } else {
                    $company->rollBack();
                    $error = $save['message'];
                    echo json_encode(['error' => $error, 'success' => 'false']);
                }
            } else { 
                $company->rollBack();               
                echo json_encode(['error' => 'El registrados ya se encuentra registrado', 'success' => $save ]);
            }
        } else {
            $company->rollBack();
            $error = $save['message'];
            echo json_encode(['error' => $error, 'success' => 'false']);
        }
    } catch (Exception $e) {
        $company->rollBack();
        echo $e;
        echo json_encode(['error' => $e, 'success' => 'false']);
    }
}

return $_POST;