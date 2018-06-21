<footer class="bg-dark mt-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="m-auto">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active mr-5">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="products.php">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container text-center pb-3 text-light mt-2">
        <?php
        $change = $bdd->query('SELECT shop_address, shop_phone FROM shop');
        $address = $change->fetch();
        ?>
        <p><?= $address['shop_address'] ?></p>
        <p><?= $address['shop_phone'] ?></p>
        <h5>Site propulsé par Julien, Thomas, Pierre, Stéphane et David</h5>
    </section>
</footer>

