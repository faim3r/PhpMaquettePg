<?php

require_once ('inc/bdd.php');
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="products.css">
</head>
<body>
<?php
include ('inc/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- FORMULAIRE -->
            <form method="get">
                <div class="form-group">
                    <label>Nom produit recherché</label>
                    <input type="text" name="nomProduit" class="form-control" value="<?php if (isset($_GET['nomProduit'])){echo $_GET['nomProduit'];}?>">
                </div>
                <div class="form-group">
                    <label class="col-12">Recherche par catégorie</label>
                    <select class="custom-select col-4" id="inputGroupSelect04" name="categories">
                        <option selected disabled>Catégories</option>
                        <?php
                        //requete pour afficher les catégories

                        $requete = $bdd ->query( "SELECT * from categories GROUP BY libelle");
                        $categories = $requete ->fetchAll();
                        foreach ($categories as $category){
                            ?>
                            <option value="<?= $category['id'] ?>"><?= $category['libelle'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <div class="form-group">
                        <label class="col-12">Trier par prix: </label>
                        <select class="custom-select col-4" id="inputGroupSelect04" name="price">
                            <option selected >Prix...</option>
                            <option value="1">Par ordre croissant</option>
                            <option value="2">Par ordre décroissant</option>
                        </select>
                        <div class="container">
                            <div class="row">
                                <button type="submit" class="btn btn-warning col-2" id="submit">Rechercher</button>
                                <a href="products.php" class="btn btn-info col-2 offset-8" id="reset">reset</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

//-------------------------------------ELSE----------------------------------------------------

//requête pour moteur de recherche

if ($_GET) {
    $nomProduit = strip_tags($_GET['nomProduit']);
    if (!empty($_GET['categories'])) {
        $verifCategories = strip_tags($_GET['categories']);
    }
    if (!empty($_GET['price'])) {
        $verifTrier = strip_tags($_GET['price']);
    }

    $requete = "SELECT * FROM products INNER JOIN categories ON products.categories_id = categories.id";

    if (!empty($nomProduit) AND !empty($verifCategories)){
        $requete .= " WHERE categories.id = :categories_id AND products.name LIKE :nomProduits";
    }
    if (!empty ($nomProduit)) {
        $requete .= " WHERE products.name LIKE :nomProduits";
    } if (!empty($verifCategories)) {
        $requete .= " WHERE categories.id = :categories_id";

    }
    if ($verifTrier == 2){
        $requete .= " ORDER BY price DESC";
    }
    if ($verifTrier == 1){
        $requete .= " ORDER BY price";
    }



    if ($requete) {
        $recherche = $bdd->prepare($requete);
        if (!empty($nomProduit) AND !empty($verifCategories)) {
            $recherche->bindValue(':categories_id', $verifCategories);
            $recherche->bindValue(':nomProduits', '%'.$nomProduit.'%');
        } elseif (!empty($nomProduit)) {
            $recherche->bindValue(':nomProduits', '%'.$nomProduit.'%');
        } elseif (!empty($verifCategories)) {
            $recherche->bindValue(':categories_id', $verifCategories);
        }

        $recherche->execute();
        $articles = $recherche->fetchAll();
        //var_dump($requete);
//boucle pour afficher les résultats de la recherche

        if (!empty($articles)) {

            echo('<div class="container" >');
            echo('<div class="row">');
            foreach ($articles as $article) {
                //<?= preg_replace('#('.$titre.')#i', "<span style='background: aquamarine;'>$1</span>"
                ?>
                <div class="show">
                    <?php
                    if(!empty($_GET['nomProduit'])){
                        ?>
                    <h5><?=preg_replace('#('.$_GET['nomProduit'].')#i', "<span class='bg-warning'>$1</span>", $article['name']);?><br></h5>
                        <?php
                    }
                    else{
                        ?>

                        <h5><?=$article['name'];?><br></h5>
                        <?php
                    }
                    ?>
                    <img src="<?=$article['photo']?>"><br>
                    <h3><?=$article['price']?> €</h3>
                </div>
                <?php
            }
            ?>
            </div>
            </div>
            <?php
        }
    }
    if (count($articles) == 0){
        ?>
        <h2 style="color: red" class="col-4 offset-4">Aucun produit correspondant</h2>
        <?php
    }
} else {

//----------------------- AFFICHAGE BASIQUE DES PRODUITS SOUS LE CHAMPS RECHERCHE ----------------------->
// Requete pour affichage général des produits
    $afficheProduits = $bdd->query('SELECT * FROM products');
    $afficheProduits = $afficheProduits->fetchAll();
    echo('<div class="container" >');
    echo('<div class="row">');
    foreach ($afficheProduits as $afficheProduit) {
        ?>
        <div class="show">
            <h5><?= $afficheProduit['name'] . '<br>' ?></h5>
            <img src="<?= $afficheProduit['photo'] ?>"><br>
            <h3><?=$afficheProduit['price']?> €</h3>
        </div>
        <?php
    }

    ?>
    </div>
    </div>
    <?php

}
include ('inc/footer.php');

?>
</body>
</html>