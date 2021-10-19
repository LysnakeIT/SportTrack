<?php
require('Controller.php');
require_once 'model/Account.php';
require_once 'model/UserDAO.php';

/**
 * Controller permettant de déconnecter un utilisateur et de le supprimer de $_SESSION["newsession"] apres l'activation du bouton "se déconnecter"
 */
class DisconnectUserController implements Controller{

    public function handle($request){

        // Verifie si la personne est connectée, si oui alors destruction session + variable
        if (isset($_SESSION["newsession"])) {
            session_unset();
            session_destroy();
        } else {
            echo 'Aucune session connecté';
        }
    }
}
?>