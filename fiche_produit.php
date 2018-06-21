<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche produit</title>

<?php

include('inc/header.php');

//vérification du paramètre
if(!empty($_GET['idProduit']) AND is_numeric($_GET['idProduit'])){
                        
    //le paramètre est bon, on peut faire la requête à la base pour récupérer le produit
    $resultat = $bdd->prepare('SELECT * FROM products WHERE id = :id');
    $resultat->bindValue(':id', strip_tags($_GET['idProduit']));
    $resultat->execute();
    $produits = $resultat->fetchAll(PDO::FETCH_ASSOC);
                        
    //ensuite je vais chercher les catégories liées à cet article
    $resultat2 = $bdd->prepare('SELECT categories.id, libelle FROM categories INNER JOIN products ON categories.id = products.categories_id WHERE products.id = :id');
    $resultat2->bindValue(':id', $_GET['idProduit']);
    $resultat2->execute();           
    $categories = $resultat2->fetch(PDO::FETCH_ASSOC);

    foreach ($produits as $produit) {
        ?>
        <div class="show">
            <h3><?= $produit['name'] . '<br>' ?></h3>
            <img src="<?= $produit['photo'] ?>"><br>
            <h5>Info sur le produit :</h5>
            <p>Prix : <?= $produit['price'] ?> €</p>
            <p>En stock : <?= $produit['available'] ?></p>
        </div>
        <?php
    }
?>    
    <h5>Catégories:</h5>
<?php
?>
    <p><?= $categories['libelle'] ?></p><br>
<?php
}
?>