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
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
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
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>