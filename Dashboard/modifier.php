<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../login.php?login_err=connexion');

// Récupérer l'ID de la startup depuis l'URL
$id = isset($_GET['param']) ? $_GET['param'] : '2';


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

?>
<style>
  input[type="text"],
textarea,
input[type="checkbox"] {
  color: #f7f7f7;
  background-color: #36393F ;
}
</style>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solid Template</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/style.css">
	<link rel="stylesheet" href="../dist/css/my_css.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
<div class="body-wrap">
<?php include '../includes/nav.php'; ?>


<section class="form-container">
  <div class="form-wrapper">
    <form method="POST" action="../script/modif.php">
      <div class="form-group">
        <label for="name">Titre du projet:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="name" name="title" placeholder="Entrez votre titre ici" value="<?php echo htmlspecialchars($title ?? '', ENT_QUOTES); ?>">
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="description" placeholder="parlez nous brievement de votre projet sans donner de detail" rows="3"><?php echo $description?></textarea>
      </div>
      <div class="form-group">
        <label for="message">Piece jointe:</label>
        <input type="file" value="">
        <a class="button" style="width: 10cm;" href="#">Ajouter une piece jointe</a>
      </div>
      <div class="form-group">
        <label for="message">En detail:</label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="message" placeholder="parlez nous en detail de votre projet" rows="3"></textarea>
      </div>
      <div class="form-group">
        <input type="checkbox" name="" id=""> vous aceptez notre <a href="#">politique de confidentialite</a>
      </div>
      <div class="form-group">
        <input type="checkbox" name="" id=""> vous aceptez nos <a href="#">regles d'utilisation</a>
        <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($idd ?? '', ENT_QUOTES); ?>" readonly>
      </div>
      <div class="form-group">
      </div>
      <div class="form-group">
        <button type="submit">Envoyer a examination</button>
      </div>
    </form>
  </div>
</section>




<?php include '../includes/footer.php'; ?>
</div>
<script src="../dist/js/main.min.js"></script>
</body>
</html>