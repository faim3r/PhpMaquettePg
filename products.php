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

</head>
<body>

<?php
include ('inc/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="get">
                <div class="form-group">
                    <label>Nom produit recherché</label>
                    <input type="text" name="nomProduit" class="form-control" value="<?php if (isset($_GET['nomProduit'])){echo $_GET['nomProduit'];}?>">
                </div>
                <div class="form-group">
                    <label>Recherche par catégorie</label>
                    <select class="custom-select col-4" id="inputGroupSelect04" name="categories">
                        <option selected disabled>Catégories</option>
                        <?php
                        //requete pour afficher les catégories

                        $requete = $bdd ->query( "SELECT * from categories GROUP BY libelle");
                        $categories = $requete ->fetchAll();
                        foreach ($categories as $category){
                            if ($_GET['categories'] == $categories['id']) {
                                ?>
                                <option selected value="<?= $category['id'] ?>"><?= $category['libelle'] ?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?= $category['id'] ?>"><?= $category['libelle'] ?></option>
                                <?php
                            }
                        }

                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-info">Rechercher</button>
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

    $requete = "SELECT * FROM products INNER JOIN categories ON products.categories_id = categories.id";

    if (!empty($nomProduit) AND !empty($verifCategories)) {
        $requete .= " WHERE categories.id = :categories_id AND products.name LIKE :nomProduits";
    } elseif (!empty ($nomProduit)) {
        $requete .= " WHERE products.name LIKE :nomProduits";
    } elseif (!empty($verifCategories)) {
        $requete .= " WHERE categories.id = :categories_id";

    } else {
        echo 'recherche non valide';
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

//boucle pour afficher les résultats de la recherche

        if (!empty($articles)) {
            foreach ($articles as $article) {
                ?>
                <div class="show">
                    <p><?=$article['name'].'<br>'?></p>
                    <img src="<?=$article['photo']?>"><br></p>
                </div>

                <?php
            }
        }


    }
}




?>
</body>
</html>