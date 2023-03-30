<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../login.php?login_err=connexion');

if(isset($_GET['param'])){
$id_sup = htmlspecialchars($_GET['param']);
// var_dump($_GET['id']);
$supp = $bdd->prepare('DELETE FROM startups_ideas WHERE id = ?');
$supp->execute(array($id_sup ));
header('Location: ../Dashboard/?sup=succes_supp');
die();
}
?>
dell