<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Vérifier si les données POST ne sont pas vides
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Paramétrer les variables qui vont être insérées, il faut vérifier si les variables POST existent sinon on peut les mettre en blanc par défaut
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Vérifier si la variable POST "name" existe, si ce n’est pas par défaut la valeur à blank, fondamentalement la même pour toutes les variables
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
    $score = isset($_POST['score']) ? $_POST['score'] : '';
   
    // Insérer un nouvel enregistrement dans le tableau des produit
    $stmt = $pdo->prepare('INSERT INTO produits VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nom, $mail, $mot_de_passe, $score]);
    // message de sortie
    $msg = 'Créé avec succès!';
}
?>



  <!-- Conteneur principal -->
  
            
            
            <?php if ($msg): ?>
            <h5><?=$msg?></h5>
            <?php endif; ?>


</div>




<?=template_footer()?>