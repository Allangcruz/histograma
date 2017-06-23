<?php

require_once('Histograma.php');
require_once('Filtro.php');

error_reporting(E_ALL ^ E_NOTICE);

$acao = (isset($_REQUEST['acao'])) ? $_REQUEST['acao'] : '';

if ($acao == 'histograma') {
    $imagem = (isset($_REQUEST['imagem'])) ? $_REQUEST['imagem'] : '009.jpg';

    $histograma = new Histograma();
    $histograma->setImagem("../assets/imgs/009.jpg");
    $dados = $histograma->getValoresIndicador();

    echo json_encode(['data' => $dados]);
}

if ($acao == 'filtrar') {
    try {

        $dados = new stdClass();
        $dados->filtros = (isset($_REQUEST['filtros'])) ? $_REQUEST['filtros'] : '';
        $dados->mascara = (isset($_REQUEST['mascara'])) ? $_REQUEST['mascara'] : '';
        $dados->arquivo = (isset($_FILES['imagem'])) ? $_FILES['imagem'] : '';

        $filtro = new Filtro();
        $filtro->verificaObrigatorios($dados);
        $resuldado = $filtro->filtrar($dados);

        echo json_encode(['data' => $resuldado]);
    } catch (Exception $e) {
        echo $e->getMessage();
        http_response_code(500);
    }
}
