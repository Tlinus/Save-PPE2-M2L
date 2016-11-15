<?php
	session_start();
	include 'function.php';
	include("includes/menu_principal.php");
	include("includes/menu_ligues.php"); 
?>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<?php
	echo '<section id="recapanier">';
	if(isset($_SESSION['id'])){
		$bdd=bdd();
		$i=0;
		$commande=array();
		$query=$bdd->query('SELECT produit.designation AS designation,
									produit.produit_id AS produit_id,
									quantite.nombre AS nombre,
									produit.description AS description
									FROM quantite
									INNER JOIN produit ON quantite.produit_id = produit.produit_id
									INNER JOIN panier ON quantite.session_id = panier.session_id
									WHERE panier.utilisateur_id='.$_SESSION['id'].'');
									
		while($reponse=$query->fetch()){
			$prix=getPrix($reponse['produit_id']);
			$commande[$i]['designation']=$reponse['designation'];
			$commande[$i]['nombre']=$reponse['nombre'];
			$commande[$i]['description']=$reponse['description'];
			$commande[$i]['prix_TTC']=$prix['prix_TTC'];
			$commande[$i]['prix_HT']=$prix['prix_HT'];
			$commande[$i]['totHT']=$prix['prix_HT']*$reponse['nombre'];
			$commande[$i]['totTTC']=$prix['prix_TTC']*$reponse['nombre'];
			$i++;
		}
		$i=0;
		if(isset($commande[$i])){
			$total_TTC=0;
			$total_HT=0;
			while(isset($commande[$i])){
				$total_TTC=$total_TTC+$commande[$i]['prix_TTC']*$commande[$i]['nombre'];	
				$i++;
			}
			$i=0;
			while(isset($commande[$i])){
				$total_HT=$total_HT+$commande[$i]['prix_HT']*$commande[$i]['nombre'];
				$i++;
			}
			$coutTaxe=$total_TTC-$total_HT;
			echo '
			<h1> Votre commande</h1>
			<div id="recap_sousec">
			<table class="tab_commande"><caption> Récapitulatif des articles sélectionnés</caption>
			<tr><td>Article</td><td>Description</td><td>Quantité</td><td>Prix unitaire HT</td><td>Prix unitaire TTC </td><td>Total HT</td><td>Total TTC</td></tr>';
			for($i=0;isset($commande[$i]);$i++){
				echo '<tr><td>'.$commande[$i]['designation'].'</td><td>'.$commande[$i]['description'].'</td><td>'.$commande[$i]['nombre'].'</td><td>'.$commande[$i]['prix_HT'].'€</td><td>'.$commande[$i]['prix_TTC'].'€</td><td>'.$commande[$i]['totHT'].'€</td><td>'.$commande[$i]['totTTC'].'€</td></tr>';
			}
			echo '</table>';
			echo'<table class="tab_commande"><caption>Coût total de votre commande</caption>
				<tr><td>Total Hors Taxes </td><td>'.$total_HT.'€</td></tr>
				<tr><td>Total Toutes Taxes Comprises </td><td>'.$total_TTC.'€</td></tr>
				<tr><td>Coût des taxes </td><td>'.$coutTaxe.'€</td></tr>
			</table>
			</div>';
		}
		else{
			echo 'Votre panier est vide.';
		}
		echo 'Veuillez vérifier vos données personelles';
		$query_utilisateur=$bdd->query('SELECT * FROM utilisateur WHERE utilisateur_id='.$_SESSION['id'].'');
		$result=$query_utilisateur->fetch();
		echo'
			<div id="recap_sousec">
			<table class="tab_commande"><caption>Vos données personelles</caption>
			<tr><td>Nom</td><td>'.$result['Nom'].'</td></tr>
			<tr><td>Prénom</td><td>'.$result['Prenom'].'</td></tr>
			<tr><td>Adresse</td><td>'.$result['adresse'].'</td></tr>
			<tr><td>E-mail</td><td>'.$result['mail'].'</td></tr>
			<tr><td colspan=2><a href="modifierProfil.php"><input type="button" value="modifier"/></a></td></tr>
			</table>
			<a href="paiment.php"><input type="button" id="valider_commande" value="Valider la commande"/></a>
			</div>
			</section>';
	}
	else{
		echo '<script>alert("  Veuillez vous enregistrer pour valider votre commande.");
				window.location = \'boutique.php\';</script>';
	}
	
	function getPrix($produit_id){
		$bdd=bdd();
		$query2=$bdd->query('SELECT produit.prix_unitaire*(1+tva.taux/100) AS prix_TTC,
									produit.prix_unitaire AS prix_HT
									FROM produit
									INNER JOIN tva ON tva.tva_id=produit.tva_id
									WHERE produit_id='.$produit_id.'');
		$result=$query2->fetch();
		return $result;
	}

?>