<?php


ini_set("display_errors",1);
                ini_set("display_startup_erros",1);
                error_reporting(E_ALL);	

require_once __DIR__ . '/repositories/forma_pagamentoRepository.php';

$FormaPagamentoRepository = new FormaPagamentoRepository();



print_r($FormaPagamentoRepository->getAll());

?>



