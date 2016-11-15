<?php
	session_start();
	include'../includes/panier_class.php';
	$panier=new panier;
	$test=$panier->verif2();
	switch($test){
		case'Cookie&utilisateur&panier':
			$panier->convertCookie();
			$resultat['data']= 'registeredOnBDD';
		break;
		case 'Cookie&utlisteur&NoPanier':
			$panier->createPanier();
			$panier->convertCookie();
			$resultat['data']= 'registeredOnBDD';
		break;
	}
?>