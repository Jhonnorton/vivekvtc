<?php


$prodaction = false;

function dd($object = NULL){

	$debug = true;

	if(!$debug) return;

	echo '<pre>';
	var_dump($object);
	echo '</pre>';

}

function d($object = NULL){

	dd($object);
	die('__END__');

}

function ci($class){

	dd(get_class($class));
	dd(get_class_methods($class));
	d();

}