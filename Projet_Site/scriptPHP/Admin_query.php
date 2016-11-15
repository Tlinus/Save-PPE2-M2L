
<?php
	session_start();
	include('../function.php');
	$bdd=bdd();
	
	//supression sujet forum
	if($_POST['sup_suj']){
		if(verifExists($_POST['sup_suj'],'topic_id','topic')){
			$query=$bdd->query('DELETE FROM topic WHERE topic_id='.$_POST['sup_suj'].'');
			if($query){
				echo ' Suppression sujet forum : Le sujet :'.$_POST['sup_suj'].' a bien été supprimé';
			}
			else{
				echo ' Suppression sujet forum : Le sujet:'.$_POST['sup_suj'].' n\' a pas pu être supprimé';
			}
		}
		else{
			echo 'Suppression sujet forum : Ce sujet n\'existe pas';
		}
	}
	// suppression message forum
	if($_POST['sup_msg_id']){
		if(verifExists($_POST['sup_msg_id'],'message_id','msg_forum')){
			$query=$bdd->query('DELETE FROM msg_forum WHERE message_id='.$_POST['sup_msg_id'].'');
			if($query){
				echo ' Suppression message Forum : Le message :'.$_POST['sup_msg_id'].' a bien été supprimé';
			}
			else{
				echo ' Suppression message Forum : Le message :'.$_POST['sup_msg_id'].' n\' a pas pu être supprimé';
			}
		}
		else{
			echo 'Supression message Forum : Ce message n\'existe pas';
		}
	}
	
	// suppression de forum
	if($_POST['sup_for']){
		if(verifExists($_POST['sup_for'],'forum_id','forum')){
			$query=$bdd->query('DELETE FROM forum WHERE forum_id='.$_POST['sup_for'].'');
			if($query){
				echo ' Suppression Forum : Le message :'.$_POST['sup_for'].' a bien été supprimé';
			}
			else{
				echo ' Suppression Forum : Le message :'.$_POST['sup_for'].' n\' a pas pu être supprimé';
			}
		}
		else{
			echo 'Suppression Forum : Ce message n\'existe pas';
		}
	}
	
	// Ajout d'une catégorie
	if($_POST['aj_cat_nom']){
		if(!verifExists($_POST['aj_cat_nom'],'label','categorie')){
			$query=$bdd->query('INSERT INTO `categorie`(`categorie_id`, `label`) VALUES (NULL,'.$_POST['aj_cat_nom'].')');
			if($query){
				echo 'Ajout catégorie: La catégorie :'.$_POST['aj_cat_nom'].' a bien été crée';
			}
			else{
				echo 'Ajout catégorie : La catégorie :'.$_POST['aj_cat_nom'].' n\' a pas pu être crée';
			}
		}
		else{
			echo 'Ajout catégorie : Cette catégorie existe déjà';
		}
	}
	
	//Ajout d'article
	
	if($_POST['aj_art_cat'] AND $_POST['aj_art_nom'] AND $_POST['aj_art_desc'] AND $_POST['aj_art_prix'] AND $_POST['aj_art_url'] AND $_POST['aj_art_tva']){
		if(verifExists($_POST['aj_art_cat'],'categorie_id','categorie') AND verifExists($_POST['aj_art_tva'],'tva_id','tva')){
			/*if(!verifExists($_POST['aj_art_nom'],'designation','produit')){*/
				$nom=utf8_encode($_POST['aj_art_nom']);
				$descri=utf8_encode($_POST['aj_art_desc']);
				$query=$bdd->prepare('INSERT INTO `produit`(`produit_id`, `designation`, `description`, `prix_unitaire`, `tva_id`, `date_parution`, `categorie_id`) VALUES (NULL,:des,:desc,:prix,:tva,NOW(),:cat)');
				$query->execute(array('des'=>$nom,'desc'=>$descri,'prix'=>$_POST['aj_art_prix'],'tva'=>$_POST['aj_art_tva'],'cat'=>$_POST['aj_art_cat']));
				$query2=$bdd->prepare('SELECT produit_id FROM produit WHERE designation=:nom');
				$query2->execute(array('nom'=>$nom));
				$reponse=$query2->fetch();
				$query3=$bdd->prepare('INSERT INTO `photo`(`photo_id`, `url`, `id_produit`) VALUES (NULL,:url,:id)');
				$query3->execute(array('url'=>$_POST['aj_art_url'],'id'=>$reponse['produit_id']));
				if($query){
					echo ' Ajout article : L\'article a été créé  :'.$_POST['aj_cat_nom'].' a bien été crée';
				}
				else{
					echo ' Ajout article : L\'article :'.$_POST['aj_cat_nom'].' n\' a pas pu être crée';
				}
			/*}
			else{
				echo 'Ajout article : Un article porte déjà ce nom';
			}*/	
		}
		else{
			echo 'Ajout article : Cette catégorie ou cette TVA n\'existe pas, veuillez faire référence à des tables existantes';
		}
	}
	
	// Supprimer un article
	
	if($_POST['sup_art_id']){
		if(verifExists($_POST['sup_art_id'],'produit_id','produit')){
			$query=$bdd->query('DELETE FROM produit WHERE produit_id='.$_POST['sup_art_id'].'');
			if($query){
				echo 'Suppression article:L\'article a bien été supprimé.';
			}
			else{
				echo'Suppression article:L\' article n\' a pas pu être supprimé';
			}
		}
		else{
			echo'Suppression article : L\'article n\'existe pas.';
		}
	}
	
	// editer un article
	
	if($_POST['ed_art_id'] AND $_POST['ed_art_nom'] AND $_POST['ed_art_cat'] AND $_POST['ed_art_tva'] AND $_POST['ed_art_desc'] AND $_POST['ed_art_prix'] AND $_POST['ed_art_url']){
		if(verifExists($_POST['ed_art_id'],'produit_id','produit')){
			if(verifExists($_POST['ed_art_cat'],'categorie_id','categorie')){
				if(verifExists($_POST['ed_art_tva'],'tva_id','tva')){
					$query=$bdd->query('UPDATE `produit` SET `designation`='.$_POST['ed_art_nom'].',categorie_id='.$_POST['ed_art_cat'].',prix_unitaire='.$_POST['ed_art_prix'].',description='.$_POST['ed_art_desc'].',tva_id='.$_POST['ed_art_tva'].'WHERE `id`='.$_POST['ed_art_id'].'');
					if(verifExists($_POST['ed_art_url'],'id_produit','photo')){
						$query1=$bdd->query('UPDATE photo SET url='.$_POST['ed_art_url'].' WHERE id_produit='.$_POST['ed_art_id'].'');
						if($query){
							echo 'Edition d\'article : L\'article a bien été édité';
						}
						if($query1){
							echo 'Edition d\'article : La photo correspondante à l\'article a bien été éditée.';
						}
						else{
							echo 'Edition d\'article :L\'article n\'a pas pu être édité';
						}
					}
				}
				else{
					echo 'Edition d\'article : La TVA indiquée n\'existe pas';
				}
			}
			else{
				echo'Edition d\'article : la catégorie n\'existe pas';
			}
		}
		else{
			echo 'Edition d\'article : L\'article sélectionné n\existe pas.';
		}
	}
	// suppression catégorie
	
	if($_POST['sup_cat_id']){
		if(verifExists($_POST['sup_cat_id'],'categorie_id','categorie')){
			$query=$bdd->query('DELETE FROM categorie WHERE categorie_id='.$_POST['sup_cat_id'].'');
			if($query){
				echo'Suppression catégorie: La catégorie a été supprimée.';
			}
			else{
				echo'Suppression catégorie: La catégorie n\'a pas pu être supprimée.';
			}
		}
		else{
			echo 'Suppression catégorie: La catégorie sélectionnée n\'existe pas.';
		}
	}
	
	// créer une TVA
	if($_POST['aj_tva']){
		if(verifExists($_POST['aj_tva'],'taux','tva')){
			echo 'Création de TVA : ce taux de TVA existe déjà.';
		}
		else{
			$query=$bdd->query('INSERT INTO tva(tva_id,taux) VALUES(NULL,'.$_POST['aj_tva'].'');
			if($query){
				echo ' Création de TVA: votre valeur a bien été enregistrée';
			}
			else{
				echo ' Création de TVA: la valeur n\'a pas pu être ajoutée';
			}
		}
	}	
	// supprimer TVA
	if($_POST['sup_tva']){
		if(verifExists($_POST['sup_tva'],'tva_id','tva')){
			$query=$bdd->query('DELETE FROM tva WHERE tva_id='.$_POST['sup_tva'].'');
			if($query){
				echo'Suppression TVA: La TVA a été supprimée.';
			}
			else{
				echo'Suppression TVA: La TVA n\'a pas pu être supprimée.';
			}
		}
		else{
			echo 'Suppression TVA: La TVA sélectionnée n\'existe pas.';
		}
	}
	//promouvoir un utilisateur en administrateur
	
	if($_POST['prom_ut']){
		if(verifExists($_POST['prom_ut'],'utilisateur_id','utilisateur')){
			$query=$bdd->query('UPDATE utilisateur SET isAdmin=1 WHERE utilisateur_id='.$_POST['prom_ut'].'');
			if($query){
				echo 'L\'utilisateur sélectionné a bien été promu au rang d\'administrateur.';
			}
			else{
				echo ' L\' utilisateur n\'a pas été promu.';
			}
		}
		else{
			echo ' L\' utilisateur n\'existe pas.';
		}
	}
	// supprimer utilisateur
	if($_POST['sup_ut']){
		if(verifExists($_POST['sup_ut'],'utilisateur_id','utilisateur')){
			$query=$bdd->query('DELETE FROM utilisateur WHERE utilisateur_id='.$_POST['sup_ut'].'');
			if($query){
				echo 'Suppression d\'utilisateur: L\'utilisateur a bien été supprimé.';
			}
			else{
				echo 'Suppression d\'utilisateur: L\'utilisateur n\'a pas pu être supprimé.';
			}
		}
		else{
			echo 'Suppression d\'utilisateur :L\'utilisateur n\'existe pas.';
		}
	}
	if($_POST['aj_art_m2l_titre'] AND $_POST['aj_art_m2l_ext'] AND $_POST['aj_art_m2l_photo'] ){
		$query=$bdd->prepare('INSERT INTO `article`(`id`, `img_url`, `extrait`, `contenu`, `titre`, `auteur_id`, `date`) 
												VALUES (NULL,:photo,:extrait,:contenu,:titre,:auteur,NOW())');
		$query->execute(array('photo'=>$_POST['aj_art_m2l_photo'],'extrait'=>utf8_decode($_POST['aj_art_m2l_ext']),'contenu'=>utf8_decode($_POST['aj_art_m2l_contenu']),'titre'=>$_POST['aj_art_m2l_titre'],'auteur'=>$_POST['aut_art_m2l_id']));
		if($query){
			echo 'Ajout d\'article M2L: L\'article a bien été ajouté';
		}
		else{
			echo 'Ajout d\'article M2L: L\' article n\'a pas pu être ajouté';
		}
	}
	if($_POST['sup_art_m2l']){
		if(verifExists($_POST['sup_art_m2l'],'id','article')){
			$query=$bdd->query('DELETE FROM article WHERE id='.$_POST['sup_art_m2l'].'');
			if($query){
				echo "Suppression d'article : L'article a bien été supprimé";
			}
			else{
				echo "Suppression d'article : L'article n'a pas été supprimé";
			}
		}
		else{
			echo "Suppression d'article : L'article n'existe pas.";
		}
		
	}
	function verifExists($id,$colonne,$table){
		$bdd=bdd();
		$query=$bdd->query('SELECT * FROM '.$table.' WHERE '.$colonne.'='.$id.'');
		if($reponse=$query->fetch()){
			return true;
		}
		else{
			return false;
		}
	}
?>