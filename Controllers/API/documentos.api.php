<?php

include "autoload.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "GET") {

    $documentos = new Documento();

    if(isset($_GET["id"])){

        $dados = $documentos->obterDocumentoPorId($_GET["id"]);
    }else{

        $dados = $documentos->obterDocumentos();
    }
    echo json_encode($dados);



} elseif ($metodo == "POST") {

    //    $input = json_decode(file_get_contents("php://input"));

    if (isset($_FILES['file'])) {
        // Define o nome e o caminho do arquivo a ser salvo
        $target_dir = "../../Midia/Idosos/" . $_POST["idIdoso"];
        if (!is_dir($target_dir)) {
            // Cria o diretório
            mkdir($target_dir);
        }
        $target_file = $target_dir . "/" . basename(str_replace(" ", "_", $_FILES["file"]["name"]));

        $file = "/Gaan/Midia/" . $_POST["idIdoso"] . "/" . basename(str_replace(" ", "_", $_FILES["file"]["name"]));

        // Verifica se o arquivo já existe
        if (file_exists($target_file)) {
            echo json_encode("existe");
        } else {
            // Tenta mover o arquivo enviado para o diretório de destino
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                // Obtém os dados adicionais do formulário
                $tipo = $_POST['tipo'];
                $origem = $_POST['origem'];
                $id_idoso = $_POST['idIdoso'];
                $idFuncResponsavel = $_POST['idFuncResponsavel'];

                $dados = array(
                    "tipo" => $tipo,
                    "origem" => $origem,
                    "idIdoso" => $id_idoso,
                    "idFuncResponsavel" => $idFuncResponsavel,
                    "caminho" => $file
                );

                $doc = new Documento();
                $res = $doc->inserirDocumento($dados);

                if ($res) {
                    echo json_encode("sucesso");
                } else {
                    echo json_encode("insucesso");
                }

            } else {
                echo json_encode("erro");
            }
        }
    }


} elseif ($metodo == "PUT") {




} elseif ($metodo == "DELETE") {



}


?>