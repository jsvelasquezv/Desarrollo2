<?php
	/**
	* 
	*/
	require '../libs/rb.php';

	R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');

	$hola = R::dispense( 'hola' );
	$hola->title = 'Learn to Program';
    $hola->rating = 10;
    R::store($hola);
?>