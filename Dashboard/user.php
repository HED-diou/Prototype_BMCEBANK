<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:../login.php?login_err=connexion');
?>
<style>
    .feature {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.feature-inner {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 20px;
  border: 1px solid #ccc;
  margin: 10px;
  width: 300px;
}

.feature-icon {
  width: 50px;
  height: 50px;
  margin-bottom: 10px;
}

.feature-title {
  font-size: 20px;
  margin-bottom: 10px;
}

.text-sm {
  font-size: 14px;
  margin-bottom: 10px;
}

.button {
  margin-top: 5px;
  width:70%;
}

.button-primary {
  background-color: #007bff;
  color: #fff;
  border-color: #007bff;
}




/* .button-wrapper a {
  margin: 5px;
} */


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
      <h1 style="margin-left:20px">Bienvenue <?php echo $_SESSION['name']?></h1>
      <div class="pricing-tables-wrap">
            <div class="pricing-table">
                <div class="pricing-table-inner is-revealing">
                    <div class="pricing-table-main">
                        <div class="pricing-table-header pb-24 ">
                            <!-- <div class="pricing-table-price"><span class="pricing-table-price-currency h2">Connexion</div> -->
                                <div class="pricing-table-cta mb-8">
                                    <a class="button button-primary button-shadow button-block" href="add.php">Ajouter une idee de projet</a>
                                </div>
                        </div>

                        <div class="pricing-table-features list-reset text-xs" style="margin-top: 5mm;">
                            
                        </div>
                    </div>
                    <section class="cta section form-container">
				<div class="container">
					<div class="cta-inner section-inner">
                    <form action="../script/search_p.php" method="get">
                        <input type="text" placeholder="Recherche" style="text-align: center" name="search">
                    </form>
					</div>
				</div>
			</section>
                    
                </div>
            </div>
        </div>


    <section class="features section">
    <div class="container">
        <div class="features-inner section-inner has-bottom-divider">
        <div class="features-wrap">
        <?php
            // Requête SQL pour rechercher des idées de startups en fonction de la recherche
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $req = $bdd->prepare("SELECT startups_ideas.*, users.name FROM startups_ideas INNER JOIN users ON startups_ideas.user_id = users.id WHERE (user_id = :user_id) AND (title LIKE CONCAT('%', :search, '%') OR description LIKE CONCAT('%', :search, '%'))");
            $req->execute(array('search' => $search, 'user_id' => $_SESSION['id']));
            


            while ($row = $req->fetch()) {
            $id = $row['id'];
            $title = $row['title'];
            if(strlen($row['description']) < 100) { $description = str_pad($row['description'], 100, ' ');}
            else {$description = substr($row['description'], 0, 100) . '...';}
            $username = $_SESSION['name'];
            $date = $row['created_at'];
            ?>
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon">
                                            <img src="../dist/images/feature-icon-02.svg" alt="Feature 02">
                                        </div>
                                        <h4 class="feature-title mt-24"><?php echo $title; ?></h4>
                                        <p class="text-sm mb-0"><?php echo $description; ?></p>
                                    </div>
                                    <div class="button-wrapper">
                                    <a class="button button-primary button-shadow button-block" href="idea.php?param=<?php echo $id;?>">Plus d'info</a>
                                    <a href="../script/dell.php?param=<?php echo $id;?>" class="button button-shadow">Supprimer</a>

                                    <!-- <a class="button button-shadow button-block" href="idea.php?param=<?php echo $id;?>">Suprimer</a> -->
                                    
                                </div>
                                </div>
            <?php
            }
            $req->closeCursor();
            ?>
        </div>
    </div>
    </section>
</div>











        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="#">
                            <img class="header-logo-image" src="../dist/images/logo.svg" alt="Logo">
                        </a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">About us</a>
                        </li>
                        <li>
                            <a href="#">FAQ's</a>
                        </li>
                        <li>
                            <a href="#">Support</a>
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Facebook</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#0270D7"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Twitter</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#0270D7"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Google</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z" fill="#0270D7"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright">&copy; 2023 CONEXUS, all rights reserved</div>
                </div>
            </div>
        </footer>
      </div>
    <script src="../dist/js/main.min.js"></script>

</body></html>