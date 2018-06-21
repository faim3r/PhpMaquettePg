<?php
session_start();
///si l'utilisateur admin est connecté:
// if(isset($_SESSION['id']) AND ($_SESSION['role'] == 'ROLE_AUTEUR' OR $_SESSION['role'] == 'ROLE_ADMIN')){
?>
<?php include('inc/header.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">BACKOFFICE</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="user.php">Paramètres utilisteur<span class="sr-only">(current)</span></a>
          </li>
            </ul>
          </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<?php
					//avec une liste des articles (pas de formulaire ou de liste déroulante) afficher tout les articles : 
					//connexion à la bdd
					require_once('inc/bdd.php');
                    
                    //script de suppression d'un article
                    if(!empty($_GET['idArticleSuppr']) AND is_numeric($_GET['idArticleSuppr'])){
                        //paramètre valide, on supprime
                        $resultat = $bdd->prepare('DELETE FROM products WHERE id = :idArticle');
                        $resultat->bindValue(':idArticle', $_GET['idArticleSuppr']);
                        $resultat->execute();
                        echo'article supprimé';
                    }
                    
                   
                    
                    //récupération des articles
                    $resultat = $bdd->query('SELECT id, name, price, available date_ceat, photo, categories_id FROM products');
                    $articles = $resultat->fetchAll(PDO::FETCH_ASSOC);
                    
                    //affichage de la liste des articles
                    ?>
                    <!-- liste déroulante -->
                    <form action="article.php">
                        <select name="idArticle" class="form-control">
                            <option value="">Choisissez un Produit</option>
                            <?php
                                foreach($articles as $article){
                                ?>
                                <option value="<?= $article['id']; ?>">
                                        <?php echo $article['name']; ?>
                                </option>
                                <?php
                                } 
                            ?>
                        </select>
                        <button class="btn btn-default" type="submit">Voir</button>
                    </form>
                    <p>OU</p>
                    <ul class="list-group">
                    <?php
                        foreach($articles as $article){
                        ?>
                        <li class="list-group-item">   
                                id : <?= $article['id']; ?>
                                <?php echo $article['name']; ?> | Prix de l article <?php echo  $article['price']; ?> € 
                                <a href="products_modification.php?idArticle=<?= $article['id'] ?>"><i class="fas fa-search"></i> ajouter</a> |
                                <a href="products_modification.php?idArticle=<?= $article['id']; ?>"><i class="fas fa-edit"></i> Modifier</a>
                                | <a href="user_product?idArticleSuppr=<?= $article['id']; ?>"><i class="fas fa-trash"></i>  Supprimer</a></button>
                            </li>
                        <?php
                        } 
                    ?>
                    </ul>

                </div>
            </div>
        </div>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</body>

</html>
<?php
// }
// else{
//     echo 'pas le droit';
// }
?>