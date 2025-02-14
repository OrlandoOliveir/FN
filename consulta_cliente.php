<?php


ini_set("display_errors",1);
                ini_set("display_startup_erros",1);
                error_reporting(E_ALL);	

require_once __DIR__ . '/repositories/clienteRepository.php';

$clienteRepository = new clienteRepository();



print_r($clienteRepository->getAll());

?>



