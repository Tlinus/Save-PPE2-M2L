<?php session_start(); ?>
<?php include("function.php"); ?>
<?php include("includes/menu_principal.php");?>
<?php include("includes/menu_ligues.php"); ?>
<?php include("includes/monProfil_class.php"); ?>

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title> Modifier mon Profil </title>
		<link rel="stylesheet" href="main.css">
	</head>
	<body>
	<?php 
		if(isset($_SESSION['pseudo']) && isset($_SESSION['mail']) && isset($_SESSION['id']))
		{
	?>
		<div id="monProfil">
			<h3> Votre configuration </h3>
	<?php 		$class= new monProfil($_SESSION['pseudo'],$_SESSION['mail'],$_SESSION['id']); 
				$donnees=$class->donneesProfil();
	?>
	<?php 
			if (isset($_POST['Nom']) OR isset($_POST['Prenom']) OR isset($_POST['age']))
				{
					$change= new modifierProfil($_SESSION['pseudo'],$_SESSION['mail'],$_SESSION['id']);
					function verif($verif)
					{
						if($verif== 'ok')
						{
							header('Location: modifierProfil.php');
						}
						else
						{
							$warning=$verif;
							header('Location: modifierProfil.php?verif='.$warning);
						}
					}

					if(isset($_POST['Nom']))
						{
							$verif=$change->profilNom($_POST['Nom']);
							verif($verif);
						}
					if(isset($_POST['Prenom']))
						{
							$verif=$change->profilPrenom($_POST['Prenom']);
							verif($verif);

						}
					if(isset($_POST['age']))
						{
							$verif=$change->profilAge($_POST['age']);
							verif($verif);
						}
					if(isset($_POST['adresse']))
						{
							$verif=$change->profilAdresse($_POST['adresse']);
							verif($verif);
						}
				}
				else
				{
					if(isset($_GET['verif']))
					{
						$warning = $_GET["verif"];
						if($warning =='Votre prénom doit contenir entre 4 et 40 caracteres alphabétiques'|| $warning=='Votre nom doit contenir entre 4 et 40 caracteres'|| $warning=='Veuillez entrer un âge compris entre 5 et 129 ans'|| $warning=='Veuillez entrer votre âge uniquement avec des chiffres' )
						{
							$warning = $_GET["verif"];
							echo $warning;
						}
						

					else{
						echo('error');
						}
					}

			?>
				<table>
					<tr>
						<td>Votre e-mail: </td><td class="modif"><?php if(isset($donnees['mail'])){echo($donnees['mail']);}else{echo('Non renseigné');} ?></td>
						<td>Votre Pseudo: </td><td class="modif"><?php if(isset($donnees['pseudo'])){echo($donnees['pseudo']);}else{echo('Non renseigné');} ?></td>
						<td>Votre Ligue de références: </td><td class="modif"><?php if(isset($donnees['ligue_id'])){echo($donnees['ligue_id']);}else{echo('Non renseigné');} ?></td>
					</tr>
					<tr>
						<form method="post" action="modifierProfil.php">
							<td>Votre nom: </td><td class="modif"><input name="Nom" type="text" placeholder="<?php if(isset($donnees['Nom'])){echo($donnees['Nom']);}else{echo('Non renseigné');} ?>"></td><td><input type="submit"   class="button4" value="Modifier mon nom"></a></td>
						</form>
						<form method="post" action="modifierProfil.php">
							<td>Votre prenom: </td><td class="modif"><input name="Prenom" type="text" placeholder="<?php if(isset($donnees['Prenom'])){echo($donnees['Prenom']);}else{echo('Non renseigné');}?>"></td><td><input type="submit"   class="button4" value="Modifier mon prenom"></a></td>
						</form>
					</tr>
					<tr>
						<form method="post" action="modifierProfil.php">
							<td>Votre age: </td><td class="modif"><input name="age" type="text" placeholder="<?php if(isset($donnees['age'])){echo($donnees['age']);}else{echo('Non renseigné');} ?>"></td><td><input type="submit"  class="button4" value="Modifier mon age"></a></td>
						</form>
						<form method="post" action="modifierProfil.php">
							<td>Votre adresse: </td><td class="modif"><input name="adresse" type="text" placeholder="<?php if(isset($donnees['adresse'])){echo($donnees['adresse']);}else{echo('Non renseigné');} ?>"></td><td><input type="submit"   class="button4" value="Modifier mon adresse"></a></td>
						</form>
					</tr>
				</table>
		<?php 
				}
		}
		else
		{
	?>
			<span id="error">Vous devez être connecter pour afficher cette page. Si vous rencontrez des problemes de avec votre compte vous pouvez consulter la rubrique <a href="faq.php"> Foire Aux Questions</a>;
								Si vos problemes persistent merci de nous <a href="contact.php" > contacter .</a>
			</span>
	<?php
		}
	?>
		</div>
	</body>
</html>