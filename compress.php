<?php
//Text Compression Algorithm (TCA)
//18.01.2015
//Author : Mert Gonul
//Github : https://github.com/mertgonul

//get tca algorithm 
include('tca.php');

//start new object
$se = new TCA();

//echo compressed letters
echo $crypt = $se->crypt('Text Compression Algorithm');
?>