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
     * Retorna o valor do nome da imagem.
     *
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Retorna os valores do histograma da imagem informada
     *
     * @return array
     */
    public function getHistogramaImagick($imagem = '')
    {
        if (! empty($image)) {
            $this->imagem = $image;
        }

        $image = new Imagick($this->imagem);
        $pixels = $image->getImageHistogram();

        $histPixeis = [];

        foreach ($pixels as $pixel) {
            $colors = $pixel->getColor();
            //$total = [$pixel->getColorCount()];
            foreach($colors as $index => $color){
                $histPixeis[$index][] = $color;
                //$histPixeis[$index] = $total;
            }
        }
        return $histPixeis;
    }

    /**
     * Retorna os valores do histograma da imagem informada
     *
     * @return array
     */
    public function getHistograma($imagem = '')
    {
        if (! empty($image)) {
            $this->imagem = $image;
        }

        $im = ImageCreateFromJpeg($this->imagem);
        // $im = ImageCreateFromPng($this->imagem);

        $imgw = imagesx($im);
        $imgh = imagesy($im);

        // n = total number or pixels
        $n = $imgw * $imgh;

        $histo = array();
        $item = new stdClass();

        for ($i=0; $i < $imgw; $i++) {
            for ($j=0; $j < $imgh; $j++) {
                // get the rgb value for current pixel
                $rgb = ImageColorAt($im, $i, $j);

                // extract each value for r, g, b
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // get the Value from the RGB value
                $V = round(($r + $g + $b) / 3);

                // add the point to the histogram
                $histo[$V] += $V / $n;
            }
        }

        ksort($histo);
        /*
        echo '<pre>';
        print_r($histo);
        echo '<hr>';
        print_r($histo);
        */

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

    /**
     * Retorna o nome do canal conforme $valor informado
     *
     * @param $valor
     * @return string
     */
    private function getNomeCanal($valor)
    {
        $canais = ['r' => 'Vermelhor', 'g' => 'Verde', 'b' => 'Azul', 'a' => 'Alpha'];

        return $canais[$valor];
    }
}
