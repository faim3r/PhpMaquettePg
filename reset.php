<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset</title>
   
        
    <?php 
    include('inc/header.php');
    require_once('vendor/autoload.php');   
      
    if($_GET){
    $resultat = $bdd->prepare('SELECT * FROM reset_pass WHERE token = :token');
    $resultat->bindValue(':token', ($_GET['token']));
    $resultat->execute();                        
    $users = $resultat->fetchAll(PDO::FETCH_ASSOC);

    if(count($users) === 1){
            echo 'mail envoyé';
                ?>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Creation mot de passe</h2>
                    <form method="post">
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="text" name="pass" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Verification du mot de passe</label>
                            <input type="text" name="pass2" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $_GET['user_id']?>">
                        </div>

                        <button type="submit" class="btn btn-info" name="submitPass" value="1">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    
        <?php
        }

 }
    if(!empty($_POST['submitPass'])){
        
        $errors = [];

        if(!isset($_POST['pass']) OR !isset($_POST['pass2']) OR mb_strlen($_POST['pass']) < 4 && mb_strlen($_POST['pass']) > 10 ){
            $errors[] = 'le mot de passe doit faire entre 4 et 10 caractères';
        } 

        if($_POST['pass'] !== $_POST['pass2']){
            $errors[] = 'les deux mdp envoyés doivent être identiques';
        }
        if(empty($_POST['id'])){
            $errors[] = 'Erreur dans le changement';
        }

        if(empty($errors)){
        $resultat = $bdd->prepare('UPDATE users SET password = :password WHERE id = :idUser');
        $resultat->bindValue(':password', password_hash ($_POST['pass'], PASSWORD_DEFAULT));
        $resultat->bindValue(':idUser', $_POST['id']);
        $resultat->execute();

            echo '<p class="alert alert-success">Mot de passe modifié</p>';

        }
        else{
            echo '<p class="alert alert-danger">Problème lors de la modification</p>';
        }
    }

    ?>

</body>
</html>