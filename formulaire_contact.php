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
            height: 100%;
        }

    </style>

    <?php
    //header
    include('inc/header.php');
    ?>

    <!-- une page contact avec un formulaire de contact et une google map intégrée, centrée sur la boutique avec un marqueur-->
    <section class="container d-flex justify-content-center mt-5 pb-5">

        <div class="col-md-4 text-center">

            <h2 >Formulaire de contact</h2>

            <form method="post">
                <div class="form-group mt-3">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label>Prénom</label>
                    <input type="text" name="prenom" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label>Email</label>
                    <input type="text" name="email1" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label>Message</label>
                    <textarea name="message" class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" name="action" value='1' class="text center btn btn-warning">Envoyer</button>
                </div>
            </form>

            <?php

            if(!empty($_POST['action'])){
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


                if(!filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)){
                    //le paramètre email n'existe pas ou mauvaise syntaxe
                    $errors[] = 'Votre mail n\'est pas correct';
                }


                if(empty($_POST['message']) && strlen($_POST['message']) < 500){
                    //le paramètre nom n'existe pas ou est vide ou mauvais caracteres
                    $errors[] = 'Quel est votre message';
                }

                if(!empty($errors)){//si le tableau $error n'est pas vide, on affiche les erreurs
                    foreach($errors as $error){
                        echo '<p class="alert alert-warning">' . $error . '</p>';
                    }
                }
            }


            ?>
        </div>


        <div class="col-md-7">

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

    </section>
    <div class=" text-light container-fluid" >
        <h6 CLASS=" col-10" id="fantome">sdq</h6>
        <P class="mt-5" id="fantome">LKMH</P>
    </div>

    <?php
    //footer
    include('inc/footer.php');
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZYD3Cuv3OtkiGITmjz_NUOVeTkUC71nw&callback=initMap"></script>

    </body>
</html>
