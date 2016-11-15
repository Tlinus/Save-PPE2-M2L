<?php
$titre = 'Inscription';
	include 'includes/head.php';
	include 'includes/inscription_class.php';
	//include 'function.php';
	$bdd = bdd();
	
	// on verifie si on a un formulaire qui nous est retourné (au complet ^^)
	if(isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['mdp']) AND  isset($_POST['mdp2']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['numvoie']) AND isset($_POST['voie']) AND isset($_POST['ville']) AND isset($_POST['postal']) AND isset($_POST['genre']))
		{	// Si on a un formulaire remplie on envoie à la class
			$inscription = new inscription($_POST['pseudo'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'],$_POST['nom'],$_POST['prenom'],$_POST['numvoie'],$_POST['voie'],$_POST['ville'],$_POST['postal'],$_POST['genre']);
			// on va verifier les syntaxes correspondances etc... (voir la fonction)
			$verif = $inscription->verif();
			// si tout est bon au niveau des syntaxes...
			// BIG BONUS ->>>> ATTENTION! pour l'instant on ne vérifie pas si les pseudos  et e-mail entrés sont en conflits avec des données déjà existentes....
			if($verif  == "ok")
				{echo 'compris!'; // non affiché, uniquement pour les etapes de dev... 
					//on verifie que les données sont stocker sur la bdd
					if($inscription->enregistrement())
						{echo 'tout est bon pour l\'enregistrement';// non affiché, uniquement pour les etapes de dev... 
							// on verifie aussi que la session à bien démarré
							if($inscription->session())
								{	
									echo 'compris session ok!'; // non affiché, uniquement pour les etapes de dev... 
									header('Location: indexforum.php'); // on renvoie à la page index (plus tard on pourrai imaginer renvoyer l'utilisateur sur la page qu'il visitait avant de s'inscrire, à voir...)
								}
							else{echo'vos données n\'ont pas été enregistré correctement, veuillez réessayer ultérieurement ou contactez nous!';}
						}
						else 
						{
							echo 'une erreur est survenue lors de l\'enregistrement';
						}
					}
				
		else
			{
			// si les données entrées ne sont pas correctes on enregistre le message d'erreur dans la variable $erreur
			$erreur = $verif; 
			}
		}
	
	
				
		
	?>
	<body>
		<div id="box">
		<h1>Bienvenue</h1>
		<form method="post" action="inscription.php">
			<table id="tableInscription">
					
					<tr>
						<td>Identifiant: </td>
					</tr>
					<tr>
						<td><input name="pseudo" type="text" placeholder="Pseudo..." required /></td>
					</tr>
					
					<tr>			
						<td>Votre e-mail: </td>
					</tr>
					<tr>
						<td><input name="email" type="email" placeholder="Adresse email..." required /></td>
					</tr>
					<tr>
						<td>Mot de passe: </td>
					</tr>
					<tr>
						<td><input type="password" name="mdp" placeholder="Mot de passe ..." required /></td>
					</tr>
					
					<tr>
						<td>Veuillez confirmer votre mot de passe: </td>
					</tr>
					<tr>
						<td><input type="password" name="mdp2" placeholder="Confirmation  ..." required /></td>
					</tr>
					<tr>
						<td>Votre Nom : </td>
					</tr>
					<tr>
						<td><input type="text" name="nom" placeholder="Votre Nom..." required /></td>
					</tr>
					<tr>
						<td>Votre Prenom</td>
					</tr>
					<tr>
						<td><input type="text" name="prenom" placeholder="Votre Prenom..." required /></td>
					</tr>
				<tr>
						<td> Numéros de voie </td>
					</tr>
					<tr>
						<td><input type="text" name="numvoie" placeholder="1" required /></td>
					</tr>
						<td>Nom de Voie </td>
					</tr>
					<tr>
						<td><input type="text" name="voie" placeholder="Rue de Lorraine" required /></td>
					</tr>
						<td>Ville </td>
					</tr>
					<tr>
						<td><input type="text" name="ville" placeholder="Votre ville" required /></td>
					</tr>
						<td>Votre Code Postale</td>
					</tr>
					<tr>
						<td><input type="text" name="postal" placeholder="Code Postal" required /></td>
					</tr>	
						<td>Votre genre</td>
					</tr>
					<tr>
						<td>
							<input type="radio" name="genre" value="homme" >homme 	
							<input type="radio" name="genre" value="femme" >femme
							<input type="radio" name="genre" value="asséxué" >asséxué
							<input type="radio" name="genre" value="transgenre" >transgenre
						</td>
					</tr>
				</table>
					<input id="inscription" type="submit" value="S'inscrire!"  /> <br>
		</form>
				<?php 
					if(isset($erreur))
						{
							// si on à un message d'erreur suite à une mauvaise saisie on l'affiche
							// BONUS va comprendre pourquoi ça clignote pas -_-' HTMML CSS, rien n'y fait/...
						echo '<p id="error"><BLINK>' .$erreur. '</BLINK></p>';
						}
					else
						{
							
						}
				?>
				<!-- au cas où il y aurait eu une mauvaise direction on propose au visiteur si il a déja un compte de s'authentifier... -->
			<p> déja inscrit? <a href="connexion.php" > Connexion</a> </p>
		</div>

	</body>
	
</html>