<?php
	session_start();
	if(isset($_SESSION['isAdmin'])){
?>
		<html>
			<head>
				<meta charset="UTF-8"/>
				<title>Administration</title>
				<link rel="stylesheet" type="text/css" href="main.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script src="jQuery/AJAX_RechAdmin.js"></script>
				<script>
					function getData(){
						$('#aj_art_m2l_contenu').val(CKEDITOR.instances.aj_art_m2l_contenu.getData());
					}
				</script>
			</head>
			<body>
			 <?php
				include("includes/menu_principal.php");
				include("includes/menu_ligues.php"); 
			?>
				<h1 class="titrepage"> Administration</h1>
				<section id="wrapper_rec_adm">
				<h1> Rechercher  ID </h1>
				<ul id="option_rec_adm">
					<li> Utilisateur:<input type="radio" name="rec_adm" id="rec_adm" value="user"/></li>
					<li> Forum:<input type="radio" name="rec_adm" id="rec_adm" value="forum"/></li>
					<li> Sujet:<input type="radio" name="rec_adm" id="rec_adm" value="sujet"/></li>
					<li> Message:<input type="radio" name="rec_adm" id="rec_adm" value="message"/></li>
					<li> Produit:<input type="radio" name="rec_adm" id="rec_adm" value="produit"/></li>
					<li> TVA:<input type="radio" name="rec_adm" id="rec_adm" value="tva"/></li>
					<li> Categorie:<input type="radio" name="rec_adm" id="rec_adm" value="categorie"/></li>
					<li> Article:<input type="radio" name="rec_adm" id="rec_adm" value="article"/></li>
				</ul>
				<p class="administration">
				Veuillez entrer les premières lettres correspondantes à votre recherche: <input type="text" id="text_rech" />
				<a href="javascript:recherche_admin()"><input type="button" id="rech_submit" value="Lancer la recherche"/></a>
				</p>
				
				<div id="result_rech">
						<center><table id="resultat" >
						</table></center>
					</div>
				</section>
				<form method="post" action="scriptPHP/Admin_query.php">
				<section id="admin_sec" class="correction">
				<h1>Forums</h1>
				<div id="sous_sec_adm">
				<h3>Supprimer un sujet:</h3>
				<table>
					<tr>
						<td>Sujet ID:</td><td><input type="textarea" id="sup_suj" name="sup_suj" /></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Supprimer un message:</h3>
					
				<table>
					<tr>
						<td> Message ID:</td><td><input type="textarea" id="sup_msg_id" name="sup_msg_id" /></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
					<h3>Supprimer un Forum:</h3>
				<table>
					<tr>
						<td>Forum ID:</td><td><input type="textarea" id="sup_for" name="sup_for" /></td>
					</tr>
				</table>
				</div>
				<input type="submit" id="submit_admin" value="Envoyer"/>
				</section>
					
				
				<section id="admin_sec">
				<h1> Boutique </h1>
				<div id="sous_sec_adm">
				<h3>Supprimer un article:</h3>
				<table>
					<tr>
						<td>Article ID:</td><td><input type="textarea" id="sup_art_id" name="sup_art_id"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Ajouter une catégorie:</h3>
				<table>
					<tr>
						<td>Nom:</td><td><input type="textarea" id="aj_cat_nom" name="aj_cat_nom"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Supprimer une catégorie:</h3>
				<table>
					<tr>
						<td>Catégorie ID:</td><td><input type="textarea" id="sup_cat_id" name="sup_cat_id"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Créer une TVA</h3>
				<table>
					<tr>
						<td>Taux:</td><td><input type="textarea" id="aj_tva" name="aj_tva"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Supprimer une TVA</h3>
				<table>
					<tr>
						<td>ID:</td><td><input type="textarea" id="sup_tva" name="sup_tva"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Editer une TVA</h3>
				<table>
					<tr>
						<td>ID:</td><td><input type="textarea" id="ed_tva_id" name="ed_tva_id"/></td>
					</tr>
					<tr>
						<td>Nouvelle valeur:</td><td><input type="textarea" id="ed_tva_val" name="ed_tva_val"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Ajouter un article:</h3>
				<table>
					<tr>
						<td>Categorie:</td><td><input type="textarea" id="aj_art_cat" name="aj_art_cat"/></td>
					</tr>
					<tr>
						<td>Nom:</td><td><input type="textarea" id="aj_art_nom" name="aj_art_nom"/></td>
					</tr>
					<tr>
						<td>Description:</td><td><input type="textarea" id="aj_art_desc" name="aj_art_desc"/></td>
					</tr>
					<tr>
						<td>Prix Unitaire:</td><td><input type="textarea" id="aj_art_prix" name="aj_art_prix"/></td>
					</tr>
					<tr>
						<td>URL photo:</td><td><input type="textarea" id="aj_art_url" name="aj_art_url"/></td>
					</tr>
					<tr>
						<td>TVA:</td><td><input type="textarea" id="aj_art_tva" name="aj_art_tva"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Editer un article:</h3>
				<table>
					<tr>
						<td>Article ID:</td><td><input type="textarea" id="ed_art_id" name="ed_art_id"/></td>
					</tr>
					<tr>
						<td>Nom:</td><td><input type="textarea" id="ed_art_nom" name="ed_art_nom"/></td>
					</tr>
					<tr>
						<td>Catégorie ID:</td><td><input type="textarea" id="ed_art_cat" name="ed_art_cat"/></td>
					</tr>
					<tr>
						<td>TVA ID:</td><td><input type="textarea" id="ed_art_tva" name="ed_art_tva"/></td>
					</tr>
					<tr>
						<td>Description:</td><td><input type="textarea" id="ed_art_desc" name="ed_art_desc"/></td>
					</tr>
					<tr>
						<td>Prix Unitaire HT:</td><td><input type="textarea" id="ed_art_prix" name="ed_art_prix"/></td>
					</tr>
					<tr>
						<td>URL Photo:</td><td><input type="textarea" id="ed_art_url" name="ed_art_url"/></td>
					</tr>
					<br/>
				</table>
				</div>
				<input type="submit" id="submit_admin" value="Envoyer"/>
				</section>
				<section id="admin_sec">
				<div id="sous_sec_adm">
				<h1>Utilisateurs:</h1>
				<h3>Promouvoir un utilisateur au rôle d'administrateur:</h3>
				<table>
					<tr>
						<td> ID utilisateur :</td><td><input type="textarea" id="prom_ut" name="prom_ut"/></td>
					</tr>
				</table>
				</div>
				<div id="sous_sec_adm">
				<h3>Supprimer un utilisateur :</h3>
				<table>
					<tr>
						<td> ID utilisateur:</td><td><input type="textarea" id="sup_ut" name="sup_ut"/></td>
					</tr>
				</table>
				</div>
				<input type="submit" id="submit_admin" value="Envoyer"/>
				</section>
				<section id="admin_sec" class="article_admin">
					<h1>Articles de la M2L:</h1>
					<div id="sous_sec_adm"  class="article_admin">
						<h3>Ajouter un Article:</h3>
						<table>
							<tr>
								<td> Titre :</td><td><input type="textarea" id="aj_art_m2l_titre" name="aj_art_m2l_titre"/></td>
							</tr>
							<tr>
									<td> Contenu :</td><td><input type="textarea" id="aj_art_m2l_contenu" name="aj_art_m2l_contenu"/></td>
									<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
									<script type="text/javascript">
										CKEDITOR.replace('aj_art_m2l_contenu');
									</script>
							</tr>
							<tr>
								<td> nom fichier photo:</td><td><input type="textarea" id="aj_art_m2l_photo" name="aj_art_m2l_photo"/></td>
							</tr>
							<tr>
								<td> extrait:</td><td><input type="textarea" id="aj_art_m2l_ext" name="aj_art_m2l_ext"/></td>
							</tr>
							<input type="hidden" id="aut_art_m2l_id" name="aut_art_m2l_id" value="<?php echo $_SESSION['id'];?>"/>
						</table>
					</div>
					<div id="sous_sec_adm">
						<h3>Supprimer un article:</h3>
						<table>
							<tr>
								<td> Aricle ID:</td><td><input type="textarea" id="sup_art_m2l" name="sup_art_m2l"/></td>
							</tr>
						</table>
					</div>
					<input type="submit" id="submit_admin" value="Envoyer" onclick="getData()"/>
				</section>
				</form>
			</body>
			
		</html>
<?php		
	}
	else{
		echo'Vous ne disposez pas des droits administrateurs';
	}
?>