<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:./login.php?login_err=connexion');
?>

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
<?php include '../includes/nav.php'; ?>


          <section class="form-container">
            <div class="form-wrapper">
              <form method=post action="../script/adding.php">
                <div class="form-group">
                  <label for="name">Titre du projet:</label>
                  <input type="text" id="name" name="titre" placeholder="En un mot ou une phrase">
                </div>
                <div class="form-group">
                  <label for="message">Message:</label>
                  <textarea id="message" name="description" placeholder="parlez nous brievement de votre projet sans donner de detail" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="message">Piece jointe:</label>
                    <input type="file" value="">
                    <a class="button" style="width: 10cm;" href="#">Ajouter une piece jointe</a>
                </div>
                <div class="form-group">
                    <label for="message">En detail:</label>
                  <textarea id="message" name="message" placeholder="parlez nous en detail de votre projet" rows="3"></textarea>
                </div>
                <div class="form-group"></div>
                <input type="checkbox" name="" id=""> vous aceptez notre <a href="#">politique de confidentialite</a>
                <div class="form-group"></div>
                <input type="checkbox" name="" id=""> vous aceptez nos <a href="#">regles d'utilisation</a>
                <div class="form-group"></div>
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