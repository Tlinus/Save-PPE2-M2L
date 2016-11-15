<?php
//include("function.php"); 
	
	

class addMessage {
	
	private $bdd;
	private $msg;
	private $auteur_id;


	public function __construct($msg)
		{
			$this->bdd = bdd();
			$this->msg =trim($msg);
			$Q1 = $this->bdd->prepare('SELECT utilisateur_id FROM utilisateur WHERE  pseudo = :pseudo');
			$Q1->execute(array('pseudo' => $_SESSION['pseudo']));
			$Q1=$Q1->fetch();
			$this->auteur_id = $Q1['utilisateur_id'];
								
		}
	public function insert()
		{
			if (!empty($_POST['msg'])) {
				$q0 = $this->bdd->prepare( 'INSERT INTO `msg_chat` (`auteur_id`, `contenu`, `date`, `heure`) 
						VALUES (:aid, :msg, CURDATE(), CURTIME())');
				$q0->execute(array('aid'=>$this->auteur_id,'msg'=>$this->msg));
			}
			else {
			?>
				<script> alert('Veuillez entrer un message'); </script>
			<?php
			}
		}

	}
?>