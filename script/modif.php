<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../login.php?login_err=connexion');

// var_dump($_POST['id']);
// var_dump( $_POST['description']);
// var_dump($_POST['title']);

        if(isset($_POST['id'])){
            $id_sup = htmlspecialchars($_POST['id']);
            // var_dump($_GET['id']);
            $supp = $bdd->prepare('UPDATE `startups_ideas` SET `title` = ? , `description` = ? WHERE `startups_ideas`.`id` = ?;');
            $supp->execute(array($_POST['title'], $_POST['description'], $id_sup ));
        }


header('Location: ../Dashboard/user?sup=succes_supp');
die();

?>