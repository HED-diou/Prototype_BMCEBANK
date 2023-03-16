<?php
session_start();
require_once '../files/server.php';
if(!isset($_SESSION['id']))
header('Location:../index.php?login_err=connexion');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liste des idées de startups</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    
</head>
<body>
<?php include '../files/nav.php'; ?>

	<div class="container mx-auto">
		<h1 class="text-3xl font-bold mb-8">Liste des idées de startups</h1>
        <ul class="bg-gray-100">
        <li class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-lg font-semibold text-gray-800">Item Title</span>
            </div>
            <span class="text-sm font-medium text-gray-600">Submitted by: HED</span>
            </div>
            <div class="mt-2 text-gray-600">Notre platforme unique au monde vous permet de trouver des idées de startups inovante mais qui sont arrivé trop top pour percé, vous pouvez acheter les dosser complet des projets et tanter de les reproduire, et de refaire vivre un reve </div>
            <button class="mt-4 py-2 px-4 text-white bg-indigo-500 rounded hover:bg-indigo-600">Plus d'info</button>
        </li>
        </ul>

        <div class="flex justify-center my-8">
        <form class="flex items-center border rounded-md" method=get>
            <input type="text" name="search" id="search" placeholder="Rechercher" class="py-2 px-3 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">Rechercher</button>
        </form>

</div>

<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
        <li class="bg-white shadow overflow-hidden rounded-md">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4"><?php echo $title; ?></h2>
                <p class="text-gray-700 mb-4"><?php echo $description; ?></p>
                <p class="text-gray-500 text-sm">Proposé par <?php echo $username; ?></p>
            </div>
            <div class="px-6 py-4 bg-gray-100">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="idea.php?param=<?php echo $id;?>">Lire la suite</a>
            </div>
            <!-- <form class="px-6 py-4 bg-gray-100" methode=get>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lire la suite</button>
            </form> -->
        </li>
    <?php
    }
    $req->closeCursor();
    ?>
</ul>


<?php include '../files/footer.php'; ?>


</body>
</html>