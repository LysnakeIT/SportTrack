<?php

    $html = "
<html><head>
        <title>Liste des activités</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
        <link rel='stylesheet' href='./resources/css/style.css' type='text/css'/>
    </head>
    <body class='background'>
            <header>
                <div class='Activity'>
                    <ul>
                        <li><a onclick=\"document.location.href='./index.php?page=/'\">Accueil</a></li>
                        <li><a onclick=\"document.location.href='./index.php?page=upload_activity_form'\">Ajouter une activité</a></li>
                        <li><a onclick=\"document.location.href='index.php?page=user_disconnect'\">Deconnexion</a></li>
                    </ul>
                </div>
            </header>    
    ";

        $html .= "
                 <table border=1 id='activity_table'>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Temps(secondes)</th>
                        <th>Distance (en mètre)</th>
                        <th>Freq.Cardiaque Mini</th>
                        <th>Freq.Cardiaque Maxi</th>
                        <th>Freq.Cardiaque Moyenne</th>
                    </tr>
            ";

        // $_SESSION['activites'] est initialisée par le controleur ListActivityController
        $activites = $_SESSION['activites'];
            foreach ($activites as $activity)
            {
                $html .= "<tr>";
                $html .= "  <td>" . $activity['descriptionAct'] . "</td>";
                $html .= "  <td>" . $activity['dateAct'] . "</td>";
                $html .= "  <td>" . $activity['temps'] .  "</td>";
                $html .= "  <td>" . $activity['distance'] .  "</td>";
                $html .= "  <td>" . $activity['frequenceMin'] .  "</td>";
                $html .= "  <td>" . $activity['frequenceMax'] .  "</td>";
                $html .= "  <td>" . $activity['frequenceMoy'] .  "</td>";
                $html .= "</tr>";
            }
        $html .= "</table>
     </body></html>";
echo $html;
?>