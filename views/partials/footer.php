<?php 
require_once "../models/messageModel.php";

$messages = new MessageContact();

$popup = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        if ($messages->sendMessage($email, $message)) {
            $popup ="Message sent successfully!";
        } else {
            $popup= "Failed to send message.";
        }
    } else {
        $popup= "Invalid email or message.";
    }
}
?>
<hr>
<footer>
    
    <form action="" method="post">
        <h2>Formulire de contact</h2>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <input type="submit" value="Envoyer" onclick="popup()">
    </form>
    
    <p>&copy; 2025 - OWASP - EFREI, All rights reserved.</p>
    <script>
        function popup() {
            alert("<?php echo $popup; ?>");
        }
    </script>
</footer>
</body>
</html>