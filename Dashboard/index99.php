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
	<header class="header">
		<div class="logo">
		  <a href="#"><img src="../dist/images/logo.svg" alt="Logo"></a>
		</div>
		<nav class="nav">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i></a></li>
            
            <?php if(isset($_SESSION['id'])) { ?>
                <li><a href="script/deconexion">Déconnexion</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Home</a></li>
            <?php } if(!isset($_SESSION['id'])) { ?>
                <li><a href="Dashboard/login">Connexion</a></li>
                <li><a href="script/deconexion">Déconnexion</a></li>
            <?php }?>
        </ul>
		</nav>
	  </header>
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
							<a href="#">
								<img class="header-logo-image" src="../dist/images/logo.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Conexus</h1>
	                        <p class="hero-paragraph">Bienvenue sur notre plateforme de vente, d'investissement et d'achat d'idées de startup. Nous sommes une plateforme en ligne qui met en relation des entrepreneurs innovants avec des investisseurs et des acheteurs potentiels.</p>
	                        <div class="hero-cta"><a class="button button-primary" href="#">Découvrir</a><a class="button" href="#">Je suis un habitué</a></div>
						</div>
						<div class="hero-figure anime-element">
							<svg class="placeholder" width="528" height="396" viewBox="0 0 528 396">
								<rect width="528" height="396" style="fill:transparent;" />
							</svg>
							<div class="hero-figure-box hero-figure-box-01" data-rotation="45deg"></div>
							<div class="hero-figure-box hero-figure-box-02" data-rotation="-45deg"></div>
							<div class="hero-figure-box hero-figure-box-03" data-rotation="0deg"></div>
							<div class="hero-figure-box hero-figure-box-04" data-rotation="-135deg"></div>
							<div class="hero-figure-box hero-figure-box-05"></div>
							<div class="hero-figure-box hero-figure-box-06"></div>
							<div class="hero-figure-box hero-figure-box-07"></div>
							<div class="hero-figure-box hero-figure-box-08" data-rotation="-22deg"></div>
							<div class="hero-figure-box hero-figure-box-09" data-rotation="-52deg"></div>
							<div class="hero-figure-box hero-figure-box-10" data-rotation="-50deg"></div>
						</div>
                    </div>
                </div>
            </section>
            <section class="cta section form-container">
				<div class="container">
					<div class="cta-inner section-inner">
						<h3 class="section-title mt-0">Nous vous offrent le meilleur</h3>
						<div class="cta-cta">
                            <input type="text" placeholder="Recherche" style="text-align: center">
							<!-- <a class="button button-primary button-wide-mobile" href="#">Découvrir</a> -->
						</div>
					</div>
				</div>
			</section>
            <section class="features section">
                <div class="container">
					<div class="features-inner section-inner has-bottom-divider">
                        <div class="features-wrap">

                            <?php
                            // Requête SQL pour rechercher des idées de startups en fonction de la recherche
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $req = $bdd->prepare("SELECT startups_ideas.*, users.name FROM startups_ideas INNER JOIN users ON startups_ideas.user_id = users.id WHERE title LIKE CONCAT('%', :search, '%') OR description LIKE CONCAT('%', :search, '%')");
                            $req->execute(array('search' => $search));
                        
                            while ($row = $req->fetch()) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = substr($row['description'], 0, 100) . '...';
                                $username = $row['name'];
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
                                <div class="button-wrapper ">
                                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="idea.php?param=<?php echo $id;?>">Lire la suite</a>
                                </div>
                            </div>
                            <?php
                            }
                            $req->closeCursor();
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pricing section">
                <div class="container-sm">
                    <div class="pricing-inner section-inner">
                        <div class="pricing-header text-center">
                            <h2 class="section-title mt-0">Unlimited for all</h2>
                            <p class="section-paragraph mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut ad quis nostrud.</p>
                        </div>
						<div class="pricing-tables-wrap">
                            <div class="pricing-table">
                                <div class="pricing-table-inner is-revealing">
                                    <div class="pricing-table-main">
                                        <div class="pricing-table-header pb-24">
                                            <div class="pricing-table-price"><span class="pricing-table-price-currency h2">$</span><span class="pricing-table-price-amount h1">49</span><span class="text-xs">/year</span></div>
                                        </div>
										<div  class="pricing-table-features-title text-xs pt-24 pb-24">Ce que vous obtiendrez</div>
                                        <ul class="pricing-table-features list-reset text-xs">
                                            <li>
                                                <span>Vendez votre idée.</span>
                                            </li>
                                            <li>
                                                <span>Investissez dans des projets.</span>
                                            </li>
                                            <li>
                                                <span>Économisez temps et argent.</span>
                                            </li>
											<li>
												<span>Investissez rentablement.</span>
											</li>
                                        </ul>
                                    </div>
                                    <div class="pricing-table-cta mb-8">
                                        <a class="button button-primary button-shadow button-block" href="#">Commencez dès maintenant</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			
        </main>

        <?php include '../includes/footer.php'; ?>

    </div>

    <script src="../dist/js/main.min.js"></script>
</body>
</html>
