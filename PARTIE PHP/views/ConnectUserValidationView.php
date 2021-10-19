<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;./index.php?page=/" />
    <title>SportTracks - Connexion</title>
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>
<body class='background'>
<?php
if($_SESSION["erreur"] == 42){
    $html="<h1> Erreur de connexion, adresse électronique incorrecte.</h1>";
    echo $html;
}else{
    $html="<h1> Connection établie.</h1>";
    echo $html;
}
?>
</body>
</html>