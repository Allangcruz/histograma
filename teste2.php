<?php

$image = new Imagick("001.jpg");

$pixels=$image->getImageHistogram();

echo '<pre>';

foreach($pixels as $p){
	$colors = $p->getColor();
	foreach($colors as $c){
        print( "$c\t" );
	}
	print( "\t:\t" . $p->getColorCount() . "\n" );
}