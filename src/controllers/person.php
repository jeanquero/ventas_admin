<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once __DIR__."/../repository/person.php";
require_once __DIR__."/../dto/PersonDTO.php";
$error = '';
$success='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    $persona = new Person();
    try {
        $personaDTO = new PersonDTO();
        $personaDTO->setName($_POST['nombres']);
        $personaDTO->setLastName($_POST['apellidos']);
        $personaDTO->setDocumentNumber($_POST['dni']);
        $personaDTO->setEmail($_POST['email']);
        $personaDTO->setPhoneNumer($_POST['celular']);
        $personaDTO->setCity($_POST['city']);
        $personaDTO->setTotal($_POST['total']);
        $personaDTO->setIdDocumentType(4);
        $personaDTO->setIdPersonType(1);
        $personaDTO->setCompanyName('');
        $personaDTO->setInvitado('');

        $save = $persona->postCreatePerson($personaDTO);
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

}

return $_POST;