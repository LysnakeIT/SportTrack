<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SportTracks - Inscription</title>
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>

<body class='background'>
    <header>
        <h1>Création de compte</h1>
    </header>
    <form action="index.php?page=user_add" method="POST">
        <label for="fname">Nom</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="lname">Prenom</label><br>
        <input type="text" id="pname" name="pname" required><br>
        <label for="dateNaiss">Date de naissance</label><br>
        <input type="date" id="start" name="trip-start" min="1921-01-01" max="2021-09-06" required><br><br>
        <label for="sexe">Sexe</label><br>
        <select name="sexe" id="sexe" required>
            <option type = 'text' value="h">Homme</option>
            <option type = 'text' value="f">Femme</option>
            <option type = 'text' value="a">Autres</option>
        </select><br><br>
        <label for="taille">Taille</label><br>
        <input type="text" id="taille" name="taille" required><br>
        <label for="poids">Poids</label><br>
        <input type="text" id="poids" name="poids" required><br>
        <label for="adrrElec">Adresse electronique</label><br>
        <input type="email" id="email" name=email pattern=".+@.+\.com" size="40" required><br>
        <label for="lname">Mot de passe</label><br>
        <input type="password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required><br><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>

</html>