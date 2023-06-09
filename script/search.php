<?php 
    session_start();
    require_once '../script/server.php';
    //  if(isset($_SESSION['id']))
    //      header('Location:./');


// Récupération du terme de recherche
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}

// Requête SQL pour récupérer les résultats de la recherche
$req = $bdd->prepare("SELECT * FROM startups_ideas WHERE title LIKE :search");
$req->execute(array('search' => '%' . $search . '%'));

// Création d'un tableau avec les résultats de la recherche
$results = array();
while ($row = $req->fetch()) {
    $results[] = $row['title'];
}

// Envoi des résultats à la page "pr.php"
header('Location: ../index?search=' . urlencode($search) . '&results=' . urlencode(json_encode($results)));
exit;
?>


?>

