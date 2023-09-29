<?php


include "autoload.php";

$metodo = $_SERVER["REQUEST_METHOD"];


if ($metodo == "GET") {
    header('Content-Type: application/json');
    $tipo = $_GET["tipo"];
    $nome = isset($_GET["nome"]) ? $_GET["nome"] : "";
    $apelido = isset($_GET["apelido"]) ? $_GET["apelido"] : "";
    if (!isset($_GET["nome"]) && !isset($_GET["apelido"])) {
        if ($tipo == "Funcionario") {
            $p = new Funcionario();
            $id = isset($_GET['id']) ? $_GET["id"] : "";

            if (!empty($id)) {
                // $dados = $p->obter_funcionario_por_id($id);
            } else {

                $dados = $p->obterFuncionarios();
            }

            echo json_encode($dados);

        } elseif ($tipo == "Idoso") {
            $idoso = new Idoso();
            $id = isset($_GET['id']) ? $_GET["id"] : "";

            if (!empty($id)) {
                $dados1 = $idoso->obterIdosoPorId($id);
                $dados2 = $idoso->obterFamiliarIdoso($id);
                $dados = array("idoso" => $dados1, "familiar" => $dados2);
            } else {

                $dados = $idoso->obterIdosos();
            }

            echo json_encode($dados);

        } elseif ($tipo == "Familiar") {
            $familiar = new Familiar();
            $id = isset($_GET['id']) ? $_GET["id"] : "";

            if (!empty($id)) {
                // $dados = $familiar->obterFamiliarPorId($id);
                // $dados2 = $familiar->obter_idoso_familiar($id);
                // $dados = array("familiar" => $dados, "idoso" => $dados2);
            } else {

                $dados = $familiar->obterFamiliares();
            }

            echo json_encode($dados);

        } elseif ($tipo == "Documento") {

            $familiar = new Documento();

            $id = isset($_GET['id']) ? $_GET["id"] : "";

            if (!empty($id)) {
                $dados = $familiar->obterDocumentoPorId($id);

            } else {

                $dados = $familiar->obterDocumentos();
            }

            echo json_encode($dados);
        }
    } else {

        if ($tipo == "Funcionario") {
            $p = new Funcionario();



            // $dados = $p->filtrar_funcionarios($nome, $apelido);

            echo json_encode($dados);

        } elseif ($tipo == "Idoso") {
            $idoso = new Idoso();
            $dados = $idoso->filtrarIdosos($nome, $apelido);


            echo json_encode($dados);

        } elseif ($tipo == "Familiar") {
            $familiar = new Familiar();
            $dados = $familiar->filtrarFamiliares($nome, $apelido);


            echo json_encode($dados);
        }




    }




} else if ($metodo == "POST") {

    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $met = isset($_POST["metodo"]) ? $_POST["metodo"] : "";
    $pessoa = isset($_POST["pessoa"]) ? $_POST["pessoa"] : "";
    $id = intval($id);
    if (empty($id) || empty($met) || empty($pessoa)) {
        $input = json_decode(file_get_contents("php://input"));



        if ($input->tipo == "Funcionario") {

            $funcionario = new Funcionario();

            // echo json_encode($funcionario->inserir_funcionario($input));


        } elseif ($input->tipo == "Idoso") {
            $pessoa = new Idoso();

            // echo json_encode($pessoa->inserir_idoso($input));

        } elseif ($input->tipo == "Familiar") {
            $familiar = new Familiar();

            // echo json_encode($familiar->inserir_familiar($input));

        }




    } else {

        if ($pessoa == "Idoso") {

            $idoso = new Idoso();

            $res = $idoso->eliminarIdoso($id);
            if ($res == "sucesso") {
                header("Location: /Gaan/index.php/idosos");
            } else if ($res == "insucesso") {
                echo json_encode($res);
            } else {
                header("Location: /Gaan/index.php/idosos/detalhes/" . $id);
            }

        } else if ($pessoa == "Familiar") {

            $familiar = new Familiar();
            // $res = $familiar->eliminar_familiar(number_format($id));

            if ($res == "sucesso") {
                header("Location: /Gaan/index.php/familiares");
            } else if ($res == "insucesso") {
                echo json_encode($res);
            } else {
                header("Location: /Gaan/index.php/familiares/detalhes/" . $id);
            }

        } else if ($pessoa == "Funcionario") {
            $funcionario = new Funcionario();
            // $res = $funcionario->eliminar_funcionario($id);

            if ($res == "sucesso") {
                header("Location: /Gaan/index.php/funcionarios");
            } else if ($res == "insucesso") {
                echo json_encode($res);
            } else {
                header("Location: /Gaan/index.php/funcionarios/detalhes/" . $id);
            }

        }
    }






} else if ($metodo == "PUT") {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents("php://input"));

    if ($input->tipo == "Funcionario") {

        $funcionario = new Funcionario();

        // $res = $funcionario->atualizar_funcionario($input);

        echo json_encode($res);


    } elseif ($input->tipo == "Idoso") {

        $idoso = new Idoso();

        $res = $idoso->atualizarIdoso($input);

        echo json_encode($res);


    } elseif ($input->tipo == "Familiar") {

        $familiar = new Familiar();

        // $res = $familiar->atualizar_familiar($input);

        echo json_encode($res);


    }




} elseif ($metodo == "DELETE") {

    $input = json_decode(file_get_contents("php://input"));

    if ($input->tipo == "Funcionario") {

        $pessoa = new Funcionario();

        // $res = $pessoa->eliminar_funcionario($input);

        echo json_encode($res);


    } elseif ($input->tipo == "Idoso") {

        $idoso = new Idoso();

        $res = $idoso->eliminarIdoso($input->id);

        echo json_encode($res);


    } elseif ($input->tipo == "Familiar") {

        $pessoa = new Familiar();

        // $res = $pessoa->eliminar_familiar($input);

        echo json_encode($res);


    }

}


?>