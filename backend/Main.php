<?php

require_once('Histograma.php');

error_reporting(E_ALL ^ E_NOTICE);

$histograma = new Histograma();
$histograma->setImagem("../assets/imgs/004.png");
$dados = $histograma->getValoresIndicador();

echo json_encode(['data' => $dados]);
