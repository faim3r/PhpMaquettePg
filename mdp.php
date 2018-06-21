<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mdp</title>
   
        
    <?php 
    include('inc/header.php');
    require_once('vendor/autoload.php');   

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    ?> 

   

    <section class="container d-flex justify-content-center mt-5 pb-5">
        <div class="col-md-6">
            
                <h2>Renouvellement du mot de passe</h2>
                        <form method="post">
                            <div class="form-group">
                                <label>Renseigner votre email</label>
                                <input type="text" name="changement" class="form-control">
                            </div>
                            <button type="submit" class="text-center btn btn-warning mb-5">Valider</button>
                </form>
    
    <?php

if(!empty($_POST)){
    
    $errors =[];

    if(!isset($_POST['changement']) OR !filter_var(trim($_POST['changement']), FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Votre email n\'est pas valide !';
    }
    if(!empty($errors)){
        foreach($errors as $error){
            echo '<p class="alert alert-warning">' . $error . '</p>';
        }
    }

    if(empty($errors)){
    
        $resultat = $bdd->prepare('SELECT * FROM users WHERE email = :email');
        $resultat->bindValue(':email', trim($_POST['changement']));
        $resultat->execute();                        
        $users = $resultat->fetchAll(PDO::FETCH_ASSOC);


        if(count($users) === 1){

            echo 'Un mail vient de vous être envoyé';

        $token = md5(uniqid(rand(), true));


        $resultat2 = $bdd->prepare('INSERT INTO reset_pass (token, user_id) VALUES (:token, :id)');
        $resultat2->bindValue(':token', htmlspecialchars($token));
        $resultat2->bindValue(':id', htmlspecialchars($users[0]['id']));
        $resultat2->execute();
        
        $mail = new PHPMailer();

        //debug
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        //untilisation du SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.gmx.com';

        //identification
        $mail->SMTPAuth = true;
        $mail->Username = 'promo5wf3@gmx.fr';
        $mail->Password = 'ttttttttt33';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //expediteur et destinataire
        $mail->SetFrom('promo5wf3@gmx.fr', 'tooty');
        $mail->addAddress($users[0]['email'], $users[0]['user_name']);

        //on peut ajouter des CC
        //$mail->addCC(''sdfvsdfv@sdfgsdfg.fr)
        $mail->isHTML(true);

        //sujet
        $mail->Subject = 'Exemple';
        //contenu
        $mail->Body = 'Veuillez cliquer <a href="http://localhost/promo7/catalog/reset.php?user_id=' . $users[0]['id'] . '&token=' . $token . '">Ici</a>';
                    echo '<p>Cliquez<a href="http://localhost/promo7/catalog/reset.php?user_id=' . $users[0]['id'] . '&token=' . $token . '"">Ici</a></p>';
        }
        else{
            echo '<p class="alert alert-warning"> Votre mail n\'est pas reconnu </p>';
        }
    }
    else{
        echo '<p class="alert alert-warning"> Votre mail n\'est pas reconnu </p>';
    }
}
?>

        </div>  
    </section>
    <?php
    //footer
    include('inc/footer.php');
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZYD3Cuv3OtkiGITmjz_NUOVeTkUC71nw&callback=initMap"></script>
    
    </body>
    
</html>