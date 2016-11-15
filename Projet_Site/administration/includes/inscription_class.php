<?php
// je ne t'ai pas commenter toutes les initialisation de variable je pense que t'auras compris...
//include 'function.php';
	class inscription
	{
		private $pseudo;
		private	$email;
		private $mdp;
		private $mdp2;
		
		
		public function __construct($pseudo, $email, $mdp, $mdp2, $nom, $prenom, $numvoie, $voie, $ville, $postal, $genre) 
		{
			$pseudo 	= htmlspecialchars($pseudo);
			$email 		= htmlspecialchars($email);
			$nom 		= htmlspecialchars($nom);
			$prenom 	= htmlspecialchars($prenom);
			$voie 		= htmlspecialchars($voie);
			$ville 		= htmlspecialchars($ville);


			
			$this->pseudo 	= $pseudo;
			$this->email 	= $email;
			$this->mdp 		= $mdp;
			$this->mdp2 	= $mdp2;
			$this->nom 		= $nom;
			$this->prenom 	= $prenom;
			$this->numvoie 	= $numvoie;
			$this->voie 	= $voie;
			$this->ville 	= $ville;
			$this->postal 	= $postal;
			$this->genre 	= $genre;
			$this->bdd 		= bdd();
		}
		
		
		public function verif()
			{
				if(strlen($this->pseudo) > 5 AND strlen($this->pseudo) < 20 )
					{// si le pseudo est bon
						// on tchek la syntacxe du mail
						
						$syntaxe = ' #^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
						if(preg_match($syntaxe, $this->email))
							{	//si la syntaxe du mail est bon
								//on tcheck si le mot de passe à entre 5 et 20 caractéres
								if(strlen($this->mdp) > 5 AND strlen($this->mdp) < 20)
									{//si le mot de pase est bon
										// on tcheck si les deux mots ddfe passes sont identiques...
										if($this->mdp == $this->mdp2) 
											{
												$syntaxe = '#^[a-zA-Z_]{3,30}$# ';
												if(preg_match($syntaxe,$this->nom) AND preg_match($syntaxe,$this->prenom))
													{
														if(preg_match ( " #^[0-9]{5,5}$# " , $this->postal)){
															if(is_numeric($this->numvoie)){
																if(preg_match('#^[a-zA-Z_]{3,30}$# ', $this->ville)){

																	return 'ok';

																}
																else {
																	$erreur="Le nom de la ville doit contenir entre 3 et 30 caracteres, et ne pas contenir de caractéres spéciaux";
																}
															}
															else{
																$erreur="Votre numero de voie n'est pas valide";
															}

														}
														else {
															$erreur="Votre code postal doit contenir 5 caractéres numériques";
														}
													}
												else {
													$erreur = ' Vos Nom et Prenom doivent contenir entre 3 et 30 caracteres, et ne pas contenir de caractéres spéciaux';
												}
											}
										else
											{ /* les deux mots de passes sont mauvais */
												$erreur=' Les mots de passes renseignés ne sont pas identiques! ';
												return $erreur;
											}
									}
								else 
									{/* le premier mot de passe ne contient pas entre 5 et 20 caractéres */
										$erreur=' Le  mot de passe doit contenir entre 5 et 20 caractéres';
										return $erreur;
									}
							}
							
						else 
							{ /* email mauvais */
								$erreur = 'Syntaxe de l\'adresse email incorrect ';
								return $erreur;
							}
							
					}
					
				else
					{
					//pseudo mauvais
						$erreur = ' Le pseudo doit contenir entre 5 et 20 caractéres';
						return $erreur;
					}
				
			}
		
		public function enregistrement()
			{
				$adresse = $this->numvoie.' '.$this->voie.' '.$this->postal.' '.$this->ville;
				$requete = $this->bdd->prepare('INSERT INTO utilisateur (pseudo,mail,mdp,Nom,Prenom,adresse,genre) VALUES (:pseudo, :email, :mdp, :nom, :prenom, :adresse, :genre)');
				$requete->execute(array(
					'pseudo' => $this->pseudo,
					'email' => $this->email,
					'mdp' => $this->mdp,
					'nom' => $this->nom,
					'prenom' => $this->prenom,
					'adresse' => $adresse,
					'genre' =>	$this->genre
				));
				return 1;
			}
		
		public function  session()
			{
				$requete = $this->bdd->prepare('SELECT utilisateur_id, mail FROM utilisateur WHERE pseudo = :pseudo');
				$requete->execute(array(':pseudo' => $this->pseudo));
				$requete = $requete->fetch();
				$_SESSION['utilisateur_id'] = $requete['utilisateur_id'];
				$_SESSION['pseudo'] = $this->pseudo;
				$_SESSION['mail'] = $requete['mail'];
				return 1;
			}
				
	}