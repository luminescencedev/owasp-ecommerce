<?php 
 
require_once "../models/database.php";
require_once "../models/userModel.php";
require_once "../models/produitModel.php";
$db = (new Database())->connect();
$users = new User();

$produits = new Produit();

?>

<main>
    <h1>HOME</h1>

    <h2>Produits : </h2>
    <div class="product-container">
        <?php foreach ($produits->getProduits() as $produit) : ?>
            <div class="product-card">
                <img src="<?= $produit['image'] ?>" alt="<?= $produit['name'] ?>" loading="lazy">
                <h3><?= $produit['name'] ?></h3>
                <p>Category: <?= $produit['category'] ?></p>
                <p>Description: <?= $produit['description'] ?></p>
                <p>Price: <?= $produit['price'] ?> €</p>
            </div>
        <?php endforeach; ?>
    </div>


</main>
