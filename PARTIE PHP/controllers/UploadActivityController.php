<?php
require 'Controller.php';
require_once 'model/ActivityData.php';
require_once 'model/ActivityEntryDAO.php';
require_once 'model/Activity.php';
require_once 'model/ActivityDAO.php';
require_once 'model/SqliteConnection.php';
require_once 'model/CalculDistanceImpl.php';

/**
 * Controller permettant a un utilisateur d'ajouter une nouvelle activite a son compte a l'aide d'un fichier JSON
 */
class UploadActivityController implements Controller {

    public function handle($request){

		// On vérifie si le fichier n'est pas trop volumineux
        if ($_FILES["fileToUpload"]["size"] > 2000) {
            echo "Désolé, votre ficher est trop volumineux (2000 max)";
			exit();
        }

		// Verification format du fichier
        $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        if ($fileType != "json") {
            echo "Désolé, seuls des fichiers JSON sont acceptés.";
			exit();
        }

		// Extraction des informations du fichier
        $file = $_FILES["fileToUpload"]["tmp_name"];
        if (isset($file)) {
            $json = file_get_contents($file);
            $parsed_json = json_decode($json, true);

            $data_array = $parsed_json["data"];
            $activity_array = $parsed_json["activity"];

            $date_activity = $activity_array["date"];
            $desc_activity = $activity_array["description"];
        }

		// On stocke l'id de la session
        $id = $_SESSION["newsession"];

		// Récuperation des activités liées à l'utilisateur
		$activitésTrouvées = false;
		try { 
			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "SELECT dateAct, descriptionAct FROM Activity WHERE activityAccount = '$id'";
            $results = $dbc->query($query)->fetchAll();
			$activitésTrouvées = true;
		}catch(PDOException $ex){
			print $ex -> getMessage();
			$activitésTrouvées = false;
		}

		// Verification des données contenues dans le fichier par rapport aux données liées à l'utilisateur. On utilise la date et la description pour vérifier.
		$insert = true;
		if ($activitésTrouvées) {
			foreach ($results as list($dateAct, $descriptionAct)) {
				if ($dateAct == $date_activity && $descriptionAct == $desc_activity) {
					$insert = false;
				}
			}
		}else{
			echo("Vous avez déjà fournit cette activité");
		}

		if($insert){

			// On selectionne l'ID max des activités stockées pour choisir un id valide pour l'activité fournie
			try{
				$query = "SELECT MAX (activityID) FROM Activity";
				$stmt = $dbc ->query($query)->fetch();

				if($stmt == null){
					$cptActivity = 1;
				}else {
					$cptActivity = $stmt["MAX (activityID)"] + 1;
				}
			}catch(PDOException $ex){
				print $ex->getMessage();
			}

			// On selectionne l'ID max des data stockées pour choisir un id valide pour les futures data fournies
			try{
				$queryData = "SELECT MAX (dataID) FROM ActivityData";
				$stmtData = $dbc->query($queryData)->fetch();

				if($stmtData == null){
					$cptActivityData = 1;
				}else {
					$cptActivityData = $stmtData["MAX (dataID)"];
				}
			}catch(PDOException $ex){
				print $ex->getMessage();
			}

			// On calcule la distance parcourue de l'activité
			$y = new CalculDistanceImpl();
            $ret = $y->json("./resources/file.json");
            $distance = $y->calculDistanceTrajet($ret);

			// On insère l'activité avec des valeurs par défaut pour les fréquences et le temps qui seront mis à jour par les triggers
			$activite = new Activity();
			$activite-> init($cptActivity,
							$activity_array["date"],
                            $activity_array["description"],
                            $id,
							0,
							1,
							1,
							"12:00:00",
							$distance);

			// On insère l'activité
			try{
				$activite_dao = ActivityDAO::getInstance();
				$activite_dao-> insert($activite);
			} catch(PDOException $ex) {
				print $ex->getMessage();
			}

			// On insère chaque donnée contenue dans le fichier en incrémentant leurs id respectives et on les insère
			$donnees = null;
			$donnees_dao = ActivityEntryDAO::getInstance();
			for($i = 0; $i < count($data_array); $i++){
				$cptActivityData ++;
				$donnees = new ActivityData();
				$donnees->init( $cptActivityData,
								$data_array[$i]["time"],
							    $data_array[$i]["cardio_frequency"],
				        		$data_array[$i]["latitude"],
				        		$data_array[$i]["longitude"],
				        		$data_array[$i]["altitude"],
                				$cptActivity);
				$donnees_dao->insert($donnees);
			}
			$_SESSION['inserted'] = true;	
		
		} else {
			$_SESSION['inserted'] = false;
        }
    }
}
?>