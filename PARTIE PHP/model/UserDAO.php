<?php
require_once ('SqliteConnection.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Classe permettant la selection, l'insertion, la mise à jour et la suppression d'utilisateur dans la BDD
 */
class UserDAO {
    private static $dao;
            
    private function __construct() {}

    final public static function getInstance() {
        if (!isset(self::$dao)) {
            self::$dao = new UserDAO();
        }
        return self::$dao;
    }

    /**
     * Méthode qui sélectionne l'ensemble des utilisateurs stockés dans la base
     * @return result l'ensemble des utilisateurs contenus dans la base de données
     */
    final public function findAll() {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "SELECT * FROM Account";
            $stmt = $dbc->prepare($query);
            $stmt-> execute();
            $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Account');
        } catch (PDOException $error) {
            echo "Erreur requete findAll: " . $error->getMessage();
            exit();
        }

        return $results;

    }

    /**
     * Méthode qui insere un nouvel utilisateur dans la base de données
     * @param st l'utilisateur
     */
    final public function insert($st) {
        if ($st instanceof Account) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "insert into Account(nom, prenom, dateNaissance, sexe, taille, poids, adresseElectronique, motDePasse) values (:n,:pr,:dN,:s,:t,:po,:aE,:mDP)";
                $stmt = $dbc->prepare($query);

                $stmt->bindValue(':n', $st->getNom(), PDO::PARAM_STR);
                $stmt->bindValue(':pr', $st->getPrenom(), PDO::PARAM_STR);
                $stmt->bindValue(':dN', $st->getDateNaissance(), PDO::PARAM_STR);
                $stmt->bindValue(':s', $st->getSexe(), PDO::PARAM_STR);
                $stmt->bindValue(':t', $st->getTaille(), PDO::PARAM_STR);
                $stmt->bindValue(':po', $st->getPoids(), PDO::PARAM_STR);
                $stmt->bindValue(':aE', $st->getAdresseElectronique(), PDO::PARAM_STR);
                $stmt->bindValue(':mDP', $st->getMotDePasse(), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete Insert: " . $error->getMessage();
                exit();
            }
        }
    }

    /**
     * Methode qui supprime un utilisateur de la base de données
     * @param obj l'utilisateur à supprimer
     */
    public function delete($obj){
        if ($obj instanceof Account) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "delete from Account where adresseElectronique = :aE";
                $stmt = $dbc->prepare($query);
                $stmt->bindValue(':aE', $obj->getAdresseElectronique(), PDO::PARAM_STR);
                $stmt->execute();

            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }

     /**
     * Methode qui met à jour un utilisateur de la base de données
     * @param obj l'utilisateur à mettre à jour
     */
    public function update($obj) {
        if ($obj instanceof Account) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "update Account set nom=:n, prenom=:pr, dateNaissance=:dN, sexe=:s, taille=:t, poids=:po, motDePasse=:mDP where adresseElectronique = :aE";
                $stmt = $dbc->prepare($query);

                $stmt->bindValue(':n', $obj->getNom(), PDO::PARAM_STR);
                $stmt->bindValue(':pr', $obj->getPrenom(), PDO::PARAM_STR);
                $stmt->bindValue(':dN', $obj->getDateNaissance(), PDO::PARAM_STR);
                $stmt->bindValue(':s', $obj->getSexe(), PDO::PARAM_STR);
                $stmt->bindValue(':t', $obj->getTaille(), PDO::PARAM_STR);
                $stmt->bindValue(':po', $obj->getPoids(), PDO::PARAM_STR);
                $stmt->bindValue(':aE', $obj->getAdresseElectronique(), PDO::PARAM_STR);
                $stmt->bindValue(':mDP', $obj->getMotDePasse(), PDO::PARAM_STR);

                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }
}
?>
