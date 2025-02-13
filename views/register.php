<?php
require_once '../models/userModel.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($pseudo) || empty($password) || empty($firstname) || empty($lastname) || empty($email)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        if ($user->register($pseudo, $password, $firstname, $lastname, $email)) {
            $success = 'Inscription réussie ! Vous pouvez vous connecter.';
            header('Location: index.php?page=login');
        } else {
            $error = 'Une erreur est survenue lors de l\'inscription';
        }
    }
}
?>

<main class="register">
    <div class="form">
        <?php if (isset($success)): ?>
            <div role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="index.php?page=register" method="post">
            <div>
                <h3>Créer un compte</h3>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                <input type="password" name="password" id="password1" placeholder="Mot de passe" required>
            </div>

            <div>
                <h3>Informations personnelles</h3>
                <input type="text" name="firstname" id="firstnamme" placeholder="Prénom" required>
                <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <button id='submit' type="submit">S'inscrire</button></form>
</main>