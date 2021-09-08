<?php
require_once __DIR__ . "/../repository/person.php";
require_once __DIR__ . "/../../db/conexion.php";
require_once __DIR__ . "/../repository/company.php";
$target_path = __DIR__ . "/";

$person = json_decode($_POST['json'], true);
$email = $person['email'];
$archivo = $_FILES['file'];
//echo json_encode([ 'error' => 'false', 'success'=>'Se guardo exitosamente']);
$repository = new Person();
if (!empty($email)) {
    $persona = $repository->getPersonCorreo($email);
} else {
    $company = new Company();
    $persona = $company->getCompanyDocumentNumber($person['ruc']);
}

$archivo = $_FILES['file'];


/*Subir la imagen en la uploads*/

$target_path = $target_path . basename($_FILES['file']['name']);
$resultado = move_uploaded_file($archivo["tmp_name"], __DIR__ . '/../../uploads/' . "ID" . $persona['id'] . '-' . $archivo["name"]);

/* Buscar la persona creado por el correo */

if ($persona) {
    $bank = $person['entidad_bancaria'];
    $reference = $person['reference'];
    $voucher = $person['voucher'];
    $sql = '';
    if (!empty($email)) {
        $persona_id = $persona['id'];
        $sql = "INSERT INTO payment (bank,reference,voucher,person_id) VALUES('$bank','$reference','$voucher','$persona_id')";
    } else {
        $company_id = $persona['id'];
        $sql = "INSERT INTO payment (bank,reference,voucher,company_id) VALUES('$bank','$reference','$voucher','$company_id')";
    }
    try {
        $save = $repository->postCreatePayment($sql);
        echo json_encode(['error' => 'false', 'success' => 'Se guardo exitosamente']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'true', 'success' => 'Error al guardar en la bd ']);
    }
}
