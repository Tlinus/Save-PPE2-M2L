<?php
//include 'function.php';
class addPost
	{
		private $topic;
		private $contenu;
		private $bdd;
		
		public function __construct($topic,$contenu)
			{
					$this->topic = htmlspecialchars($topic);
					$this->contenu = $contenu;
					$this->bdd = bdd();
			}
		public function verif()
			{
				if(strlen($this->contenu) > 2) // Si on a bien un message
					{
						return'ok';
					}
				else // si on a pas de contenu de message
					{
						$erreur= 'Veuillez entrez un message un peu plus long.... ';
						return $erreur;
					}
					
			}
		public function insert()
			{
				
				$requete2 = $this->bdd->prepare('INSERT INTO msg_forum(auteur_id,contenu,date,topic_id) VALUES (:idm,:contenu,NOW(),:id)');
				$requete2->execute(array('idm'=>$_SESSION['id'], 'contenu'=>$this->contenu,'id'=>$this->topic));
				
				return 1;
			}
	}
?>