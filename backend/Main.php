<?php

require_once('Histograma.php');

error_reporting(E_ALL ^ E_NOTICE);

$imagem = (isset($_REQUEST['imagem'])) ? $_REQUEST['imagem'] : '009.jpg';

$histograma = new Histograma();
$histograma->setImagem("../assets/imgs/009.jpg");
$dados = $histograma->getValoresIndicador();

echo json_encode(['data' => $dados]);
