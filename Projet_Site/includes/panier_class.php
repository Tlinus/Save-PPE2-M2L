<?php
	include'../function.php';
	class panier{
		private $bdd;
		private $panier_id;
		private	$panierCookie=array();
		
		public function __construct(){
			$this->bdd=bdd();    
			$this->panierCookie['produit']=array();
			$this->panierCookie['quantite']=array();
			if(isset($_SESSION['id'])){
				$query1=$this->bdd->prepare('SELECT session_id FROM panier WHERE utilisateur_id=:id');
				$query1->execute(array('id'=>$_SESSION['id']));
				$test=$query1->fetch();
				$this->panier_id=$test['session_id'];
			}
		}
		function verif(){
			if($_POST['quantite']>0 AND $_POST['quantite']<100 AND is_numeric($_POST['quantite'])){
				if(isset($_SESSION['id'])){
					// On vérifie s'il existe un panier pour cet utilisateur
					$test=$this->bdd->prepare('SELECT session_id FROM panier WHERE utilisateur_id=:id');
					$test->execute(array('id'=>$_SESSION['id']));
					$result=$test->fetch();
					//si c'est le cas on dit que l'on peut écrire dans la bdd.
					if(	$result['session_id']){
						$this->panier_id=$result['session_id'];// on enregistre le panier dans la variable prévue
						if(isset( $_COOKIE['boutique'])) // Si l'utilisateur a déjà un panier Cookie on devra le convertir en BDD
							return 'Cookie&utilisateur&panier';
						else
							return 'noCookie&utilisateur&panier';
					}
					//sinon il faut créer un panier
					else{
						if(isset($_COOKIE['boutique']))
							return'Cookie&utlisteur&NoPanier'; // si l'utilisateur à un panier cookie et pas de panier BDD 
						else
							return 'noCookie&utilisateur&noPanier';
					}
				}
				// si l'utilisateur n'est pas enregistré on enregistre le contenu dans le cookie 
				else{
					if(isset($_COOKIE['boutique']))
						return 'cookie&noUtilistateur';
					else
						return 'noCookie&noUtilisateur';
				}	
			}
			else{
				return 'noQuantite';
			}
		
		}
		function verif2(){
			$test=$this->bdd->prepare('SELECT session_id FROM panier WHERE utilisateur_id=:id');
					$test->execute(array('id'=>$_SESSION['id']));
					$result=$test->fetch();
			if(	$result['session_id']){
				return 'Cookie&utilisateur&panier';
			}
			else 
				return 'Cookie&utilisateur&nopanier';
			
			
		}

		public function CreatePanier(){
			$query=$this->bdd->prepare('INSERT INTO panier(utilisateur_id,date) VALUES (:id,NOW())');
			$query->execute(array('id'=>$_SESSION['id']));
			$test=$this->bdd->prepare('SELECT session_id FROM panier WHERE utilisateur_id=:id');
			$test->execute(array('id'=>$_SESSION['id']));
			$result=$test->fetch();     
			$this->panier_id=$result['session_id'];
		}
		public function trierPanier(){
			if(isset($_COOKIE['boutique'])){
				$data=unserialize($_COOKIE['boutique']);
				for($i=0;$i<count($data['produit']);$i++){
					if($_POST['produit']==$data['produit'][$i]){
						$data['quantite'][$i]+=$_POST['quantite'];
						setCookie('boutique',serialize($data),time()+3600,'/');
						return true;
					}
				}
				return false;
			}
			else{
				$query=$this->bdd->query('SELECT * FROM quantite WHERE session_id='.$_SESSION['id'].'');
				while($reponse=$query->fetch()){
					if($reponse['produit_id']==$_POST['produit']){
						$total=$reponse['nombre']+$_POST['quantite'];
						$query2=$this->bdd->query('UPDATE quantite SET nombre='.$total.' WHERE quantite_id='.$reponse['quantite_id'].'');
						return true;
					}
				}
				return false;
			}
		}
		public function addProduit(){
			if(!$this->trierPanier()){
				$query=$this->bdd->prepare('INSERT INTO quantite(nombre,produit_id,session_id) VALUES(:nombre,:produit,:id)');
				$query->execute(array('nombre'=>$_POST['quantite'],'produit'=>$_POST['produit'],'id'=>$this->panier_id));
			}
		}
		public function convertCookie(){
			$query1=$this->bdd->prepare('SELECT session_id FROM panier WHERE utilisateur_id=:id');
			$query1->execute(array('id'=>$_SESSION['id']));
			$test=$query1->fetch();
			$this->panier_id=$test['session_id'];
			$res=unserialize($_COOKIE['boutique']);
			for( $i=0;$i<count($res['produit']);$i++){
				$query=$this->bdd->prepare('INSERT INTO quantite(nombre,produit_id,session_id) VALUES(:quantite,:produit_id,:id)');
				$query->execute(array('quantite'=>$res['quantite'][$i],'produit_id'=>$res['produit'][$i],'id'=>$this->panier_id));
			}
			setCookie('boutique','',time()+3600,'/');
		}
		public function createCookie(){
			$this->panierCookie['produit'][0]=$_POST['produit'];
			$this->panierCookie['quantite'][0]=$_POST['quantite'];
			setCookie('boutique',serialize($this->panierCookie),time()+3600,'/');
		}
	
		public function updateCookie(){
			$data=unserialize($_COOKIE['boutique']);
			if(!$this->trierPanier()){
				array_push($data['produit'],$_POST['produit']);
				array_push($data['quantite'],$_POST['quantite']); 
				setCookie('boutique',serialize($data),time()+3600,'/');
			}
		}
		public function deleteProduitBDD(){
			$query=$this->bdd->prepare('DELETE FROM quantite WHERE produit_id=:id AND session_id=:panier_id');
			$query->execute(array('id'=>$_POST['produit'], 'panier_id'=>$this->panier_id));
		}
		public function deletePanierBDD(){
			$query=$this->bdd->prepare('DELETE FROM quantite WHERE session_id=:id');
			$query->execute(array('id'=>$this->panier_id)); 
		}
		public function deleteProduitCookie(){
			$data=unserialize($_COOKIE['boutique']);
			$resultat=array();
			$resultat['produit']=array();
			$resultat['quantite']=array();
			for($i=0;$i<count($data['produit']);$i++){
				if($data['produit'][$i]!=$_POST['produit']){
					$resultat['produit'][]=$data['produit'][$i];
					$resultat['quantite'][]=$data['quantite'][$i];
				}
			}	
			if(count($resultat['produit'])==0)
				setCookie('boutique','',time()+3600,'/');
			else{
				setCookie('boutique',serialize($resultat),time()+3600,'/');
			}
		}
		public function deletePanierCookie(){
			setCookie('boutique','',time()+3600,'/');
		}
	}
?>