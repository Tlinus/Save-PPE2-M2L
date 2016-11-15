<header>
	<nav id="menu_top">
		<ul class="niveau1">
			<li><a href="lam2l.php">La M2L</a></li>
			<li><a href="boutique.php">Boutique</a></li>
			<li><a href="indexforum.php">Forum</a></li>
			<li><a href="index.php"><img src="img/menu_img.png"/><span> Acceuil </span></a></li>
			<li><a href="indexTchat.php">Chat</a></li>
			<li><a href="faq.php">FAQ</a></li>
			<?php
			 if (isset($_SESSION['id'])) // Si l'utilisateur est loger 
				{ //on affiche un lien de deconnexion dans le menu principal
					?>	

						<li  id="login" >Mon compte
							<ul class="niveau2">
								<li><a href="deconnexion.php"> Deconnexion</a></li>
								<li><a href="monProfil.php"> Mon profil </a></li>
								<?php if(isset($_SESSION['isAdmin'])){
                                            echo '<li><a href="index.php"> Administration</a></li>';
                                            echo '<li><a href="../index.php"> Retour au site</a></li>';
                                        }
								?>
							</ul> 
						</li>
					<?php
				}	
			 else
			 	{ //Sinon on lui propose de se loger via un formulaire de connexion
			 		?>
						<li id="login" >Login
							<ul class="niveau2">
								<form id="login" method="post" action=" <?php $path = $_SERVER['PHP_SELF']; $file = basename ($path);echo"$file"; // ces 3 dernieres commandes servent à renvoyer le formulaire sur la page qui etait afficher juste avant le try login ?> ">
									<li>Login: <input name="pseudo" type="text" placeholder="Pseudo..." required /></li>
									<li>Mot de passe: <input type="password" name="mdp" placeholer="Mot de passe ..." required /></li>
									<li><input type="submit" value="Se connecter"/></li>
									<!-- si il n'a pas de compte activer on lui propose d'en creer un! -->
									<li class="red"><a href="inscription.php">Nouveau compte</a></li> 


								<?php include 'includes/connexion_class.php';
								$bdd= bdd(); // connexion à la bdd
								// Si on récupére le post d'un formulaire :

								if (isset($_POST['pseudo']) AND isset($_POST['mdp']))
									{	//on envoie les données à la class connexion
										$connexion = new connexion($_POST['pseudo'],$_POST['mdp']);
										$verif = $connexion->verif();
										// on verifie si les données entrés par l'utilisateur sont bonnes
										// BONUS Cette partie n'est pas términé  entierement 
										if ($verif == 'ok')
											{	// on verifie que les données ont bien été assimiler par la bdd
												if($connexion->session())
													{
														$connexion->online();
														header('Location:'.curPageName());
													}
											}
										else
											{
												// si les données utilisateurs ne sont pas bonnes  on stocke le message d'erreur dans une variable creer pour l'occasion : erreur 2
												$erreur2=$verif;
											}
									}
					 				//si erreur2 existe on l'affiche
					 				// Bonus là aussi ça serait cool en java'script mais bon je m'y suis pas encore penché...
					 				// BONUS BONUS ou alors quand j'ai essayé vite fait ça n'a pas marché ^^ 
					 			if (isset($erreur2)){echo'<li>'.$erreur2.'</li>';} 
							?>
								</form>
							</ul>
						</li>
					<?php 
				} 
				function curPageName() {
					return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
				}
			?>
		</ul>
	</nav>
</header>
