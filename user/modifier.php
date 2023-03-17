<?php
session_start();
require_once '../files/server.php';
     if(!isset($_SESSION['id']))
        header('Location:../index.php?login_err=connexion');





        $id = isset($_GET['id']) ? $_GET['id'] : '2';


        // Requête SQL pour récupérer toutes les informations de la startup en fonction de l'ID
        $req = $bdd->prepare("SELECT startups_ideas.*, users.name FROM startups_ideas INNER JOIN users ON startups_ideas.user_id = users.id WHERE startups_ideas.id = ?");
        $req->execute(array($id));
        $row = $req->fetch();
        
        // Récupérer les informations de la startup depuis la base de données
        $title = $row['title'];
        $description = $row['description'];
        $username = $row['name'];
        $id = $_SESSION['id'];
        $user_id = $row['user_id'];
        $idd = $row['id'];
        $date = $row['updated_at'];


// var_dump($title);
// var_dump($description);




?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page avec deux champs d'entrée</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.1.2/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-10">
        <form method="POST" action="modification.php">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">
                    Titre
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Entrez votre titre ici" value="<?php echo htmlspecialchars($title ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">
                    Description
                </label>
                <textarea style="height: auto; min-height: 100px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Entrez votre description ici"><?php echo $description?></textarea>
            </div>
            <input id="id" name="id" type="text" value="<?php echo htmlspecialchars($idd ?? '', ENT_QUOTES); ?>" readonly>
            <div class="mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</body>
</html>