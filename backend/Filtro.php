<?php

require_once('Histograma.php');

class Filtro
{

    const MEDIA = 1;

    const MEDIANA = 2;

    private $imagem;

    /**
     * Verifica os campos obrigatorios
     *
     * @param $dados
     */
    public function verificaObrigatorios($dados)
    {
        // escolha uma imagem
        if (empty($dados->arquivo['name'])) {
            throw new Exception('Favor escolha alguma imagem.');
        }

        // escolha um filtro
        if (empty($dados->filtros)) {
            throw new Exception('Favor escolha algum filtro.');
        }

        // escolha uma mascara
        if (empty($dados->mascara)) {
            throw new Exception('Favor escolha alguma mascara.');
        }

        foreach ($dados->filtros as $filtro) {
            if ($filtro == self::MEDIANA && empty($dados->mascara['mediana'])) {
                throw new Exception('Escolha algum valor para a mascara do filtro de MEDIANA');
            }

            if ($filtro == self::MEDIA && empty($dados->mascara['media'])) {
                throw new Exception('Escolha algum valor para a mascara do filtro de MEDIA');
            }
        }
    }

    /**
     * Ler a imagem que foi carregada.
     *
     * @return void
     */
    private function lerImagem($imagem)
    {
        $this->imagem = new Imagick(realpath($imagem['tmp_name']));
    }

    /**
     * Aplica filtro de acordo com parametros informados
     *
     * @param $dados
     * @return void
     */
    public function filtrar($dados)
    {
        $this->lerImagem($dados->arquivo);

        foreach ($dados->filtros as $filtro) {
            if ($filtro == self::MEDIA && ! empty($dados->mascara['media'])) {
                $this->media($dados->mascara['media']);
            }

            if ($filtro == self::MEDIANA && ! empty($dados->mascara['mediana'])) {
                $this->mediana($dados->mascara['mediana']);
            }
        }

        $imagemFiltro = $this->imagem->getImageBlob();
        $this->imagem->writeImage('../assets/imgs/imagem-filtrada.png');
        $histograma = new Histograma();

        return [
            "filtro" => 'data:image/png;base64,'.base64_encode($imagemFiltro),
            "histograma_original" => $histograma->getValoresIndicador($dados),
            "histograma_filtrado" => $histograma->getValoresIndicadorFiltrado()
        ];
    }

    /**
     * Aplica filtro de Media
     *
     * @param $valor
     * @return void
     */
    private function media($valor)
    {
        @$this->imagem->blurImage($valor, $valor);
    }

    /**
     * Aplica filtro de Mediana
     *
     * @param $valor
     * @return void
     */
    private function mediana($valor)
    {
        @$this->imagem->medianFilterImage($valor);
    }
}
