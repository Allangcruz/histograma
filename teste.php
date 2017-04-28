<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

$source_file = "assets/imgs/003.jpg";

// histogram options
$maxheight = 300;
$barwidth = 5;

$im = ImageCreateFromJpeg($source_file);
//$im = ImageCreateFromPng($source_file);

$imgw = imagesx($im);
$imgh = imagesy($im);

// n = total number or pixels
$n = $imgw*$imgh;

$histo = array();
$itens = array();

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

// find the maximum in the histogram in order to display a normated graph
$max = 0;
for ($i=0; $i<255; $i++) {
    if ($histo[$i] > $max) {
        $max = $histo[$i];
    }
}

foreach ($histo as $key => $value) {
    $key  .' - '.$value.'<br>';
    $itens['x'][] = $key;
    $itens['y'][] = $value;
}

/*
for ($i=0; $i<255; $i++) {
    $val += $histo[$i];
    $h = ($histo[$i]/$max)*$maxheight;
    echo '<img src="img.gif" width="'.$barwidth.'" height="'.$h.'" border="0">';
}
*/

echo '<pre>';
print_r('largura: '.$imgw);
echo '<br>';
print_r('altura: '.$imgh);
echo '<br>';
print_r('numero total de pixel: '.$n);
echo '<br>';
print_r('maximo: '.(256*$barwidth));
echo '<br>';
print_r('width: '.$max);
echo '<br>';

print_r($itens);

die();

echo "<div style='width: ".(256*$barwidth)."px; border: 1px solid'>";
for ($i=0; $i<255; $i++) {
    $val += $histo[$i];
    $h = ( $histo[$i]/$max )*$maxheight;
    echo '<img src="img.gif" width="'.$barwidth.'" height="'.$h.'" border="0">';
}
echo "</div>";

