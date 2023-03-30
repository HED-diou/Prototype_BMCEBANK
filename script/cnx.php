<?php
session_start();
require_once 'server.php';

if(isset($_POST))
{
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = htmlspecialchars($_POST['user']);
        $pass = htmlspecialchars($_POST['pass']);

        $check = $bdd->prepare('SELECT * FROM users WHERE lower(email) = lower(:email)');
        $check->execute(array(':email' => $user));
        $data = $check->fetch(PDO::FETCH_OBJ);
        $row = $check->rowCount();

        if($row == 1)
        {   
            if($pass == $data->pass) 
            {
                $_SESSION['name'] = $data->name;
                $_SESSION['email'] = $data->email;
                $_SESSION['id'] = $data->id;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['sudo'] = $data->sudo;
                header('location: ../Dashboard/?login_err=success');die();
             }
            else
               header('Location: ../login.php?login_err=syntax'); die(); 
        }
        else
            header('location: ../login.php?login_err=already');die(); 
    }
    echo "done !";
}
header('location: ../login.php');die(); 
?>