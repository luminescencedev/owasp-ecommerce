<?php 
require_once "../models/database.php";
require_once "../models/userModel.php";
require_once "../models/produitModel.php";
require_once "../models/messageModel.php";

$db = (new Database())->connect();
$users = new User();
$produits = new Produit();
$messages = new MessageContact();

if (isset($_POST['delete_user'])) {
    $users->deleteUser($_POST['id_user']);
    header("index.php?page=admin");
    exit();
}

if (isset($_POST['delete_produit'])) {
    $produits->deleteProduit($_POST['id_produit']);
    header("index.php?page=admin");
    exit();
}
?>

<main class="admin">
    <h1>ADMIN</h1>
    <h2>Utilisateurs :</h2>
    <div class="user-container">
        <?php foreach ($users->getUsers() as $user) : ?>
            <div class="user-card">
                <p>Pseudo: <?= $user['pseudo'] ?></p>
                <p>Email: <?= $user['email'] ?></p>
                <p>Role: <?= $user['role'] ?></p>
                <?php if ($user['role'] !== 'Admin') : ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                        <button type="submit" name="delete_user">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <h2>Produits :</h2>
    <div class="product-container">
        <?php foreach ($produits->getProduits() as $produit) : ?>
            <div class="product-card">
                <img src="<?= $produit['image'] ?>" alt="<?= $produit['name'] ?>" loading="lazy">
                <h3><?= $produit['name'] ?></h3>
                <p>Category: <?= $produit['category'] ?></p>
                <p>Description: <?= $produit['description'] ?></p>
                <p>Price: <?= $produit['price'] ?> €</p>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                    <button type="submit" name="delete_produit">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <h2>Messages :</h2>
    <div class="message-container">
        <?php foreach ($messages->getAllMessages() as $message) : ?>
            <div class="message-card">
                <p>Email: <?= $message['email'] ?></p>
                <p>Message: <?= $message['message'] ?></p>
                <p>Date: <?= $message['date_envoi'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php?page=logout">Logout</a>
</main>