<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../login.php?login_err=connexion');



var_dump($_SESSION['id']);
var_dump($_SESSION['name']);


if(isset($_POST['description']))
{
    
    $id_client = $_SESSION['id'];
    //var_dump($_SESSION['id']);die();
    $nom_client = $_SESSION['name'];
    $title = htmlspecialchars($_POST['titre']);
    $message = htmlspecialchars($_POST['description']);
    if(strlen($message) <= 10000)
    {
        $id_message = null;$date=null;
        $insert = $bdd->prepare("INSERT INTO `startups_ideas` (`title`, `description`, `user_id`) VALUES (:title, :description, :user_id)");
        $insert->execute(array(
                ':title' => $title,
                ':description' => $message,
                ':user_id' => $_SESSION['id']
            ));
            header('Location:../Dashboard/user?login_err=success');
            die();
    }
    
}
header('Location:../Dashboard/user');
die();



?>