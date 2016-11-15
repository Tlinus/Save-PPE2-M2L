<?php session_start(); ?>
<?php include("../function.php"); 
$bdd=bdd();

$reponse = $bdd->query('SELECT msg_chat.contenu as msg, msg_chat.date as dat, msg_chat.heure as tim, utilisateur.pseudo as pseudo
	FROM msg_chat 
	INNER JOIN utilisateur ON msg_chat.auteur_id = utilisateur.utilisateur_id 
	ORDER BY message_id DESC LIMIT 0, 5');

while ($donnees = $reponse->fetch())
	{
		?>
			<p>
				<strong><?php echo $donnees ['pseudo']; ?> : </strong><?php echo $donnees['msg']; ?><br>
			</p>
		<?php
	}
$reponse ->closeCursor();
?>