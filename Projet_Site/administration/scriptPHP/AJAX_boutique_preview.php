<?php
	include '../function.php';
	$bdd=bdd();
	$requete=$bdd->prepare('SELECT * FROM produit 
							INNER JOIN photo ON produit.produit_id=photo.id_produit
							WHERE produit.produit_id=:produit_id');
	$requete->execute(array('produit_id'=>$_POST['donnee']));
	$retour=$requete->fetch();
	$retour['designation']=utf8_encode($retour['designation']);
	$retour['description']=utf8_encode($retour['description']);
	$retour[2]=utf8_encode($retour[2]);
	$retour[1]=utf8_encode($retour[1]);
	echo json_encode($retour);
?>