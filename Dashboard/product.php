<?php 
    session_start();
    require_once '../script/server.php';
     if(!isset($_SESSION['id']))
         header('Location:./login.php?login_err=connexion');

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
  <link rel="stylesheet" href="../dist/css/style.css">
	<link rel="stylesheet" href="../dist/css/my_css.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
  <title>Produit</title>
</head>
<body class=" is-boxed has-animations">
<?php include '../includes/nav.php'; ?>
<div class="max-w-3xl mx-auto mt-8">

<?php 

if(isset($_GET['hajar'])){      
    $err = htmlspecialchars($_GET['hajar']);
    
    switch($err)
    {
        case 'succes':
                            ?>
                                <div class="alert alert-success">
                                    <strong>success</strong> Produit acheté
                                </div>
                                <?php
                            break;
                        }
                }
                ?> 


<div id="chartdiv"></div>
  
    <h2 class="text-2xl font-bold mb-4">Télécharger les ressources</h2>
    <ul class="mb-8">
      <li class="text-blue-500"><a href="file0.pdf" download>Télécharger le business model</a></li>
      <li class="text-blue-500"><a href="file1.pdf" download>Télécharger le plan principal</a></li>
      <li class="text-blue-500"><a href="file2.pdf" download>Télécharger les données des clients</a></li>
      <li class="text-blue-500"><a href="file3.pdf" download>Télécharger la base de données</a></li>
      <li class="text-blue-500"><a href="file4.pdf" download>Télécharger le plan d'exécution</a></li>
      <li class="text-blue-500"><a href="file5.pdf" download>Télécharger le ficher secret</a></li>
    </ul>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .animated-progress {
          width: 300px;
          height: 30px;
          border-radius: 5px;
          margin: 20px 10px;
          border: 1px solid rgb(189, 113, 113);
          overflow: hidden;
          position: relative;
        }
        
        .animated-progress span {
          height: 100%;
          display: block;
          width: 0;
          color: rgb(255, 251, 251);
          line-height: 30px;
          position: absolute;
          text-align: end;
          padding-right: 5px;
        }
        
        .progress-blue span {
          background-color: blue;
        }
        .progress-green span {
          background-color: green;
        }
        .progress-purple span {
          background-color: indigo;
        }
        .progress-red span {
          background-color: red;
        }
        </style>
        <h2>Avancement du projet</h2>
        <!--Start Animated Progress Bar-->

              <div class="animated-progress progress-green">
                <span data-progress="60"></span>
              </div>


        <!--End Animated Progress Bar-->
        <script>
        $(".animated-progress span").each(function () {
          $(this).animate(
            {
              width: $(this).attr("data-progress") + "%",
            },
            1000
          );
          $(this).text($(this).attr("data-progress") + "%");
        });
        </script>

<div class="flex flex-row gap-4">
  <a href="https://businessmodelanalyst.com/wp-content/uploads/2020/07/Facebook-Business-Model-Canvas.001-1024x576.jpeg" class="w-1/3">
    <img src="https://businessmodelanalyst.com/wp-content/uploads/2020/07/Facebook-Business-Model-Canvas.001-1024x576.jpeg" alt="" class="h-64 object-contain">
  </a>
  <a href="../img/img1.png" class="w-1/3">
    <img src="../img/img1.png" alt="" class="h-64 object-contain">
  </a>
  <a href="../img/img2.png" class="w-1/3">
    <img src="../img/img2.png" alt="" class="h-64 object-contain">
  </a>
</div>
<h2 class="text-2xl font-bold mb-4">Data privé du programe</h2>
 
<script src="https://www.amcharts.com/lib/3/amcharts.js?x"></script>
<script src="https://www.amcharts.com/lib/3/serial.js?x"></script>
<script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
<style>




    /* body{
  background-color: #161616;  
} */

#chartdiv {	
   width		: 100%;
	height		: 500px;
	/* background-color: #161616;   */
}

.amcharts-graph-g2 .amcharts-graph-stroke {
  stroke-dasharray: 3px 3px;
  stroke-linejoin: round;
  stroke-linecap: round;
  -webkit-animation: am-moving-dashes 1s linear infinite;
  animation: am-moving-dashes 1s linear infinite;
}

@-webkit-keyframes am-moving-dashes {
  100% {
    stroke-dashoffset: -31px;
  }
}
@keyframes am-moving-dashes {
  100% {
    stroke-dashoffset: -31px;
  }
}


.lastBullet {
  -webkit-animation: am-pulsating 1s ease-out infinite;
  animation: am-pulsating 1s ease-out infinite;
}
@-webkit-keyframes am-pulsating {
  0% {
    stroke-opacity: 1;
    stroke-width: 0px;
  }
  100% {
    stroke-opacity: 0;
    stroke-width: 50px;
  }
}
@keyframes am-pulsating {
  0% {
    stroke-opacity: 1;
    stroke-width: 0px;
  }
  100% {
    stroke-opacity: 0;
    stroke-width: 50px;
  }
}

.amcharts-graph-column-front {
  -webkit-transition: all .3s .3s ease-out;
  transition: all .3s .3s ease-out;
}
.amcharts-graph-column-front:hover {
  fill: #496375;
  stroke: #496375;
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
}

.amcharts-graph-g3 {
  stroke-linejoin: round;
  stroke-linecap: round;
  stroke-dasharray: 500%;
  stroke-dasharray: 0 \0/;    /* fixes IE prob */
  stroke-dashoffset: 0 \0/;   /* fixes IE prob */
  -webkit-animation: am-draw 40s;
  animation: am-draw 40s;
}
@-webkit-keyframes am-draw {
    0% {
        stroke-dashoffset: 500%;
    }
    100% {
        stroke-dashoffset: 0%;
    }
}
@keyframes am-draw {
    0% {
        stroke-dashoffset: 500%;
    }
    100% {
        stroke-dashoffset: 0%;
    }
}
						
</style>




<script>
    var chartData = [
    {
        "date": "2012-01-01",
        "distance": 227,
        "townName": "New York",
        "townName2": "New York",
        "townSize": 25,
        "latitude": 40.71,
        "duration": 408
    },
    {
        "date": "2012-01-02",
        "distance": 371,
        "townName": "Washington",
        "townSize": 14,
        "latitude": 38.89,
        "duration": 482
    },
    {
        "date": "2012-01-03",
        "distance": 433,
        "townName": "Wilmington",
        "townSize": 6,
        "latitude": 34.22,
        "duration": 562
    },
    {
        "date": "2012-01-04",
        "distance": 345,
        "townName": "Jacksonville",
        "townSize": 7,
        "latitude": 30.35,
        "duration": 379
    },
    {
        "date": "2012-01-05",
        "distance": 480,
        "townName": "Miami",
        "townName2": "Miami",
        "townSize": 10,
        "latitude": 25.83,
        "duration": 501
    },
    {
        "date": "2012-01-06",
        "distance": 386,
        "townName": "Tallahassee",
        "townSize": 7,
        "latitude": 30.46,
        "duration": 443
    },
    {
        "date": "2012-01-07",
        "distance": 348,
        "townName": "New Orleans",
        "townSize": 10,
        "latitude": 29.94,
        "duration": 405
    },
    {
        "date": "2012-01-08",
        "distance": 238,
        "townName": "Houston",
        "townName2": "Houston",
        "townSize": 16,
        "latitude": 29.76,
        "duration": 309
    },
    {
        "date": "2012-01-09",
        "distance": 218,
        "townName": "Dalas",
        "townSize": 17,
        "latitude": 32.8,
        "duration": 287
    },
    {
        "date": "2012-01-10",
        "distance": 349,
        "townName": "Oklahoma City",
        "townSize": 11,
        "latitude": 35.49,
        "duration": 485
    },
    {
        "date": "2012-01-11",
        "distance": 603,
        "townName": "Kansas City",
        "townSize": 10,
        "latitude": 39.1,
        "duration": 890
    },
    {
        "date": "2012-01-12",
        "distance": 534,
        "townName": "Denver",
        "townName2": "Denver",
        "townSize": 18,
        "latitude": 39.74,
        "duration": 810
    },
    {
        "date": "2012-01-13",
        "townName": "Salt Lake City",
        "townSize": 12,
        "distance": 425,
        "duration": 670,
        "latitude": 40.75,
        "alpha":0.4
    },
    {
        "date": "2012-01-14",
        "latitude": 36.1,
        "duration": 470,
        "townName": "Las Vegas",
        "townName2": "Las Vegas",
        "bulletClass": "lastBullet"
    },
    {
        "date": "2012-01-15"
    },
    {
        "date": "2012-01-16"
    },
    {
        "date": "2012-01-17"
    },
    {
        "date": "2012-01-18"
    },
    {
        "date": "2012-01-19"
    }
];
var chart = AmCharts.makeChart("chartdiv", {
  type: "serial",
  theme: "dark",
  dataDateFormat: "YYYY-MM-DD",
  dataProvider: chartData,

  addClassNames: true,
  startDuration: 1,
  color: "#FFFFFF",
  marginLeft: 0,

  categoryField: "date",
  categoryAxis: {
    parseDates: true,
    minPeriod: "DD",
    autoGridCount: false,
    gridCount: 50,
    gridAlpha: 0.1,
    gridColor: "#FFFFFF",
    axisColor: "#1a53ff",
    dateFormats: [{
        period: 'DD',
        format: 'DD'
    }, {
        period: 'WW',
        format: 'MMM DD'
    }, {
        period: 'MM',
        format: 'MMM'
    }, {
        period: 'YYYY',
        format: 'YYYY'
    }]
  },

  valueAxes: [{
    id: "a1",
    title: "distance",
    gridAlpha: 0,
    axisAlpha: 0
  },{
    id: "a2",
    position: "right",
    gridAlpha: 0,
    axisAlpha: 0,
    labelsEnabled: false
  },{
    id: "a3",
    title: "duration",
    position: "right",
    gridAlpha: 0,
    axisAlpha: 0,
    inside: true,
    duration: "mm",
    durationUnits: {
        DD: "d. ",
        hh: "h ",
        mm: "min",
        ss: ""
    }
  }],
  graphs: [{
    id: "g1",
    valueField:  "distance",
    title:  "distance",
    type:  "column",
    fillAlphas:  0.9,
    valueAxis:  "a1",
    balloonText:  "[[value]] miles",
    legendValueText:  "[[value]] mi",
    legendPeriodValueText:  "total: [[value.sum]] mi",
    lineColor:  "#1a53ff",
    alphaField:  "alpha",
  },{
    id: "g2",
    valueField: "latitude",
    classNameField: "bulletClass",
    title: "latitude/city",
    type: "line",
    valueAxis: "a2",
    lineColor: "#1a53ff",
    lineThickness: 1,
    legendValueText: "[[description]]/[[value]]",
    descriptionField: "townName",
    bullet: "round",
    bulletSizeField: "townSize",
    bulletBorderColor: "#1a53ff",
    bulletBorderAlpha: 1,
    bulletBorderThickness: 2,
    bulletColor: "#000000",
    labelText: "[[townName2]]",
    labelPosition: "right",
    balloonText: "latitude:[[value]]",
    showBalloon: true,
    animationPlayed: true,
  },{
    id: "g3",
    title: "duration",
    valueField: "duration",
    type: "line",
    valueAxis: "a3",
    lineColor: "#ff5755",
    balloonText: "[[value]]",
    lineThickness: 1,
    legendValueText: "[[value]]",
    bullet: "square",
    bulletBorderColor: "#ff5755",
    bulletBorderThickness: 1,
    bulletBorderAlpha: 1,
    dashLengthField: "dashLength",
    animationPlayed: true
  }],

  chartCursor: {
    zoomable: false,
    categoryBalloonDateFormat: "DD",
    cursorAlpha: 0,
    valueBalloonsEnabled: false
  },
  legend: {
    bulletType: "round",
    equalWidths: false,
    valueWidth: 120,
    useGraphSettings: true,
    color: "#000000"
  }
});
</script>	

<?php include '../includes/footer.php'; ?>
</body>
</html>
``
