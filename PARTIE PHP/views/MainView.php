<?php
$html="
<!doctype html>
<html lang='fr'>
<meta charset='UTF-8'>
<head>
      <title>SportTrack</title>
      <link href='./resources/css/style.css' rel='stylesheet' type='text/css'>
</head>
<body class='background'>
      <header>
            <h1>Sport Track</h1>
      </header>";

if(!isset($_SESSION["newsession"])){
                  $html .= "
                  <div class='home'>
                        <ul>
                              <li><a onclick=\"document.location.href='index.php?page=user_connect_form'\">Connexion</a></li>
                              <li><a onclick=\"document.location.href='index.php?page=user_add_form'\">Creation de profil</a></li>
                        </ul>
                  </div>
            ";
            }else{      
                  $html .= "
                  <div class='home'>
                        <ul>
                              <li><a onclick=\"document.location.href='index.php?page=list_activities'\">Liste des activites</a></li>
                              <li><a onclick=\"document.location.href='index.php?page=upload_activity_form'\">Uploader un fichier JSON</a></li>
                              <li><a onclick=\"document.location.href='index.php?page=user_disconnect'\">Deconnexion</a></li>
                        </ul>
                  </div>
                  ";
            }

      
$html .= "</body>
</html> ";
echo $html;
?>