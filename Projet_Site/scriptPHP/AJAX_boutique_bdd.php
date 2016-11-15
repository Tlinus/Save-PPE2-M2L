<?php
	include '../function.php';
	$bdd=bdd();
	$requete = $bdd->prepare('SELECT designation,description,prix_unitaire,photo.url AS url_photo,produit.produit_id AS prodid
								FROM produit 
								INNER JOIN categorie ON categorie.categorie_id=produit.categorie_id
								INNER JOIN photo ON photo.id_produit=produit.produit_id
								WHERE label=:objet');
	$requete->execute(array('objet'=>$_POST['req']));
		for($i=0;$retour=$requete->fetch();$i++){
			$table_data[$i]=array('designation'=>utf8_encode($retour['designation']),'description'=>utf8_encode($retour['description']),'prix_unitaire'=>$retour['prix_unitaire'],'url_photo'=>$retour['url_photo'],'produit_id'=>$retour['prodid']);
		}
		echo json_encode($table_data);
?>