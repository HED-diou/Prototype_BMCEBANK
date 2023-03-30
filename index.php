<?php 
    session_start();
    require_once './script/server.php';

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conexxus</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="./dist/css/style.css">
	<link rel="stylesheet" href="./dist/css/my_css.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link rel="icon" href="dist/images/logo.svg" >
    <link rel="shortcut icon" href="dist/images/logo.svg" >
</head>
<body class="is-boxed has-animations">
	<header class="header">
		<div class="logo">
		  <a href="./"><img src="./dist/images/logo.svg" alt="Logo"></a>
		</div>
		<nav class="nav">
        <ul>
            <li><a href="./"><i class="fas fa-home"></i></a></li>
            
            <?php if(isset($_SESSION['id'])) { ?>
                <li><a href="">Dashboard</a></li>
                <li><a href="Dashboard/">Home</a></li>
                <li><a href="script/deconexion">Déconnexion</a></li>
            <?php } if(!isset($_SESSION['id'])) { ?>
                <li><a href="Dashboard/login">Connexion</a></li>
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
								<img class="header-logo-image" src="./dist/images/logo.svg" alt="Logo">
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
                        <?php if(!isset($_SESSION['id'])) { ?>
	                        <p class="hero-paragraph">Bienvenue sur notre plateforme de vente, d'investissement et d'achat d'idées de startup. Nous sommes une plateforme en ligne qui met en relation des entrepreneurs innovants avec des investisseurs et des acheteurs potentiels.</p>
	                        <div class="hero-cta"><a class="button button-primary" href="#">Découvrir</a><a class="button" href="#">Je suis un habitué</a></div>
                        <?php }?>
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
						<form class="cta-cta" action="./script/search.php" method="get">
                            <input name="search" type="text" placeholder="Recherche" style="text-align: center">
							<!-- <a class="button button-primary button-wide-mobile" href="#">Découvrir</a> -->
						</form>
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
                                            <img src="./dist/images/feature-icon-02.svg" alt="Feature 02">
                                        </div>
                                        <h4 class="feature-title mt-24"><?php echo $title; ?></h4>
                                        <p class="text-sm mb-0"><?php echo $description; ?></p>
                                    </div>
                                    <p class="text-gray-500 text-sm">Proposé par <?php echo $username; ?></p>
                                    <div class="button-wrapper">
                                    <a class="button button-primary button-shadow button-block" href="./Dashboard/idea.php?param=<?php echo $id;?>">Lire la suite</a>
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
            <?php if(!isset($_SESSION['id'])) { ?>
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
                </div><?php }?>
            </section>

			
        </main>
        <section class="cta section form-container">
				<div class="container">
					<div class="cta-inner section-inner">
						<h3 class="section-title mt-0">Toujour pas convincu ?</h3>
						<div class="cta-cta">
                            <!-- <input type="text" placeholder="Recherche" style="text-align: center"> -->
							<a class="button button-primary button-wide-mobile" href="#">Découvrir</a>
						</div>
					</div>
				</div>
			</section>
        <footer class="site-footer">
		<div class="container">
			<div class="site-footer-inner">
				<div class="brand footer-brand">
					<a href="#">
						<img class="header-logo-image" src="./dist/images/logo.svg" alt="Logo">
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

    <script src="./dist/js/main.min.js"></script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
