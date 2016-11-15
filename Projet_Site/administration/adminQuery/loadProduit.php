<?php
session_start();
include('../function.php');
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('SELECT * FROM produit 
                    INNER JOIN photo on photo.id_produit = produit.produit_id
                    WHERE produit_id='.$_POST['id'].'');
$result=$query->fetch();
if($result){
    echo json_encode(utf8ize($result));
}
else{
    echo 'Le chargement a échoué';
}
