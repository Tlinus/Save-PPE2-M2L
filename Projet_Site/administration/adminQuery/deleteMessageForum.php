<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('DELETE FROM msg_forum WHERE message_id='.$_POST['id'].'');
if($query){
    echo'Suppression message: Le message a été supprimée.';
}
else{
    echo'Suppression message: Le message n\'a pas pu être supprimée.';
}