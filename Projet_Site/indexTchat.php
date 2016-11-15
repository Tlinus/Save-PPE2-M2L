		<?php session_start(); ?>
		<?php include("function.php"); ?>
		<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title> Tchat </title>
		<link rel="stylesheet" href="main.css">
	</head>
	<script>var pseudo ='<?php echo $_SESSION['pseudo']; ?>'</script>
	<body>
		<?php include("includes/menu_principal.php");?>
		<?php include("includes/menu_ligues.php"); ?>
		<?php include("includes/chat_class.php"); ?>

		<?php $bdd = bdd();
		$req = $bdd->prepare('UPDATE utilisateur SET onlineheure = CURTIME(), onlinedate = CURDATE() WHERE pseudo=:pseudo');
		$req->execute(array('pseudo'=>$_SESSION['pseudo']));
 ?>

	<?php if (isset($_POST['msg']))
		{
			$addMsg= new addMessage($_POST['msg']);
			if($addMsg->insert())
						{
							header('Location: indexTchat.php');
						}

		} ?>
		<section id="tchat">

			<div id="console">
			<!--<a href="javascript:recupmessages()">test</a>-->
			</div>
			<div id="utilisateursenlignes">
				<h3> Utilisateurs en ligne</h3>
				<ul id="enligne">
					<!-- utilisateurs online via ajaxChat.js ->online.php-->		
				</ul>
			</div>
	<?php		 if(isset($_SESSION['pseudo']))
					{
	?>
				<form method="post" action="indexTchat.php" class="formchat">
				<textarea name="msg" class="msg" type="text" placeholder=" "></textarea>
				<div></div>
						<button class="bouton3" type="submit">Envoyer</button> 
						<button class="reset bouton3" type="reset">Effacer</button> 			
			</form>
	<?php
			}

			else {
				echo('Vous devez etre connecter pour participer au chat');
			}
	?>
		</section>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="JQuery/ajaxChat.js"></script>
	</body>
</html>