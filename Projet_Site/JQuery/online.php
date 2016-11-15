<?php

include("../function.php");
	$bdd=bdd();
	$pseudo = $_POST['pseudo']	;

	$req = $bdd->prepare('UPDATE utilisateur SET onlinetime = NOW() WHERE pseudo=:pseudo');
	$req->execute(array('pseudo'=>$pseudo));

	$req2 =$bdd->query('SELECT pseudo FROM utilisateur WHERE onlinetime > NOW()-(20)');


	while ($all= $req2->fetch())
{
	$enlignes[] =$all;
}
foreach ($enlignes as $enligne) {
	?>

	<li>
		<?php echo '¤ '.$enligne['pseudo'].' ¤';?>
	</li>

	<?php
}


?>