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
     * @param $dados
     * @return imagem
     */
    private function criaImagemPorExtensao($dados)
    {
        if () {

        }

        if () {

        }

        if () {

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
        $imagem = $this->criaImagemPorExtensao($dados);

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
    public function getValoresIndicador()
    {
        $histograma = new stdClass();
        $histograma->name = 'Tons de Cinza';
        $histograma->data = $this->getHistograma();

        return $histograma;
    }
}
