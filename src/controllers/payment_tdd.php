<?php
require_once __DIR__ . "/../repository/payment_tdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$payment = json_decode($_POST, true);
    $postPayment = new PaymentTdd();
    $num_tdd = $_POST['num_tdd'];
    $name = $_POST['names'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $num_transaction= $_POST['num_transaction'];
    $person_email = $_POST['person_email'];
    $person_nombres = $_POST['person_nombres'];
    $person_apellidos = $_POST['person_apellidos'];
    $person_dni = $_POST['person_dni'];
    $person_city = $_POST['person_city'];
    $person_celular = $_POST['person_celular'];
    $person_total = $_POST['person_total'];

    $postPayment->postCreatePaymentTdd($name,$last_name,$email,$num_tdd,$num_transaction,$person_email,$person_nombres,$person_apellidos,$person_dni,$person_city,$person_celular,$person_total);
}

class PaymentTdd
{
    public function postCreatePaymentTdd($name,$last_name,$email,$num_tdd,$num_transaction,$person_email,$person_nombres,$person_apellidos,$person_dni,$person_city,$person_celular,$person_total)
    {

        /* Guardar el pago */
        $person_id = $_POST['person_id'];
        $repository = new PaymentTddRepository();
        $sql="INSERT INTO payment_tdd (num_tdd,names,last_name,email,num_transaction)
                        VALUES($num_tdd,'$name', '$last_name', '$email','$num_transaction');";
        $respPayment = '';
        $respPerson = '';
        try {
            $respPayment = $repository->postCreatePaymentTdd($sql);
        } catch (Exception $e) {
            echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
            return;
        }

        try {
            $respPerson = $repository->postCreatePersonStudent($person_nombres,$person_apellidos,$person_email,$person_dni,$person_celular,$person_city,$person_total,3);
            $person = $repository->getPersonCorreo($person_email);
            $person_id =$person['id'];
            if($person_id){
                $repository->updatePaymentTdd($num_transaction, $person_id);
            }

        }catch (Exception $e){
            echo json_encode (["error" => "true", "message"=>"Error", "error"=> $e->getMessage()]);
            return;
        }
        echo json_encode(["error" => "false",'message'=>'success']);
    }
}
