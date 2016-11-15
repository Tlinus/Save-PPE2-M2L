<?php session_start();?>
<!DOCTYPE html>
<html class="scroller">
	<head>
		<link rel="stylesheet" type="text/css" href="main.css">
		<meta charset="UTF-8"/>
		<title>Bienvenue!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="JQuery/slideshow_boutons.js"></script>
		<script type="text/javascript" src="JQuery/slideshow.js"></script>
	</head>
	<body>
		<?php include("function.php"); ?>
		<?php include("includes/menu_principal.php");?>
		<?php include("includes/menu_ligues.php"); ?>
			<section id="wrapper">
				<ul id="diaporama">
			<?php
				$bdd=bdd();
				$query=$bdd->query('SELECT * FROM article ORDER BY date DESC LIMIT 0,5');
				for($i=0;$i<5;$i++){
					$result=$query->fetch();
			?>
					<li>
						<a href="displayArticle.php?id=<?php echo $result['id'];?>"><img src="img/<?php echo $result['img_url'];?>"/></a>
						<p>
							<?php echo utf8_encode($result['extrait']);?>
						</p>
					</li>
			<?php
				}
			?>
				</ul>
				<ul id="index_defilement">
					<li><img src="img/index_defil_on.png" id="bouton_defil1"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil2"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil3"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil4"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil5"/></li>
				</ul>
				<div id="defilement">
					<a href="javascript:diaposScroll(-1)" title="Diapo précédente" class="precedente"> <img src="img/precedent_diap.png" id="img_prec"/></a>
					<a href="javascript:diaposScroll(1)" title="Diapo suivante" class="suivante"><img src="img/suivant_diap.png" id="img_suiv"/> </a>
				</div>
			</section>
	</body>
</html>