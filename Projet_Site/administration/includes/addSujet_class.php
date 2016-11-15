<?php
//include 'function.php';
class addSujet
	{
		private $titre;
		private $contenu;
		private $bdd;
		private $forum;
		
		public function __construct($titre,$contenu,$forum)
			{
					$this->titre = $titre;
					$this->contenu = $contenu;
					$this->forum = htmlspecialchars($forum);
					$this->bdd = bdd();
			}
		public function verif()
			{
				if(strlen($this->titre) >5 AND strlen($this->titre) <60 ) // si le nom du sujet est bon 
					{
						if(strlen($this->contenu) >= 0) // Si on a bien un message
							{
								return'ok';
							}
						else // si on a pas de contenu de message
							{
								$erreur= 'Veuillez entrez un message .... ';
								return $erreur;
							}
					}
				else //si le nom du sujet est trop long ou trop court!
					{
						$erreur = 'Le nom du sujet doit contenir entre 5 et 60 caractéres';
						return $erreur;
					}
			}
		public function insert()
			{

				$requete = $this->bdd->prepare('INSERT INTO topic (titre,contenu,date,auteur_id,forum_id) VALUES (:titre,:contenu,NOW(),:auteur,:forum)');
				$requete->execute(array('titre'=> utf8_decode($this->titre), 'contenu'=> utf8_decode($this->contenu),'auteur'=>$_SESSION['id'],'forum'=>$this->forum));
				return 1;
			}
	}
?>