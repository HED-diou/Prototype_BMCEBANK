<?php 
    session_start();
    require_once '../script/server.php';
     if(isset($_SESSION['id']))
         header('Location:./');
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

<body class="has-animations">
	

	  <div class="body-wrap">
	  
	<main class="body-wrap">
		<section class="hero">
			<div class="container">
				<div class="hero-inner">
					<div class="pricing-tables-wrap">
						<div class="pricing-table">
							<div class="pricing-table-inner is-revealing">
								<div class="pricing-table-main">
									<div class="pricing-table-header pb-24">
										<div class="pricing-table-price"><span class="pricing-table-price-currency h2">Connexion</div>
									</div>

									<form class="pricing-table-features list-reset text-xs" style="margin-top: 5mm;" method="post" action="../script/cnx.php">
										<ul>
											<input name="user" type="email" placeholder="email">
										</ul>
										<ul>
											<input name="pass" type="password" placeholder="password">
										</ul>
										<ul>
											<input type="checkbox" name="" id=""> <span style="margin-left: 5mm;">Se souvenir de moi</span>
										</ul>
										<ul style="margin-top: -5mm;">
											<input type="checkbox" name="" id=""> <span style="margin-left: 5mm;">Copyright</span>
										</ul>
										<div class="pricing-table-cta mb-8">
											<input type="submit" value="Connexion" class="button button-primary button-shadow">
											<!-- <button type=submit value="Connexion" class="button button-primary button-shadow button-block" href="#">Connexion</button> -->
										</div>
									</form>
								</div>
								
							</div>
						</div>
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
	</main>

	<?php include '../includes/footer.php'; ?>
</div>
	<script src="../dist/js/main.min.js"></script>
</body>



</html>