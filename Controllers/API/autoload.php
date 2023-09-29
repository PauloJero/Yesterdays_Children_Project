<?php 
spl_autoload_register(function($nomeArquivo){
    

    if(file_exists('../'. $nomeArquivo . '.php')){
        
        require '../'. $nomeArquivo . '.php';

    }elseif(file_exists('../../Models/' . $nomeArquivo . '.php')){
        // echo "A";
        require '../../Models/'. $nomeArquivo . '.php';

    }elseif(file_exists('../../Core/' . $nomeArquivo . '.php')){
        
        require '../../Core/' .$nomeArquivo. '.php';

    }else{
        // include 'Models/'. $nomeArquivo . '.php';
    }
});