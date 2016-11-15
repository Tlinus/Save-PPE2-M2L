<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('DELETE FROM article WHERE id='.$_POST['id'].'');
if($query){
    echo 'Suppression réussie';
}
else{
    echo 'La suppression a échoué';
}