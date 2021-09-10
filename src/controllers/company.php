<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once __DIR__ ."/../db/conexion.php";
$db = new MysqlDB();
$db->connect();

function getCompanyDocumentNumber($document_number) {
    $sql="SELECT * FROM company where document_number ='$document_number'";
    //echo $sql. "---";
    $consulta = array();
    try {
    $db = new MysqlDB();
    $db->connect();    
    $consulta = $db->getDataSingle($sql);
    } catch (Exception $e) {
        print $e;
    }
    if($consulta){
        return $consulta;
    }
    return [];

}

$name = $_POST["name"];
$address = $_POST["address"];
$participantsNumber = $_POST["participants_number"];
$document = $_POST["ruc"];
$activity = $_POST["activity"];
$id_country = $_POST["country"];
$total = 0;
$documentType = $_POST["documentType"];
$billing = $_POST["billing"];
$id = $_POST["id"];
if (empty($id)) {
    $findCompany = getCompanyDocumentNumber($document);
    if (count($findCompany) == 0) {
        $sql = "INSERT INTO company (name,document_number,id_document_type,address , activity ,  billing ,  id_county ,  participants_number ,  total ) 
                       VALUES('$name','$document','$documentType','$address','$activity','$billing','$id_country',$participantsNumber, '$total')";
        try {
            // echo json_encode($sql);
           $db->executeInstruction($sql);
            echo json_encode(["error" => "false", "message" => "Se registro la empresa exitosamente!"]);
        } catch (Exception $e) {
            echo json_encode(["error" => "true", "message" => "Error al guardar la empresa!"]);
        }
    } else {
        echo json_encode(["error" => "true", "message" => "Error ya se encuentra registrado este RUC."]);
    }
}

return $_POST;
