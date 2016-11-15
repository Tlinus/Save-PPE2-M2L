<?php
session_start()
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="main.css">
		<meta charset="UTF-8"/>
		<title>Bienvenue!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<body>
		<?php 	include("function.php"); 
			include("includes/menu_principal.php");
			include("includes/menu_ligues.php");
			$bdd=bdd();
			$query=$bdd->query('SELECT * FROM article INNER JOIN utilisateur ON utilisateur.utilisateur_id=article.auteur_id WHERE id='.$_GET['id'].'');
			$result=$query->fetch();
		?>
		<article id="art_displayer">
			<h1> <?php echo $result['titre'];?></h1>
			<img src="img/<?php echo $result['img_url'];?>"/>
			<p>Par: <?php echo $result['pseudo'];?></p>
			<div id="article_content">
				<?php echo $result['contenu'];?>
			</div>
		</article>
	</body>
</html>