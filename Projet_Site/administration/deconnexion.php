<?php
	// easy on detruit juste tout les parametres de sessino
	session_start();
	
	session_unset();
	session_destroy();
	header('Location: index.php');
	?>