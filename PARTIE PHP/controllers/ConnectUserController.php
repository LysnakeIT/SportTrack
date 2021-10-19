<?php
require('Controller.php');
require_once 'model/Account.php';
require_once 'model/UserDAO.php';

/**
 * Controller permettant de connecter un utilisateur et de mettre son identifiant dans la variable $_SESSION["newsession] apres avoir rempli le formulaire de connexion.
 */
class ConnectUserController implements Controller{

    public function handle($request){
        $w = UserDAO::getInstance();
        $bdd = $w->findAll();

        // Compare l'adresse mail fournie par rapport aux adresses mails présentes dans la base de données, puis si une adresse correspond alors verifie le mot de passe lié.
        // Si tout est validé alors la connexion est faite.
        // Si aucun utilisateur encore alors pas de connexion.
        $value = true;
        if (sizeof($bdd) == 0) {
            $value = false;
            $_SESSION["erreur"]= 42;
        }
        for ($i = 0; $i < sizeof($bdd); $i++) {
            if ($request["email"] == $bdd[$i]->getAdresseElectronique()) {
                if ($request["password"] == $bdd[$i]->getMotDePasse()) {
                    $email = $bdd[$i]->getAdresseElectronique();
                    $_SESSION["erreur"]= 0;
                    $value = true;
                    $i=sizeof($bdd);
                } else {
                    $_SESSION["erreur"]= 42;
                    $value = false;
                }
            } else{
                $value = false;
                $_SESSION["erreur"]= 42;
            }
        }

        // Stocke l'email dans la variable _SESSION
        if($value) {
            try {
                $_SESSION["newsession"]= $email;
                $_SESSION["erreur"]= 0;
            } catch (Exception $e) {
                echo "Erreur addUser: " . $error->getMessage();
                exit();
            }
        }
    }
}
?>