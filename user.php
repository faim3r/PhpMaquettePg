<?php
session_start();
///si l'utilisateur admin est connecté:
if(isset($_SESSION['id']) AND ($_SESSION['role'] == 'ROLE_USER' OR $_SESSION['role'] == 'ROLE_ADMIN')){
    ?>
    <?php include('inc/header.php') ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
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
                    <a class="nav-link" href="user_product.php">modifier un article <span class="sr-only">(current)</span></a>
                </li>

            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Ajouter un utilisateur</h3>
                <?php
                require_once('inc/bdd.php');


                ///////////////////////////////  AJOUT D'UN USER EN PHP  /////////////////////////////////

                if ($_SESSION['role'] == 'ROLE_ADMIN') {
                    if (!empty ($_POST)) {
                        $errors = [];
                        $valideNom = strip_tags($_POST['nom']);
                        $valideMdp = strip_tags($_POST['mdp']);
                        $valideMdp2 = strip_tags($_POST['mdp2']);
                        $valideRole = strip_tags($_POST['role']);
                        $role = ['ROLE_ADMIN', 'ROLE_AUTEUR', 'ROLE_USER'];

                        if (empty($valideNom) OR strlen($valideNom) < 4 OR strlen($valideNom) > 10) {
                            $errors[] = 'merci de remplir correctement votre pseudo';
                        }
                        if (empty($_POST['email']) OR !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            $errors[] = 'merci de donner un email valide';
                        }
                        if (empty ($valideMdp) OR strlen($valideMdp) < 4 OR strlen($valideMdp) > 10 OR $valideMdp != $valideMdp2) {
                            $errors[] = 'Merci de vérifier vos mots de passe';
                        }
                        if (empty($valideRole) OR !in_array($valideRole, $role)) {
                            $errors[] = 'merci de remplir correctement le champs rôle';
                        }
                        if (empty ($errors)) {
                            $ajout = $bdd->prepare('INSERT INTO users (user_name, email, password, role) VALUES(:nom, :email, :password, :role)');
                            $ajout->bindValue(':nom', $valideNom);
                            $ajout->bindValue(':email', $_POST['email']);
                            $ajout->bindValue(':password', password_hash($valideMdp, PASSWORD_DEFAULT));//pasword_hash permet de crypter ton mot de passe
                            $ajout->bindValue(':role', $_POST['role'] );
                            $ajout->execute();

                            echo '<h2>Utilisateur ajouté</h2>';
                        } else {
                            foreach ($errors as $error) {
                                echo '<span class="text-danger">'.$error . '</span><br>';
                            }
                        }
                    }
                }
                else{
                    echo '<h5 style="color: red">Tu n\'as pas le pouvoir de faire ça</h5>';
                }

                ?>
                <!--  /////////////////////////////////  FORMULAIRE POUR ENTRER UN UTILISATEUR /////////////////////////////////// -->
                <form method="post">

                    <div class="form-group">
                        <input type="text" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="mdp" class="form-control" placeholder="Votre mot de passe">
                    </div>
                    <div class="form-group">
                        <input type="password" name="mdp2" class="form-control" placeholder="Répéter votre mot de passe">
                    </div>
                    <div class="form-group">
                        <label>Role de l'utilisateur</label>
                        <select name="role" class="form-control">


                            <option disabled selected value="ROLE_USER">rôle</option>

                            <?php
                            //requete pour afficher les roles

                            $requete = $bdd ->query( "SELECT * from users GROUP BY role");
                            $roles = $requete ->fetchAll();
                            foreach ($roles as $role){
                                ?>
                                <option value="<?= $role['role'] ?>"><?= $role['role'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">Ajouter</button>
                </form>
                <!--  /////////////////////////////////  FORMULAIRE POUR ENTRER UN UTILISATEUR /////////////////////////////////// -->
            </div>

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
                    <button type="submit" class="btn btn-warning">Ajouter</button>
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
                        foreach ($errors as $error){
                            echo '<p class="text-danger">'.$error.'</p>';
                        }

                    }
                }
                ?>
                <!--  /////////////////////////////////  FiN FORMULAIRE POUR MODIFIER LES COORDONNEES DE LA BOUTIQUE /////////////////////////////////// -->
            </div>


        </div>
    </div>

    <?php

    include ('inc/footer.php');
    ?>

    </body>
    </html>
    <?php
}
else{
    echo 'pas le droit';
}
?>
