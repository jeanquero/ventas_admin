<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once __DIR__ . "/../db/conexion.php";
$db = new MysqlDB();
$db->connect();


if (empty($_POST['action'])) {
    $document_type = $_POST["document_type"];
    $precio_individual = $_POST["precio_individual"];
    $precio_corparativo = $_POST["precio_corparativo"];
    $divisa = $_POST["divisa"];
    $estado = $_POST["estado"];
        
    $id = $_POST["id"];
    if (empty($id)) {
        

            $sql = "INSERT INTO pagos (precio_individual, precio_corparativo, divisa, id_document_type, estado) 
            VALUES ('$precio_individual', '$precio_corparativo', '$divisa', ".$document_type.", '$estado')";
            try {
                // echo json_encode($sql);
                $db->executeInstruction($sql);
                echo json_encode(["error" => "false", "message" => "Se registro el Precio"]);
            } catch (Exception $e) {
                echo json_encode(["error" => "true", "message" => "Error al guardar el precio!"]);
            }
        
    } else {
        
            $sql = "UPDATE pagos t SET t.precio_individual = '$precio_individual', t.precio_corparativo = '$precio_corparativo', 
        t.divisa ='$divisa', t.estado= '$estado' WHERE t.id = '$id'";

            try {
                // echo json_encode($sql);
                $db->executeInstruction($sql);
                echo json_encode(["error" => "false", "message" => "Se actualizo el precio!"]);
            } catch (Exception $e) {
                echo json_encode(["error" => "true", "message" => "Error al guardar el precio!" , "sql" => $sql]);
            }
       
    }
} else {
    $sql="DELETE  FROM pagos p where p.id = '$id'";
     
        try {
            
        $this->db->executeInstruction($sql);
            
        } catch (Exception $e) {
           // print $e;
        }
    echo json_encode([ 'error' => '', 'success'=>'true']);
}
return $_POST;
