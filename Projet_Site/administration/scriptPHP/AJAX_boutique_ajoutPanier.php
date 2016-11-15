<?php
	session_start();
	include'../includes/panier_class.php';
	$resultat['data']='test';
	$panier=new panier;
	$test=$panier->verif();
	switch($test){
		case'Cookie&utilisateur&panier':
			$panier->convertCookie();
			$panier->addProduit();
			$resultat['data']= 'registeredOnBDD';
		break;
		case 'noCookie&utilisateur&panier':
			$panier->addProduit();
			$resultat['data']= 'registeredOnBDD';
		break;
		case 'Cookie&utlisteur&NoPanier':
			$panier->createPanier();
			$panier->convertCookie();
			$panier->addProduit();
			$resultat['data']= 'registeredOnBDD';
		break;
		case 'noCookie&utilisateur&noPanier':
			$panier->createPanier();
			$panier->addProduit();
			$resultat['data']= 'registeredOnBDD';
		break;
		case'cookie&noUtilistateur':
			$panier->updateCookie();
			$resultat['data']= 'registeredOnCookie';
		break;
		case 'noCookie&noUtilisateur':
			$panier->createCookie();
			$resultat['data']= 'registeredOnCookie';
		break;
		case 'noQuantite':
			$resultat['data']= $test;
		break;
	}
	echo json_encode($resultat);
?>