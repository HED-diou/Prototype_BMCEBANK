<?php
session_start();
require_once '../files/server.php';
     if(!isset($_SESSION['id']))
        header('Location:../index.php?login_err=connexion');

if(isset($_GET['id'])){
$id_sup = htmlspecialchars($_GET['id']);
// var_dump($_GET['id']);
$supp = $bdd->prepare('DELETE FROM startups_ideas WHERE id = ?');
$supp->execute(array($id_sup ));
header('Location: Dashboard.php?sup=succes_supp');
die();
}
?>