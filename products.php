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
            <form method="get">
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" name="nom" class="form-control">
                </div>
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Button</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

<!----------------------- AFFICHAGE BASIQUE DES PRODUITS SOUS LE CHAMPS RECHERCHE ----------------------->
<hr>

<?php
// Requete pour affichage général des produits
$afficheProduits = $bdd -> query('SELECT * FROM products');
$afficheProduits = $afficheProduits->fetchAll();
echo ('<div class="container" >');
echo ('<div class="row">');
foreach ($afficheProduits as $afficheProduit){?>
    <div class="show">
    <h3><?=$afficheProduit['name'].'<br>'?></h3>
    <img src="<?=$afficheProduit['photo']?>"><br></p>
    </div>
    <?php
}
?>
</div>
</div>























</body>
</html>