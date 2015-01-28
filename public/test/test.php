<?php

require_once '../functions/debug.php';

class A{
	
	public $a = 1;
	protected $b =2;
	private $c =3; 
	
}

class B extends  A{
	
}



$class = new B;

//echo ci $class;