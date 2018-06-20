<?php

session_start();


?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>
    <body>
        <?php 
        include('inc/header.php');
        require_once('inc/bdd.php');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Formulaire de contact</h2>
                    
                    
        <?php
        
            if(!empty($_POST)){
                    //on crée la variable qui va contenir les éventuelles erreurs
                    $errors = [];

                    if(empty($_POST['nom']) && strlen($_POST['nom']) < 20 && !preg_match('#[A-z]+#', $_POST['nom'])){
                        //le paramètre nom n'existe pas ou est vide ou mauvais caracteres
                        $errors[] = 'Vous devez renseigner votre nom'; 
                    }

                    if(empty($_POST['prenom']) && strlen($_POST['prenom']) < 20 && !preg_match('#[A-z]+#', $_POST['prenom'])){
                        //le paramètre nom n'existe pas ou est vide ou mauvais caracteres
                        $errors[] = 'Vous devez renseigner votre prénom'; 
                    }

                    if(!isset($_POST['email']) && strlen($_POST['email']) > 100 && !preg_match('#/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))${#', $_POST['email'])){
                        //le paramètre email n'existe pas ou mauvaise syntaxe
                        $errors[] = 'Votre mail n\'est pas correct'; 
                    }
                    if(empty($_POST['message']) && strlen($_POST['message']) < 500){
                        //le paramètre nom n'existe pas ou est vide ou mauvais caracteres
                        $errors[] = 'Quel est votre message'; 
                    }
                            
                    else{//si le tableau $error n'est pas vide, on affiche les erreurs
                        foreach($errors as $error){
                            echo '<p class="alert alert-danger">' . $error . '</p>';
                        }
                    }                       
            }
            //si les champs sont vides      
            else{
                echo 'veuillez renseigner les champs demandés!';
            }
        //une page contact avec un formulaire de contact et une google map intégrée, centrée sur la boutique avec un marqueur.
                    ?>
                    <form method="post" action='traitement.php'>
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <input type="text" name="message" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">Envoyer</button>
                    </form>
                    
            </div>
        </div>
        
    </body>
</html>
