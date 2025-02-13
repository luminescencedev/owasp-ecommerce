<main>
    <h1>PROFILE</h1>
    <h2>Informations personnelles :</h2>
    <p>Pseudo : <?= $_SESSION['pseudo'] ?></p>
    <p>Email : <?= $_SESSION['email'] ?></p>
    <p>Role : <?= $_SESSION['role'] ?></p>
    <a href="index.php?page=logout">Logout</a>
</main>