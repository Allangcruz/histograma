<?php

class Histograma
{
    private $imagem;

    /**
     * Seta o valor da localização da da imagem
     */
    public function setImagem($imagem = '')
    {
        $this->imagem = $imagem;
    }

    /**
     * Retorna os valores do histograma da imagem informada
     *
     * @return array
     */
    public function getHistogramaImagick($imagem = '')
    {
        $image = new Imagick($this->imagem);
        $pixels = $image->getImageHistogram();

        $histPixeis = [];

        foreach ($pixels as $pixel) {
            $colors = $pixel->getColor();
            foreach($colors as $index => $color){
                $histPixeis[$index][] = $color;
            }
        }
        return $histPixeis;
    }

    /**
     * Cria imagem conforme extenção do arquivo.
     *
     * @param $arquivo
     * @return imagem
     */
    private function criaImagemPorExtensao($arquivo)
    {
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $arquivo = realpath($arquivo['tmp_name']);


        if ($extensao == 'jpeg' || $extensao == 'jpg') {
           $imagem = imagecreatefromjpeg($arquivo);
        }

        if ($extensao == 'png') {
            $imagem = imagecreatefrompng($arquivo);
        }

        if ($extensao == 'gif') {
            $imagem = imagecreatefromgif($arquivo);
        }
        return $imagem;
    }

    /**
     * Retorna os valores do histograma da imagem informada
     *
     * @param $dados
     * @return array
     */
    public function getHistograma($dados)
    {
        $imagem = $this->criaImagemPorExtensao($dados->arquivo);

        $imgw = imagesx($imagem);
        $imgh = imagesy($imagem);

        // n = total number or pixels
        $n = $imgw * $imgh;

        $histo = array();
        $item = new stdClass();

        for ($i=0; $i < $imgw; $i++) {
            for ($j=0; $j < $imgh; $j++) {
                // get the rgb value for current pixel
                $rgb = ImageColorAt($imagem, $i, $j);

                // extract each value for r, g, b
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // get the Value from the RGB value
                $valor = round(($r + $g + $b) / 3);

                // add the point to the histogram
                $histo[$valor] += $valor / $n;
            }
        }

        ksort($histo);

        foreach ($histo as $key => $value) {
            $item->x[] = $key;
            $item->y[] = $value;
        }

        return $item;
    }

    /**
     * Retorna os valores formatados para colocar no Grafico
     *
     * @return array
     */
    public function getValoresIndicador($dados)
    {
        $histograma = new stdClass();
        $histograma->name = 'Tons de Cinza';
        $histograma->data = $this->getHistograma($dados);

        return $histograma;
    }

    /**
     * Retorna os valores formatados para colocar no Grafico
     *
     * @return array
     */
    public function getValoresIndicadorFiltrado()
    {
        $histograma = new stdClass();
        $histograma->name = 'Tons de Cinza';
        $histograma->data = $this->getHistogramaFiltrado();

        return $histograma;
    }

    /**
     * Retorna os valores do histograma da imagem informada
     *
     * @param $dados
     * @return array
     */
    public function getHistogramaFiltrado()
    {
        $imagem = imagecreatefrompng('../assets/imgs/imagem-filtrada.png');

        $imgw = imagesx($imagem);
        $imgh = imagesy($imagem);

        // n = total number or pixels
        $n = $imgw * $imgh;

        $histo = array();
        $item = new stdClass();

        for ($i=0; $i < $imgw; $i++) {
            for ($j=0; $j < $imgh; $j++) {
                // get the rgb value for current pixel
                $rgb = ImageColorAt($imagem, $i, $j);

                // extract each value for r, g, b
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // get the Value from the RGB value
                $valor = round(($r + $g + $b) / 3);

                // add the point to the histogram
                $histo[$valor] += $valor / $n;
            }
        }

        ksort($histo);

        foreach ($histo as $key => $value) {
            $item->x[] = $key;
            $item->y[] = $value;
        }

        return $item;
    }
}
