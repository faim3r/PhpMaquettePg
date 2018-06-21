<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon Profil</title>

<?php
include('inc/header.php');
///si l'utilisateur admin est connecté:
if(isset($_SESSION['id']) AND ($_SESSION['role'] == 'ROLE_USER' OR $_SESSION['role'] == 'ROLE_ADMIN')){
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BACKOFFICE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="user_product.php">modifier un article <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
                      
        <div class="col-md-4">
            <h4>Modifier les coordonnées du magasin</h4>
            <!--  /////////////////////////////////  FORMULAIRE POUR MODIFIER LES COORDONNEES DE LA BOUTIQUE /////////////////////////////////// -->
            <form method="POST">  
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="adresse de la boutique">
                </div>
                <div class="form-group">
                    <input type="email" name="mail" class="form-control" placeholder="Email de la boutique">
                </div>
                <div class="form-group">           
                    <input type="text" name="tel" class="form-control" placeholder="télephone de la boutique">
                </div>
                <button type="submit" class="btn btn-info">Ajouter</button>
            </form>

<?php
            if(!empty($_POST)){
                //si post n'est pas vide, c'est que l'utilisateur a bien envoyé quelque chose
                
                $errors = [];
                
                if(empty($_POST['address'])){
                    $errors[] = 'Veuillez entrer une adresse valide';
                }
                
                if(!isset($_POST['mail']) OR !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                    $errors[] = 'Veuillez entrer un E-Mail valide';
                }

                if(empty($_POST['tel']) || !preg_match('#^[0][0-9]{9}$#', $_POST['tel'])){
                    $errors[] = 'Veuillez entrer un numéro de téléphone valide';
                }

                if(empty($errors)){
                    //Utiliser une requête préparée
                    $modifier = $bdd->prepare('UPDATE shop SET shop_address = :shop_address, shop_mail = :shop_mail, shop_phone = :shop_phone WHERE id = 1');
                    $modifier->bindValue(':shop_address', htmlspecialchars($_POST['address']));
                    $modifier->bindValue(':shop_mail', htmlspecialchars($_POST['mail']));
                    $modifier->bindValue(':shop_phone', htmlspecialchars($_POST['tel']));
                    $modifier->execute();
?>
                    <h3 class="alert alert-success col-lg-7 m-auto text-center">
                        Coordonnées modifié !
                    </h3>
<?php
                }else{
                    //on affiche les erreurs
                    echo implode('<br>', $errors);
                }
             }
?>
        </div>    
               
                <!--  /////////////////////////////////  FORMULAIRE POUR MODIFIER LES COORDONNEES DE LA BOUTIQUE /////////////////////////////////// -->
            </div>
        </div>

<?php
}else{
    echo 'pas le droit';
}
?>
</body>
</html>