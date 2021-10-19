<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;./index.php?page=/" />
    <title>SportTracks - Activitées sportives</title>
    <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
</head>

<body class="background">
    <?php
        if($_SESSION['inserted'] == false){
            $html="<h1> Vous avez déjà enregistré cette activité</h1>";
            echo $html;
        }else{
            $html="<h1> L'activité a été enregistrée.</h1>";
            echo $html;
        }
    ?>
</body>
</html>