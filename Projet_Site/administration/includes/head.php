<?php
// ici je me suis fait un header pour toutes les pages du forum qui devraient etre générés automatiquement depuis script + BDD doncvoilà ;)
	//initialisation de la session
	session_start();
	include 'function.php';
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
	<meta charset="UTF-8"/>
	<?php echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Forum </title>'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>
	<?php include("includes/menu_principal.php"); ?>
	<?php include("includes/menu_ligues.php"); ?>

