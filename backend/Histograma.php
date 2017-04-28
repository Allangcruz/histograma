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
    public function getHistograma($imagem = '')
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
     * Retorna os valores formatados para colocar no Grafico
     *
     * @return array
     */
    public function getValoresIndicador()
    {
        $canais = ['Vermelhor', 'Verde', 'Azul', 'Alpha'];
        $canais = $this->getHistograma();
        $histogramas = [];

        foreach ($canais as $index => $canal) {
            $item = new stdClass();
            $item->name = $this->getNomeCanal($index);
            $item->data = $canal;

            $histogramas[] = $item;
        }

        return $histogramas;
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
