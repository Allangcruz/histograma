<?php

require_once('Histograma.php');

$histograma = new Histograma();
$histograma->setImagem("../assets/imgs/004.png");
$dados = $histograma->getValoresIndicador();

echo json_encode(['data' => $dados]);
