<?php 
	$titre= 'Ajouter un nouveau sujet';
	
	
	include 'includes/head.php';
	include 'includes/addSujet_class.php';
	
	$bdd = bdd();
	
	if (isset($_POST['titre']) AND isset($_POST['contenu']))
		{
			$addSujet = new addSujet($_POST['titre'],$_POST['contenu'], $_POST['forum']);
			$verif = $addSujet->verif();
			// si tout est bon
			if($verif == 'ok')
				{
					if($addSujet->insert())
						{
							header('Location: indexforum.php?forum='.$_POST['forum']);
						}
				}
			else
				{ // si on a une erreur
					$erreur =$verif;
				}
		}
	?>
	
		<div id="box">
			<h1>Ajouter un sujet </h1>
				<?php echo '<h2>Bienvenue ' .$_SESSION['pseudo']. '</h2><a href="deconnexion.php"> Deconnexion</a><br><br><br>'; ?>
				<form method="post" action="addSujet.php?forum=<?php echo $_GET['forum']; ?>">
					<p>
						<input type="text" name="titre" plceholder="Nom du sujet ... " required/><br>
						<textarea name="contenu" placeholder="Votre message" > </textarea><br>
						<input type="hidden" name="forum" value= "<?php echo $_GET['forum']; ?>">
						<input type="submit" value="Envoyer!"  /> <br>
					</p>
						<?php 
							if(isset($erreur))
								{
									echo $erreur;
								}
						?>
				</form> 
			</div>		
					
	</body>

</html>