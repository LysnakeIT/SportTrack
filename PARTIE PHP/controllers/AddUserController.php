<?php
require 'Controller.php';
require_once 'model/Account.php';
require_once 'model/UserDAO.php';

/**
 * Controller appelé après creation d'un utilisateur (via le formulaire) pour l'ajouter à la base de donnees
 */
class AddUserController implements Controller {

    public function handle($request) {
        $y = new Account();
        $y->init($request["name"], $request["pname"], $request["trip-start"], $request["sexe"], $request["taille"], $request["poids"], $request["email"], $request["password"]);
        $w = UserDAO::getInstance();

        // On va stocker dans une variable l'adresse mail fournie par l'utilisateur voulant se créer un compte
        $ret = $y->getAdresseElectronique();
        $bdd = $w->findAll();

        // Compare l'adresse mail fournie par rapport aux adresses mail présentes dans la base de données
        // Si aucune similitude alors le compte peut être créé.
        $value = true;
        for ($i = 0; $i < sizeof($bdd); $i++) {
            if ($ret != $bdd[$i]->getAdresseElectronique()) {
                $value = true;
                $_SESSION["erreur"]= 0;
            } else{
                $value = false;
                $_SESSION["erreur"]= 41;
                echo "Erreur addUser: email existe deja.";
            }
        }

        //Insertion du compte si mail unique
        if($value) {
            $_SESSION["erreur"]= 0;
            try {
                $w->insert($y);
            } catch (Exception $e) {
                echo "Erreur addUser: " . $error->getMessage();
                exit();
            }
        }
    }
}
?>