<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SportTracks - Activitées sportives</title>
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>

<body class="background">
    <header>
        <h1>Activitées sportives</h1>
    </header>
    <form id='upload' action="index.php?page=upload_activity" method="POST"  enctype='multipart/form-data'>>
        <label for="fname">Fichier à charger</label><br><br>
        <input type="file" id="fileToUpload" name="fileToUpload" accept=".json"><br><br>
        <input type="submit" value="Envoyer le fichier" name="submit">
    </form>
</body>
</html>
<?php>
