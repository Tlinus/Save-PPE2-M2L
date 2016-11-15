<?php

	class monProfil
	{
		private $pseudo;
		private $mail;
		private $id;
		private $bdd;

		public function __construct($pseudo,$mail,$id)
		{
			$this->pseudo = $pseudo;
			$this->mail = $mail;
			$this->id = $id;
			$this->bdd = bdd();
		} 

		public function donneesProfil()
		{
			$req=$this->bdd->prepare('SELECT * FROM utilisateur WHERE mail= :mail AND utilisateur_id = :id AND pseudo= :pseudo');
			$req->execute(array('mail' => $this->mail,
			'id'=> $this->id,
			'pseudo'=> $this->pseudo
			));
			$req1=$req->fetch();
			return $req1;
		}
		
	}
//$_SESSION['pseudo'],$_SESSION['mail'],$_SESSION['id'],$_POST['Nom'],$_POST['Prenom'],$_POST['age'],$_POST['adresse']);
	class modifierProfil
	{
		private $pseudo;
		private $mail;
		private $id;
		private $nom;
		private $prenom;
		private $age;
		private $adresse;
		private $bdd;

		public function __construct($pseudo,$mail,$id)
		{
			$this->pseudo = $pseudo;
			$this->mail = $mail;
			$this->id = $id;
			$this->bdd = bdd();
		} 

	public function profilNom($nom)
		{
			$nom= htmlspecialchars($nom);
			if(strlen($nom) > 3 AND strlen($nom) < 41)
			{
				$req=$this->bdd->prepare('UPDATE utilisateur SET Nom= :nom WHERE mail= :mail AND utilisateur_id = :id AND pseudo= :pseudo');
				$req->execute(array('nom'=>$nom,
				'mail' => $this->mail,
				'id'=> $this->id,
				'pseudo'=> $this->pseudo
				));
				return $verif='ok';
			}
			else
			{
				$verif='Votre nom doit contenir entre 4 et 40 caracteres';
				return $verif;
			}
		}
	public function profilPrenom($prenom)
		{
			$prenom = htmlspecialchars($prenom);
			$syntaxe = '##i';
			if(strlen($prenom) > 3 AND strlen($prenom) < 41 AND preg_match($syntaxe,$prenom))
			{
				$req=$this->bdd->prepare('UPDATE utilisateur SET Prenom= :prenom WHERE mail= :mail AND utilisateur_id = :id AND pseudo= :pseudo');
				$req->execute(array('prenom'=>$prenom,
				'mail' => $this->mail,
				'id'=> $this->id,
				'pseudo'=> $this->pseudo
				));
				return $verif='ok';
			}
			else
			{
				$verif='Votre prénom doit contenir entre 4 et 40 caracteres alphabétiques';
				return $verif;
			}
		}
	public function profilAge($age)
		{
			$syntaxe = '#[^\D]#';
			if(preg_match($syntaxe,$age))
				{
					if($age >4 AND $age < 130)
					{
						$req=$this->bdd->prepare('UPDATE utilisateur SET age= :age WHERE mail= :mail AND utilisateur_id = :id AND pseudo= :pseudo');
						$req->execute(array('age'=>$age,
						'mail' => $this->mail,
						'id'=> $this->id,
						'pseudo'=> $this->pseudo
						));
						return $verif='ok';
					}
					else
					{
						$verif ='Veuillez entrer un âge compris entre 5 et 129 ans';
						return $verif;
					}
				}
			else
			{
				$verif='Veuillez entrer votre âge uniquement avec des chiffres';
				return $verif;
			}
			
		}
	public function profilAdresse($adresse)
		{
			$adresse= htmlspecialchars($adresse);
			$req=$this->bdd->prepare('UPDATE utilisateur SET adresse= :adresse WHERE mail= :mail AND utilisateur_id = :id AND pseudo= :pseudo');
			$req->execute(array('adresse'=>$adresse,
			'mail' => $this->mail,
			'id'=> $this->id,
			'pseudo'=> $this->pseudo
			));
			return $verif='ok';
		}
	}