
<!DOCTYPE html>
<html lang="pt-pt">
    <head>
        <title><?=$this->titulo?></title> <!--a ser atribuido dinamicamente-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="<?=$this->formatacao?>">
        <link rel="icon" href="http://localhost/Gaan/favicon.ico">
        <link rel="stylesheet" href="http://localhost/Gaan/Formatacao/estilo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       

    </head>

    <body class="container-fluid">
        <?php
        require 'nav.php';
        //Depois de ser carregado o template, este por sua vez consegue chamar o metodo a seguir
        $this->carregarViewNoTemplate($nomeView, $dadosModel, $dadosModel2);
        ?>
    </body>
</html>