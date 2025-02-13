<?php
session_start();

$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" href="/assets/img/IconCollabDoor.png" type="image/x-icon">
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
    <title>Site E-Commerce</title>
</head>

<body>
    <header>
        <a href="/index.php?page=home">Home</a>
        <nav>
            <?php if (isset($_SESSION['pseudo'])): ?>
                <?php
                $profile = [
                    'pseudo' => $_SESSION['pseudo'],
                    'email' => $_SESSION['email'],
                    'role' => $_SESSION['role']
                ];
                ?>

                <ul class="user">
                    <?php if ($profile['role'] === 'visiteur'): ?>
                        <li><a href="index.php?page=profile">Profil</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=admin">Admin</a></li>
                    <?php endif; ?>
                </ul>
            <?php else: ?>
                <ul class="user">
                    <li><a href="index.php?page=login">Connexion </a></li>
                    <li><a href="index.php?page=register">Inscription</a></li>
                </ul>
            <?php endif; ?>
        </nav>
    </header>
    <hr>