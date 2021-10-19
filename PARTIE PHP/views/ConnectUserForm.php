<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SportTracks - Connexion</title>
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>

<body class='background'>
    <header>
        <h1>Connexion</h1>
    </header>
    <form action="index.php?page=user_connect" method="POST">
        <label for="lname">Adresse electronique</label><br>
        <input type="email" id="email" name="email" pattern=".+@.+\.com" size="40" required><br>
        <label for="lname">Mot de passe</label><br>
        <input type="password" id="pass" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
            required><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>

</html>
<?php>
