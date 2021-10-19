<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SportTracks - Inscription</title>
    <meta http-equiv="refresh" content="2;./index.php?page=/" />
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>
<body class='background'>
<?php
if($_SESSION["erreur"] == 42){
    $html= "<h1> Erreur! Adresse électronique déja utilisée.</h1>";
    echo $html;
}else{
    $html = "<h1> Compte créé.</h1>";
    echo $html;
}
?>
</body>
</html>