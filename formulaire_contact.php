<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire</title>
        <style>
        /* Always set the map height explicitly to define the size of the div element that contains the map. */
    #map{
        height: 80%;
    }
/* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }
    </style>
        
        <?php
        //header 
        include('inc/header.php');
        ?>

<!-- une page contact avec un formulaire de contact et une google map intégrée, centrée sur la boutique avec un marqueur-->

        <div class="container d-flex justify-content-center">

                <div class="col-md-4">

                    <h2>Formulaire de contact</h2>

                        <form method="post">
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
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Envoyer</button>
                        </form>  

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
                     


                    if(empty($_POST['email']) && strlen($_POST['email']) > 100 && !preg_match('#/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))${#', $_POST['email'])){
                        //le paramètre email n'existe pas ou mauvaise syntaxe
                        $errors[] = 'Votre mail n\'est pas correct'; 
                    }
                    
                    
                    
                    if(empty($_POST['message']) && strlen($_POST['message']) < 500){
                        //le paramètre nom n'existe pas ou est vide ou mauvais caracteres
                        $errors[] = 'Quel est votre message'; 
                    }
                         
                    if(!empty($errors)){//si le tableau $error n'est pas vide, on affiche les erreurs
                        foreach($errors as $error){
                            echo '<p class="alert alert-danger">' . $error . '</p>';
                        }
                    }                       
            }
        
        ?>
        </div>
                    
    
        <div class="col-md-7">
            
            <h3>Notre boutique</h3>

            <div id="map"></div>

                <script>

                function initMap() {
                    var quiksilver = {lat: 44.838935, lng: -0.574483};
                        var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: quiksilver
                        });
                        var ici = new google.maps.Marker({
                        position: quiksilver,
                        map: map,
                        });
                    }    
                
                </script>       
   
        </div>
            
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZYD3Cuv3OtkiGITmjz_NUOVeTkUC71nw&callback=initMap"></script>
    </body>
</html>
