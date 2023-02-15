<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Vérifiez si l’ID de contact existe, par exemple update.php? id=1 obtiendra le contact avec l’ID de 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Cette partie est similaire au create.php, mais à la place nous mettons à jour un enregistrement et ne pas insérer
  
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $produit = isset($_POST['produit']) ? $_POST['produit'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
        $prixachat = isset($_POST['prixachat']) ? $_POST['prixachat'] : '';
        $prixvente = isset($_POST['prixvente']) ? $_POST['prixvente'] : '';
        $marge = isset($_POST['marge']) ? $_POST['marge'] : '';
        $degres = isset($_POST['degres']) ? $_POST['degres'] : '';
        // mettre à jour l'enregistrement
        $stmt = $pdo->prepare('UPDATE produits SET  created = ?, produit = ?, type = ?, prixachat = ?, prixvente = ?, marge = ?, degres = ?, stock = ? WHERE id = ?');
        $stmt->execute([ $created, $produit, $type, $prixachat, $prixvente, $marge, $degres, $stock, $_GET['id']]);
        $msg = 'mis à jour avec succès!';
    }
    // Obtenir le produits à partir de la table de produits
    $stmt = $pdo->prepare('SELECT * FROM produits WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produit) {
        exit('Le produit n’existe pas avec cet ID !');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

  <!-- Conteneur principal -->
  <div id="mainContainer">
    <div class="form">
      <!-- Contenu principal -->
      <main class="main-content">
        <!-- En-tête -->
        <h2 class="heading">
          <div>Mettre à jour le produit #<?=$produit['id']?></div>
        </h2>
        <form action="update.php?id=<?=$produit['id']?>" method="post">
          <!-- Contenu -->
          <div class="content">
            <!-- Ajout de produit -->
            <div id="addProductForm" class="product-form">
              <!-- Nom et type-->
              <div class="input-row">
          
                <div class="input-group">
                  <label for="name">Nom du produit</label>
                  <input type="text" name="produit" placeholder="Nom du produit" id="produit" value="<?=$produit['produit']?>" />
                </div>
                <div class="input-group">
                  <label for="type">Type</label>
                  <select name="type" id="type"  value="<?=$produit['type']?>">
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
                    placeholder="Prix d'achat HT" value="<?=$produit['prixachat']?>" />
                </div>

                <div class="input-group">
                  <label for="prixvente"> Prix de vente HT </label>
                  <input type="number" type="number" step="0.01" min="0" name="prixvente"  id="prixvente" 
                    placeholder="Prix de vente HT" value="<?=$produit['prixvente']?>"/>
                </div>

                <div class="input-group">
                  <label for="marge">TVA</label>
                  <select name="marge"  id="marge" >
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
                  <input type="number" name="stock" id="stock" step="1" min="0" placeholder="Stock" value="<?=$produit['stock']?>" />
                  <label for="created">Date/Heurs</label>
                  <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($produit['created']))?>" id="created">
                </div>

                <div class="input-group">
                  <label for="degres">Degré d'alcool</label>
                  <input type="number" name="degres" id="degres" step="0.1" min="0" placeholder="Degré d'alcool" value="<?=$produit['degres']?>" />
                </div>
              </div>
              <input  type="submit" value="Modifier" class="validate-button">
              <!-- <button class="validate-button">Valider</button> -->
            </form>
    <?php if ($msg): ?>
    <h5><?=$msg?></h5>
    <?php endif; ?>
</div>

<?=template_footer()?>