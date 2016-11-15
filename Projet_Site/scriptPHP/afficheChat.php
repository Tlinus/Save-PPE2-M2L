
<?php include("../function.php"); 
$bdd=bdd();

$messages=array();
$reponse = $bdd->query('SELECT msg_chat.contenu as msg, msg_chat.date as dat, msg_chat.heure as tim, utilisateur.pseudo as pseudo
	FROM msg_chat 
	INNER JOIN utilisateur ON msg_chat.auteur_id = utilisateur.utilisateur_id 
	WHERE (utilisateur.onlinedate <= msg_chat.date AND utilisateur.onlineheure <= msg_chat.heure) OR message_id = 1
	ORDER BY message_id DESC');

while ($all= $reponse->fetch())
{
	$messages[] =$all;
}
foreach ($messages as $message) {
	?>
		
		<span>
		<h4><?php echo $message['pseudo'].' à '.$message['tim'].' :';?></h4>
		<p><pre> <?php echo '	'.htmlspecialchars_decode($message['msg'], ENT_QUOTES); ?></pre></p>
		</span>
		<div id="sep"></div>
	<?php 

}
//$donnees 
//echo json_encode($donnees);


?>