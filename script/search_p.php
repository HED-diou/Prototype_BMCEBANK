<?php 
    session_start();
    require_once '../script/server.php';
     if(isset($_SESSION['id']))
         header('Location:./');


// Récupération du terme de recherche
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}

// Requête SQL pour récupérer les résultats de la recherche
$req = $bdd->prepare("SELECT startups_ideas.*, users.name FROM startups_ideas INNER JOIN users ON startups_ideas.user_id = users.id WHERE (user_id = :user_id) AND (title LIKE CONCAT('%', :search, '%') OR description LIKE CONCAT('%', :search, '%'))");
$req->execute(array('user_id' => $_SESSION["id"], 'search' => '%' . $search . '%'));


// Création d'un tableau avec les résultats de la recherche
$results = array();
while ($row = $req->fetch()) {
    $results[] = $row['title'];
}

// Envoi des résultats à la page "pr.php"
header('Location: ../Dashboard/?search=' . urlencode($search) . '&results=' . urlencode(json_encode($results)));
exit;
?>


?>

