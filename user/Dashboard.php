<?php 
    session_start();
    require_once '../files/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../index.php?login_err=connexion');
?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <title>StartupRecycle Dashboard</title>
</head>
<body>
   --> 
 <!-- <ul>
  <li>id : <?php echo $_SESSION['id']; ?></li>
  <li>name : <?php echo $_SESSION['name']; ?></li>
  <li>email : <?php echo $_SESSION['email']; ?></li>
  <li>sudo : <?php echo $_SESSION['sudo']; ?></li>
  <li>ip : <?php echo $_SESSION['ip']; ?></li>
</ul>  -->
<!-- 


<br><br><hr><br><br>

<h1>Dashboard</h1>

<form action="add_idea.php" method="post">
    <button type="submit">add new idea</button>
</form>


<h2>My ideas</h2>

<form action="deconexion.php" method="post">
    <button type="submit">deconnexion</button>
</form>

<br><br><hr><br><br> -->


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ma page de démarrage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    
</head>
  <body>

  
  <?php include '../files/nav.php'; ?>
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6">
          <h2>Ajouter un élément</h2>
          <form method="post" action="ajouter.php">
            <div class="form-group">
              <label for="titre">Titre</label>
              <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
        </div>
        <div class="col-md-6">
          <h2>Liste des éléments</h2>
          <!-- <?php
            // Connexion à la base de données
            // $bdd = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees;charset=utf8', 'nom_utilisateur', 'mot_de_passe');
            
            // Récupération des éléments
            $user_id = $_SESSION['id'];
            $elements = $bdd->query("SELECT * FROM startups_ideas WHERE user_id = $user_id");
            
            // Affichage des éléments sous forme de liste
            echo '<ul>';
            while ($element = $elements->fetch()) {
              echo '<li><strong>' . htmlspecialchars($element['title']) . '</strong>: ' . htmlspecialchars($element['description']) . '</li>';
            }
            echo '</ul>';
          ?> -->
          
<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    // Requête SQL pour rechercher des idées de startups en fonction de la recherche
    $user_id = $_SESSION['id'];
    $req = $bdd->query("SELECT * FROM startups_ideas WHERE user_id = $user_id");

    while ($row = $req->fetch()) {
        $id = $row['id'];
        $title = $row['title'];
        $description = substr($row['description'], 0, 100) . '...';
        $username = $_SESSION['name'];
        $date = $row['created_at'];
    ?>
        <li class="bg-white shadow overflow-hidden rounded-md">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4"><?php echo $title; ?></h2>
                <p class="text-gray-700 mb-4"><?php echo $description; ?></p>
                <p class="text-gray-500 text-sm">Proposé par <?php echo $username; ?></p>
            </div>
            <div class="px-6 py-4 bg-gray-100">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="idea.php?param=<?php echo $id;?>">Lire la suite</a>
            </div>
            <!-- <form class="px-6 py-4 bg-gray-100" methode=get>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lire la suite</button>
            </form> -->
        </li>
    <?php
    }
    $req->closeCursor();
    ?>
</ul>
          
        </div>
      </div>
    </div>


    <!-- <form method="post" action="deconnexion.php">
            <button type="submit" class="btn btn-danger">Déconnexion</button>
          </form> -->
    <?php include '../files/footer.php'; ?>
  </body>
</html>





</body>
</html>