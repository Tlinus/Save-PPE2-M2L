<?php
 include("function.php"); 
 session_start(); ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="main.css">
		<meta charset="UTF-8"/>
		<title>Bienvenue!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_convertPanier.js"></script>
	</head>
	<body>
		<?php include("includes/menu_principal.php");?>
		<?php include("includes/menu_ligues.php"); ?>
		<a href="javascript:openPanier()"><img src="img/panier.png" alt="Mon panier" id="icone_panier"/></a>
		<nav id="panier">
			<p><a href="javascript:closePanier()"> X fermer</a></p>
<?php 
        $bdd = bdd();
        if(isset($_SESSION['id'])){
            $total=0;
           $query=$bdd->prepare('SELECT * FROM quantite
                                    INNER JOIN produit ON quantite.produit_id=produit.produit_id
                                    INNER JOIN panier ON quantite.session_id=panier.session_id
                                     INNER JOIN tva on produit.tva_id=tva.tva_id
                                    WHERE panier.utilisateur_id =:id');
            $query->execute(array('id'=>$_SESSION['id']));
            while($response=$query->fetch()){
                $total+=$response['prix_unitaire']*$response['nombre']*(1+$response['taux']/100);
            }
        }
									
?>
			<h1> Votre Panier  <?php if(isset($_SESSION['id']))echo round($total,2).' euros'; ?></h1>
			<ul id="produit_panier">
<?php
				
				if(isset($_SESSION['id'])AND !isset($_COOKIE['boutique'])){
					$query=$bdd->prepare('SELECT 
								produit.designation AS produit,
								quantite.nombre AS nombre,
								produit.produit_id AS ID
								FROM quantite 
								INNER JOIN panier ON quantite.session_id=panier.session_id
								INNER JOIN produit ON quantite.produit_id=produit.produit_id
								WHERE panier.utilisateur_id=:id');
					$query->execute(array('id'=>$_SESSION['id']));
					$reponse=$query->fetch();
					if(!isset($reponse['produit'])){
						echo ' Votre Panier est vide ';
					}
					else{
						do{				
	?>
								<li>
									<?php echo $reponse['produit'];?> * <?php echo $reponse['nombre'];?><a href="javascript:deleteProduitBDD('<?php echo $reponse['ID']?>')"><input type="button" id="Sup_prod_cookie" value="Supprimer"></a>
								</li>
	<?php
							}while($reponse=$query->fetch());
						}
					}
					else if(isset($_COOKIE['boutique']) AND !isset($_SESSION['id'])){
						$res=unserialize($_COOKIE['boutique']);
						for( $i=0;$i<count($res['produit']);$i++){
							$query=$bdd->prepare('SELECT * FROM produit WHERE produit_id= :id');
							$query->execute(array('id'=>$res['produit'][$i]));
							$result=$query->fetch();
							echo '<li>
										 '.$result['designation'].' * ' .$res['quantite'][$i].'<a href="javascript:deleteProduitCookie('.$res['produit'][$i].')"><input type="button" id="Sup_prod_cookie" value="Supprimer"></a>
								</li>';
						}
					}
					else if(isset($_COOKIE['boutique']) AND isset($_SESSION['id'])){
						?>
						<script>convertPanier();</script>
					<?php
						$bdd=bdd();
						$query=$bdd->prepare('SELECT 
								produit.designation AS produit,
								quantite.nombre AS nombre,
								produit.produit_id AS ID
								FROM quantite 
								INNER JOIN panier ON quantite.session_id=panier.session_id
								INNER JOIN produit ON quantite.produit_id=produit.produit_id
								WHERE panier.utilisateur_id=:id');
					$query->execute(array('id'=>$_SESSION['id']));
					$reponse=$query->fetch();
					if(!isset($reponse['produit'])){
						echo ' Votre Panier est vide ';
					}
					else{
						do{				
	?>
								<li>
									<?php echo $reponse['produit'];?> * <?php echo $reponse['nombre'];?><a href="javascript:deleteProduitBDD('<?php echo $reponse['ID']?>')"><input type="button" id="Sup_prod_cookie" value="Supprimer"></a>
								</li>
	<?php
							}while($reponse=$query->fetch());
						}
					}
					else{
						echo ' Votre Panier est vide ';
					}
?>
				</ul>
				<a href="validationPanier.php"><input type="button" id="voir_Panier" value="Voir le panier"></a>
			</nav>
		<section id="boutique">
			<nav id="categorie">
				<ul>
					<?php 
						$bdd=bdd();
						$res = $bdd->query('SELECT label FROM categorie');
						while($donnee=$res->fetch()){	
					?>
						<a href="javascript:changeCat('<?php echo utf8_encode($donnee['label'])?>')">
							<li>
								<?php echo utf8_encode("$donnee[label]"); ?>
							</li>
						</a>
					<?php
						}
					?>
				</ul>	
			</nav>

			<section id="content">
					<?php 
						$res2 = $bdd->query('SELECT photo.url AS URL,designation,prix_unitaire,produit_id,description,tva.tva_id AS TVA 
											FROM produit 
											INNER JOIN tva ON produit.tva_id=tva.tva_id
											INNER JOIN photo ON produit.produit_id=photo.id_produit
											');
						while($donnee2=$res2->fetch()){
					?>	
					<div id="produit" >
						<h1> <?php echo "$donnee2[designation]";?></h1>
						<img src="<?php echo "$donnee2[URL]"; ?>"/>
						<div id="description">
							<p>
								Prix: <?php echo "$donnee2[prix_unitaire]";?>€<br/>
							</p>
								<a href="javascript:preview(<?php echo $donnee2['produit_id']?>)"><input type="button" id="submit_commande" value="Voir détails"/></a>
						</div>
					</div>
					<?php
						}
					?>
			</section>
		</section>
		<section id="preview_screen">
			<div id="preview">
			</div>
		</section>
		<script type="text/javascript" src="JQuery/AJAX_boutique.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_produit_preview.js" ></script>
		<script type="text/javascript" src="JQuery/AJAX_AjoutPanier.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_DeletePanier.js"></script>
		<script type="text/javascript" src="JQuery/gestionDivPanier.js"></script>
	</body>
</html>