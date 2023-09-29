<?php


include "autoload.php";

$metodo = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
$input = json_decode(file_get_contents("php://input"));

if ($metodo == "GET") {

    $funcionarios = new Funcionario();

    if(isset($_GET["nome"]) && isset($_GET["apelido"])){

        $res = $funcionarios->filtrarFuncionarios($_GET["nome"],$_GET["apelido"]);
    }else{

        $res = $funcionarios->obterFuncionarios();
    }
    echo json_encode($res);


} else if ($metodo == "POST") {




} else if ($metodo == "PUT") {



} elseif ($metodo == "DELETE") {


}


?>