<?php
//Text Compression Algorithm (TCA)
//18.01.2015
//Author : Mert Gonul
//Github : https://github.com/mertgonul

//get tca algorithm 
include('tca.php');

//start new object
$se = new TCA();

//first encode your letters and write your encoded letters here
echo $decrypt = $se->decrypt('WRITE YOUR COMPRESSED RESULTS');
?>