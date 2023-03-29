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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
	<!-- <link rel="stylesheet" href="../dist/css/my_css.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

    <title>Achat</title>
</head>
<body>
    
<header class="header">
		<div class="logo">
		  <a href="../"><img src="../dist/images/logo.svg" alt="Logo"></a>
		</div>
		<nav class="nav">
		  <ul>
			<li><a href="../"><i class="fas fa-home"></i></a></li>
			<li><a href="../">Dashboard</a></li>
			<li><a href="../script/user">Home</a></li>
			<li><a href="../script/deconexion">Déconnexion</a></li>
		  </ul>
		</nav>
</header>
<style>
    .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #161c29;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .logo img {
    width: 50px;
  }
  
  .nav ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .nav li {
    margin: 0 10px;
  }
  
  .nav a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #444;
    transition: color 0.3s ease-in-out;
  }
  
  .nav a:hover {
    color: #000;
  }
  
  .fa-home {
    font-size: 1.2rem;
    margin-right: 5px;
  }

  .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  
  .form-wrapper {
    width: 80%;
    max-width: 1200px;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    /* background-color: #fff; */
  }
  
  .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
  }
  
  label {
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  input[type="text"],
  textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }
  
  button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }
  
  button[type="submit"]:hover {
    background-color: #0069d9;
  }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

.container {
    margin: 30px auto;
}

.container .card {
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background: #fff;
    border-radius: 0px;
}

body {
    background-color: #242830 ;
  color: #8e7777;
}



.btn.btn-primary {
    background-color: #ddd;
    color: black;
    box-shadow: none;
    border: none;
    font-size: 20px;
    width: 100%;
    height: 100%;
}

.btn.btn-primary:focus {
    box-shadow: none;
}

.container .card .img-box {
    width: 80px;
    height: 50px;
}

.container .card img {
    width: 100%;
    object-fit: fill;
}

.container .card .number {
    font-size: 24px;
}

.container .card-body .btn.btn-primary .fab.fa-cc-paypal {
    font-size: 32px;
    color: #3333f7;
}

.fab.fa-cc-amex {
    color: #1c6acf;
    font-size: 32px;
}

.fab.fa-cc-mastercard {
    font-size: 32px;
    color: red;
}

.fab.fa-cc-discover {
    font-size: 32px;
    color: orange;
}

.c-green {
    color: green;
}

.box {
    height: 40px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ddd;
}

.btn.btn-primary.payment {
    background-color: #1c6acf;
    color: white;
    border-radius: 0px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 24px;
}


.form__div {
    height: 50px;
    position: relative;
    margin-bottom: 24px;
}

.form-control {
    width: 100%;
    height: 45px;
    font-size: 14px;
    border: 1px solid #DADCE0;
    border-radius: 0;
    outline: none;
    padding: 2px;
    background: none;
    z-index: 1;
    box-shadow: none;
}

.form__label {
    position: absolute;
    left: 16px;
    top: 10px;
    background-color: #fff;
    color: #80868B;
    font-size: 16px;
    transition: .3s;
    text-transform: uppercase;
}

.form-control:focus+.form__label {
    top: -8px;
    left: 12px;
    color: #1A73E8;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
    top: -8px;
    left: 12px;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:focus {
    border: 1.5px solid #1A73E8;
    box-shadow: none;
}
    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
        <div class="row">
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold" for="">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/mastercard-png/file-mastercard-logo-svg-wikimedia-commons-4.png"
                            alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/discover-png-logo/credit-cards-discover-png-logo-4.png"
                            alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4" style="color:black">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">PayPal</span>
                                <span class="fab fa-cc-paypal">
                                </span>
                            </a>
                        </p>
                        <div class="collapse p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-8">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of
                                            product</span></p>
                                    <p class="mb-0"><span class="fw-bold">Price:</span><span
                                            class="c-green">:$452.90</span></p>
                                    <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque
                                        nihil neque
                                        quisquam aut
                                        repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab
                                        quis,
                                        iste harum ipsum hic, nemo qui!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Credit Card</span>
                                <span class="">
                                    <span class="fab fa-cc-amex"></span>
                                    <span class="fab fa-cc-mastercard"></span>
                                    <span class="fab fa-cc-discover"></span>
                                </span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-lg-5 mb-lg-0 mb-3">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of
                                            product</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Price:</span>
                                        <span class="c-green">:$452.90</span>
                                    </p>
                                    <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque
                                        nihil neque
                                        quisquam aut
                                        repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab
                                        quis,
                                        iste harum ipsum hic, nemo qui!</p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">Card Number</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">MM / yy</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="password" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">cvv code</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">name on the card</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn btn-primary w-100">Sumbit</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <form class="bg-gray-100 p-4 rounded-lg">
                    <label class="block text-gray-700 font-bold mb-2" for="copyright">
                    Copyright
                    </label>
                    <textarea rows=10 style="height: auto; min-height: 100px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="copyright">
                    © 2023 Conexus. Tous droits réservés.

En effectuant un paiement sur notre site, vous acceptez notre politique des droits de possession d'idées. Cette politique vise à protéger les idées, les concepts et les propriétés intellectuelles de notre entreprise, ainsi que celles de nos clients et partenaires.

En acceptant notre politique des droits de possession d'idées, vous reconnaissez que toute idée, concept ou propriété intellectuelle présenté(e) dans le cadre de nos services ou produits demeure la propriété de [Nom de l'entreprise] ou de ses clients et partenaires respectifs. Vous vous engagez à ne pas reproduire, distribuer, vendre, modifier, adapter ou utiliser de quelque manière que ce soit ces idées, concepts ou propriétés intellectuelles sans notre autorisation écrite préalable.

Nous vous remercions de votre confiance et de votre respect envers notre politique des droits de possession d'idées.
                    </textarea>
                    <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" />
                        <span class="ml-2 text-gray-700">J'accepte les termes et conditions</span>
                    </label>
                    </div>
                </form>
            </div>

            <form class="col-12" methode=get action="product.php?hajar=succes">
                <a href="product.php?hajar=succes" class="btn btn-primary payment" type=submit>Make Payment </a>
                <!-- </button> -->
            </form>
        </div>
    </div>


    <?php include '../includes/footer.php'; ?>

</body>
</html>