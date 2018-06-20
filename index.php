<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

<?php include('inc/header.php') ?>

<!-- Début SLIDER -->
<section class="container mt-3">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img class="d-block w-100" src="app/img/store1.jpg" alt="Slide 1" title="Photo de la boutique 1">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="app/img/store2.jpg" alt="Slide 2" title="Photo de la boutique 2">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="app/img/store3.jpg" alt="Slide 3" title="Photo de la boutique 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section>
<!-- Fin SLIDER -->

<!-- Début PRÉSENTATION BOUTIQUE -->
<section class="container-fluid mt-3 bg-dark">
    <div class="container text-light pt-4 pb-4">
        <h1 class="text-center mb-3">Ma Boutique de OUF !!</h1>
        <p>
            Spicy jalapeno bacon ipsum dolor amet short ribs beef pastrami ham fatback. Turducken tail ribeye hamburger shoulder. Short loin ribeye burgdoggen biltong sausage. Short loin jowl
            tri-tip pork belly meatball boudin spare ribs tenderloin. Pork swine bresaola, jerky buffalo spare ribs brisket landjaeger tail doner pancetta hamburger.
        </p>
        <p>
            Ground round brisket frankfurter, turkey swine venison doner tail ribeye leberkas andouille rump beef sirloin. Short ribs pancetta andouille brisket venison, cow shoulder pig. Tri-tip
            porchetta corned beef turkey alcatra fatback. Beef ribs turkey corned beef, jowl flank sausage pork bacon alcatra porchetta pastrami kielbasa doner. Filet mignon tail turducken,
            meatloaf short ribs pig pork andouille shoulder flank leberkas sausage ground round brisket turkey. Capicola bresaola turkey tri-tip salami.
        </p>
    </div>
</section>
<!-- Fin PRÉSENTATION -->

<!-- Début PRÉSENTATION PRODUITS -->
<section class="container mt-3">
    <h3 class="text-center mb-4">Présentation de nos produits</h3>
    <div class="d-flex justify-content-center">
        <figure class="figure row">
            <div class="ml-4 zoom">
                <img src="app/img/dress.jpg" class="figure-img img-fluid rounded" alt="Robe" title="Robe">
                <figcaption class="figure-caption text-center">Une robe rouge</figcaption>
            </div>
            <div class="ml-4">
                <img src="app/img/coat.jpg" class="figure-img img-fluid rounded" alt="Manteau" title="Manteau">
                <figcaption class="figure-caption text-center">Un Manteau</figcaption>
            </div>
            <div class="ml-4">
                <img src="app/img/shoes.jpg" class="figure-img img-fluid rounded" alt="Chaussure" title="Chaussure">
                <figcaption class="figure-caption text-center">Une paire de chaussures léopard</figcaption>
            </div>
            <div>
                <img src="app/img/pants.jpg" class="figure-img img-fluid rounded" alt="Pantalon" title="Pantalon">
                <figcaption class="figure-caption text-center">Un pantalon noir</figcaption>
            </div>
        </figure>
    </div>
</section>
<!-- FIN PRÉSENTATION PRODUITS -->

<?php include('inc/footer.php') ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>