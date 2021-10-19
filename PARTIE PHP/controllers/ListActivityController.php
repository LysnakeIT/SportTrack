<?php
require('Controller.php');
require_once ('model/ActivityDAO.php');
require_once ('model/SqliteConnection.php');

/**
 * Controller permettant de faire la liste des activités de l'utilisateur dans un tableau, afin de les afficher sur la page 'list_activities'
 */
class ListActivityController implements Controller{

    public function handle($request){

        // Recupere l'id (email) de l'utilisateur
        $id = (String) $_SESSION["newsession"];

        if ($id != null) {
            try {
                // Recupere les activités liées à l'utilisateur
                $_SESSION['activites'] = ActivityDAO::getInstance()->findUserActivities($id);
            } catch(PDOException $ex){
				print $ex->getMessage();
			}
        }
    }
}
?>