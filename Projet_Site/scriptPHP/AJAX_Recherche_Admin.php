<?php
	include '../function.php';
	if($_POST['req']){
		$bdd=bdd();
		$result=array();
		$i=0;
		switch($_POST['req']){
			case 'user':
			if($_POST['opt']){
				$req=$bdd->query('SELECT utilisateur_id,pseudo FROM utilisateur  WHERE pseudo LIKE "'.$_POST['opt'].'%" ORDER BY pseudo ASC');
			}
			else{
				$req=$bdd->query('SELECT utilisateur_id,pseudo FROM utilisateur ORDER BY pseudo ASC');
			}
				while($reponse=$req->fetch()){
					$result[$i][1]=utf8_encode($reponse['pseudo']);
					$result[$i][0]=utf8_encode($reponse['utilisateur_id']);
					$i++;
				}
			break;
			case 'forum':
			if($_POST['opt']){
				$req=$bdd->query('SELECT forum_id,titre FROM forum WHERE titre LIKE "'.$_POST['opt'].'%" ORDER BY titre ASC');
			}
			else{
				$req=$bdd->query('SELECT forum_id,titre FROM forum ORDER BY titre ASC');
			}
				while($reponse=$req->fetch()){
					$result[$i][1]=utf8_encode($reponse['titre']);
					$result[$i][0]=$reponse['forum_id'];
					$i++;
				}
			break;
			case 'sujet':
			if($_POST['opt']){
				$req=$bdd->query('SELECT topic_id,titre FROM topic WHERE titre LIKE "'.$_POST['opt'].'%" ORDER BY titre ASC');
			}
			else{
				$req=$bdd->query('SELECT topic_id,titre FROM topic ORDER BY titre ASC');
			}
				while($reponse=$req->fetch()){
					$result[$i][1]=utf8_encode($reponse['titre']);
					$result[$i][0]=$reponse['topic_id'];
					$i++;
				}
			break;
			case 'message':
				if($_POST['opt']){
				$req=$bdd->query('SELECT utilisateur.pseudo AS pseudo, topic.titre AS titre,msg_forum.contenu AS contenu, message_id FROM msg_forum 
									INNER JOIN topic ON topic.topic_id=msg_forum.topic_id
									INNER JOIN utilisateur ON msg_forum.auteur_id=utilisateur.utilisateur_id
									WHERE pseudo LIKE "'.$_POST['opt'].'%"
									ORDER BY msg_forum.date DESC');
				}
				else{
				$req=$bdd->query('SELECT utilisateur.pseudo AS pseudo, topic.titre AS titre,msg_forum.contenu AS contenu, message_id FROM msg_forum 
									INNER JOIN topic ON topic.topic_id=msg_forum.topic_id
									INNER JOIN utilisateur ON msg_forum.auteur_id=utilisateur.utilisateur_id
									ORDER BY msg_forum.date DESC');
				}
				while($reponse=$req->fetch()){
					$result[$i][1]=utf8_encode($reponse['pseudo']);
					$result[$i][2]=utf8_encode($reponse['titre']);
					$result[$i][3]=utf8_encode($reponse['contenu']);
					$result[$i][0]=$reponse['message_id'];
					$i++;
				}
			break;
			case 'categorie':
				if($_POST['opt']){
				$req=$bdd->query('SELECT * FROM categorie WHERE label LIKE "'.$_POST['opt'].'%" ORDER BY label ASC');
				}
				else{
				$req=$bdd->query('SELECT * FROM categorie ORDER BY label ASC');
				}
				while($reponse=$req->fetch()){
					$result[$i][1]=utf8_encode($reponse['label']);
					$result[$i][0]=$reponse['categorie_id'];
					$i++;
				}
			break;
			case 'tva':
				if($_POST['opt']){
				$req=$bdd->query('SELECT * FROM tva WHERE taux LIKE "'.$_POST['opt'].'%" ORDER BY taux ASC');
				}
				else{
				$req=$bdd->query('SELECT * FROM tva ORDER BY taux ASC');
				}
				while($reponse=$req->fetch()){
					$result[$i][0]=$reponse['tva_id'];
					$result[$i][1]=$reponse['taux'];
					$i++;
				}
			break;
			case 'produit':
			if($_POST['opt']){
				$req=$bdd->query('SELECT produit_id,designation FROM produit  WHERE designation LIKE "'.$_POST['opt'].'%" ORDER BY designation ASC');
			}
			else{
				$req=$bdd->query('SELECT produit_id,designation FROM produit ORDER BY designation ASC');
			}
				while($reponse=$req->fetch()){
					$result[$i][0]= $reponse['produit_id'];
					$result[$i][1]= utf8_encode($reponse['designation']);
					$i++;
				}
			break;
			case 'article':
			if($_POST['opt']){
				$req=$bdd->query('SELECT id,titre,date FROM article  WHERE titre LIKE "'.$_POST['opt'].'%" ORDER BY titre ASC');
			}
			else{
				$req=$bdd->query('SELECT id,titre,date FROM article ORDER BY titre ASC');
			}
				while($reponse=$req->fetch()){
					$result[$i][0]= $reponse['id'];
					$result[$i][1]= utf8_encode($reponse['titre']);
					$result[$i][2]= $reponse['date'];
					$i++;
				}
			break;
		}
		echo json_encode($result);
	}
?>