<?php


include "autoload.php";

$metodo = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
$input = json_decode(file_get_contents("php://input"));

if ($metodo == "GET") {
    $familiares = new Familiar();

    if(isset($_GET["nome"]) && isset($_GET["apelido"])){

        $res = $familiares->filtrarFamiliares($_GET["nome"],$_GET["apelido"]);
    }else{

        $res = $familiares->obterFamiliares();
    }


    echo json_encode($res);



} else if ($metodo == "POST") {


    $input = json_decode(file_get_contents("php://input"));




} else if ($metodo == "PUT") {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents("php://input"));





} elseif ($metodo == "DELETE") {

    $input = json_decode(file_get_contents("php://input"));



}


?>