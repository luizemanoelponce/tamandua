<?php
use Tarefas\Controller\TesteController;

$Router->Route("METODO", "/teste/testando1", function(){});
$Router->Route("POST", "/teste/void", function(){});
$Router->Route("GET", "/teste/testando2", function(){});

$Router->Route("GET", "/teste/testando", function (){
    

    return TesteController::testando();
});

$Router->Route("GET", "/", function(){}); 