<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once __DIR__."/../repository/person.php";
require_once __DIR__."/../dto/PersonDTO.php";
$error = '';
$success='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $persona = new Person();
    if(empty($_POST['action'])){
    $error = '';
    
    try {
        $personaDTO = new PersonDTO();
        $personaDTO->setName($_POST['name']);
        $personaDTO->setLastName($_POST['last_name']);
        $personaDTO->setDocumentNumber($_POST['document']);
        $personaDTO->setEmail($_POST['email']);
        $personaDTO->setPhoneNumer($_POST['phone_number']);
        $personaDTO->setCity($_POST['city']);
        $personaDTO->setTotal(0);
        $personaDTO->setIdDocumentType($_POST['documentType']);
        $personaDTO->setIdPersonType($_POST["id_person_type"]);
        $personaDTO->setCompanyName($_POST['part_empresa']);
        $personaDTO->setInvitado($_POST['invitado']);
        $personaDTO->setPosition($_POST['position']);
        $personaDTO->setCodigoEstudiante($_POST['codigo_estudiante']);
        $personaDTO->setCentro($_POST['centro']);

        
        $id = $_POST["id"];
        if (empty($id)) {
        $save = $persona->postCreatePerson($personaDTO);
        } else {
            $save = $persona->postUpdatePerson($personaDTO,$id,$_POST["old_document"],$_POST["old_email"]);
            
        }
        if($save && $save['error'] == 'false'){
            $error = '';
            $success = $save['message'];
            echo json_encode([ 'error' => $error, 'success'=>$success]);
        }else{
            $error = $save['message'];
            echo json_encode([ 'error' => $error, 'success'=>'false']);
        }
    }catch (Exception $e){
        echo json_encode($e);
        echo $e;
    }
} else {
    $persona->deletePerson($_POST["id"]);
    echo json_encode([ 'error' => '', 'success'=>'true']);
}

}

return $_POST;