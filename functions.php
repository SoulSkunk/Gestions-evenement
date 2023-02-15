<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = '';
    $DATABASE_USER = '';
    $DATABASE_PASS = '';
    $DATABASE_NAME = '';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// En cas d’erreur de connexion, arrêtez le script et affichez l’erreur.
    	exit('Échec de connexion à la base de données !');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="style.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
		<div>
		<h1>Café de paris</h1>
		<a href="index.php"><i class="fas fa-home"></i>Accueil</a>
		<a href="read.php"><span class="material-icons"> liquor </span>Produit</a>
		</div>
		</nav>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>