<?php
session_start();
require_once('inc/bdd.php');
//si l'utilisateur admin est connecté:
if(isset($_SESSION['id']) AND  $_SESSION['role'] == 'ROLE_ADMIN'){
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
          <a class="navbar-brand" href="#">Blog</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>

            </ul>
          </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Ajouter un utilisateur</h2>
                    <?php

                    
                    //traitement de l'inscription
                    if(!empty($_POST)){
                        //si le formulaire a été envoyé

                        //nettoyage de post
                        $post = [];

                        foreach($_POST as $key=>$value){
                            $post[$key] = trim(strip_tags($value));
                        }

                        $errors = [];


                        //on doit vérfier que l'email n'est pas déjà présent dans la base
                        $resultat = $bdd->prepare('SELECT id FROM users WHERE email = :email');
                        $resultat->bindValue(':email', $post['email']);
                        $resultat->execute();
                        //on envoie toutes les réponses éventuelles dans une variable, qui sera donc un tableau (de tableau(x))
                        $users = $resultat->fetchAll(PDO::FETCH_ASSOC);
                        //on compte le nombre de "cases" de ce tableau
                        if(count($users) > 0){
                            //il y a au moins un résultat: l'email existe dans la base donc on génère une erreur
                            $errors['email existe'] = 'l\'email est déjà présent dans la base';
                        }


                        if(!isset($post['Nom']) OR !preg_match('#^[a-zA-Z]{4,10}$#', $post['Nom'])){
                            $errors['pseudo'] = 'le pseudo doit faire entre 4 et 10 caractères';
                        }

                        if(!isset($post['mdp']) OR !isset($post['mdp2']) OR mb_strlen($post['mdp']) < 4 OR mb_strlen($post['mdp']) > 10 OR $post['mdp'] !== $post['mdp2']){
                            $errors['mdp'] = 'le mot de passe doit faire entre 4 et 10 caractères et les deux mdp envoyés doivent être identiques';
                        }

                        if(!isset($post['email']) OR !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                            $errors['email'] = 'email invalide';
                        }
                        
                        $roles_autorises = ['ROLE_USER', 'ROLE_AUTEUR', 'ROLE_ADMIN'];
                        if(!in_array($post['role'], $roles_autorises)){
                            $errors['role'] = 'role invalide';
                        }

                        if(empty($errors)){
                            //pas d'erreur, on peut enregistrer l'utilisateur
                            $resultat = $bdd->prepare('INSERT INTO users (Nom, email, tel, password, role) VALUES (:nom, :email, tel, :mdp, :role)');
                            $resultat->bindValue(':nom', $post['Nom']);
                            $resultat->bindValue(':email', $post['email']);
                            $resultat->bindValue(':mdp', password_hash($post['mdp'], PASSWORD_DEFAULT));                            
                            $resultat->bindValue(':role', $post['role']);
                            if($resultat->execute()){
                                echo '<p class="alert alert-success">inscription OK!</p>';
                            }

                        }
                        else{
                            foreach($errors as $error){
                                echo '<p class="alert alert-danger">' . $error . '</p>';
                            }

                        }
                    }


                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="Nom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tél</label>
                            <input type="text" name="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Répéter le mdp</label>
                            <input type="password" name="mdp2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="ROLE_USER">user de base</option>
                                <option value="ROLE_AUTEUR">auteur</option>
                                <option value="ROLE_ADMIN">admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Ajouter</button>
                    </form>
                    
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>



</body>
</html>
<?php
}
else{
    echo 'pas le droit';
}
?>
