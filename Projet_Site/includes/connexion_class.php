<?php
	// je commence à avoir la flemme de commenter, mais je pense que t'auras compris le principe, si t'as des questions...
	//include 'function.php';

class connexion
{
	private $pseudo;
	private	$email;
	private $bdd;
	
	public function __construct($pseudo,$mdp)
		{
			$this->pseudo = $pseudo;
			$this->mdp=	$mdp;
			$this->bdd = bdd();
		}
	public function verif()
		{
			$requete = $this->bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo');
			$requete->execute(array('pseudo' => $this->pseudo));
			$reponse = $requete->fetch();
			if($reponse)
				{
					if ($this->mdp == $reponse['mdp'])
						{
							return 'ok';
						}
					else 
						{
							$erreur = 'le mot de passe est incorrect';
							return $erreur;
						}
				}
			else
				{
					$erreur ='le pseudo est innexistant';
					return $erreur;
				}
		}
	public function online()
		{
			$req=$this->bdd->prepare('UPDATE utilisateur SET onlinetime=CURRENT_TIME()  WHERE pseudo = :pseudo');
			$req->execute(array(':pseudo'=>$this->pseudo));
			//var_dump($this->bdd); exit;
		}
	public function  session()
		{
			$requete = $this->bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo');
			$requete->execute(array(':pseudo' => $this->pseudo));
			$requete = $requete->fetch();
			$_SESSION['id'] = $requete['utilisateur_id'];
			$_SESSION['pseudo'] = $this->pseudo;
			$_SESSION['mail'] = $requete['mail'];
			if($requete['isAdmin']==1){
				$_SESSION['isAdmin']=1;
			}
			return 1;
		}
}