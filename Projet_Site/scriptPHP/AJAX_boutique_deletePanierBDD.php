<?php
	session_start();
	include'../includes/panier_class.php';
	$panier=new panier;
	$panier->deleteProduitCookie();
?>