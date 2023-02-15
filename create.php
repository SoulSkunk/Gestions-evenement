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
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    $produit = isset($_POST['produit']) ? $_POST['produit'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $prixachat = isset($_POST['prixachat']) ? $_POST['prixachat'] : '';
    $prixvente = isset($_POST['prixvente']) ? $_POST['prixvente'] : '';
    $marge = isset($_POST['marge']) ? $_POST['marge'] : '';
    $degres = isset($_POST['degres']) ? $_POST['degres'] : '';
   
    // Insérer un nouvel enregistrement dans le tableau des produit
    $stmt = $pdo->prepare('INSERT INTO produits VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $created, $produit, $type, $stock, $prixachat, $prixvente, $marge, $degres]);
    // message de sortie
    $msg = 'Créé avec succès!';
}
?>
<?=template_header('Create')?>


  <!-- Conteneur principal -->
  <div id="mainContainer">
    <div class="form">
      <!-- Contenu principal -->
      <main class="main-content">
        <!-- En-tête -->
        <div class="heading">
          <span class="material-icons"> add </span>
          Ajouter un produit
        </div>
        <form action="create.php" method="post">
          <!-- Contenu -->
          <div class="content">
            <!-- Ajout de produit -->
            <div id="addProductForm" class="product-form">
              <!-- Nom et type-->
              <div class="input-row">
                <div class="input-group">
                  <label for="produit">Nom du produit</label>
                  <input type="text" name="produit" placeholder="Nom du produit" id="produit" required />
                </div>
                <div class="input-group">
                  <label for="type">Type</label>
                  <select name="type" id="type" required>
                    <option value="Boisson Alcoolisée">Boisson Alcoolisée</option>
                    <option value="Boisson Non-alcoolisée">
                      Boisson Non-alcoolisée
                    </option>
                    <option value="Autre">Autre</option>
                  </select>
                </div>
              </div>

              <!-- Prix -->
              <div class="input-row">
                <div class="input-group">
                  <label for="prixachat">Prix d'achat HT</label>
                  <input type="number" step="0.01" min="0" name="prixachat" id="prixachat"
                    placeholder="Prix d'achat HT" required />
                </div>

                <div class="input-group">
                  <label for="prixvente"> Prix de vente HT </label>
                  <input type="number" type="number" step="0.01" min="0" name="prixvente" id="prixvente"
                    placeholder="Prix de vente HT" required />
                </div>

                <div class="input-group">
                  <label for="marge">TVA</label>
                  <select name="marge" id="marge" required>
                    <option value="20">20%</option>
                    <option value="10">10%</option>
                    <option value="5.5">5.5%</option>
                    <option value="0">0%</option>
                  </select>
                </div>
              </div>

              <!-- Stock et degré d'alcool -->
              <div class="input-row">
                <div class="input-group">
                  <label for="stock">Stock</label>
                  <input type="number" name="stock" id="stock" step="1" min="0" placeholder="Stock" required />
                  <label for="created">Date/Heurs</label>
                  <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
                                <?php
              if(isset($_POST['prixachat']) && isset($_POST['marge'])) {
                $prixachat = (float)$_POST['marge'];
                $marge = (float)$_POST['marge'];
                $ttc = $prixachat * ( 1 + $marge / 100);
                echo "Le prix TTC est de : $ttc €";
              }
              ?>
                </div>

                <div class="input-group">
                  <label for="degres">Degré d'alcool</label>
                  <input type="number" name="degres" id="degres" step="0.1" min="0" placeholder="Degré d'alcool" />
                </div>
         </div>
              <input  type="submit" value="Créer" class="validate-button">
              <!-- <button class="validate-button">Valider</button> -->
            </form>
            
            
            <?php if ($msg): ?>
            <h5><?=$msg?></h5>
            <?php endif; ?>


</div>




<?=template_footer()?>