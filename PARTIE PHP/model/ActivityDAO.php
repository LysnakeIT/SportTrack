<?php
require_once ('SqliteConnection.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Classe permettant la selection, l'insertion, la mise à jour et la suppression d'activités dans la BDD
 */
class ActivityDAO {
    private static $dao;
            
    private function __construct() {}

    final public static function getInstance() {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityDAO();
        }
        return self::$dao;
    }

    /**
     * Methode qui selectionne l'ensemble des activitées stockées dans la base
     * @return result l'ensemble des activités contenues dans la base de données
     */
    final public function findAll() {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "SELECT * FROM Activity";
            $stmt = $dbc->prepare($query);
            $stmt-> execute();
            $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Activity');
        } catch (PDOException $error) {
            echo "Erreur requete findAll: " . $error->getMessage();
            exit();
        }

        return $results;

    }

    /**
     * Methode qui insere une nouvelle activite associé à un utilisateur dans la base de données
     * @param st l'activite
     */
    final public function insert($st) {
        if ($st instanceof Activity) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "insert into Activity(activityID, dateAct, descriptionAct, activityAccount, frequenceMin, frequenceMax, frequenceMoy, temps, distance) values (:aI,:dA,:deA,:aA,:fM,:fMa,:fMo,:t,:d)";
                $stmt = $dbc->prepare($query);

                $stmt->bindValue(':aI', $st->getActivityId(), PDO::PARAM_STR);
                $stmt->bindValue(':dA', $st->getDateAct(), PDO::PARAM_STR);
                $stmt->bindValue(':deA', $st->getDescriptionAct(), PDO::PARAM_STR);
                $stmt->bindValue(':aA', $st->getActivityAccount(), PDO::PARAM_STR);
                $stmt->bindValue(':fM', $st->getFrequenceMin(), PDO::PARAM_STR);
                $stmt->bindValue(':fMa', $st->getFrequenceMax(), PDO::PARAM_STR);
                $stmt->bindValue(':fMo', $st->getFrequenceMoy(), PDO::PARAM_STR);
                $stmt->bindValue(':t', $st->getTemps(), PDO::PARAM_STR);
                $stmt->bindValue(':d', $st->getDistance(), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete Insert: " . $error->getMessage();
                exit();
            }
        }
    }

    /**
     * Methode qui supprime une activite associé à un utilisateur dans la base de données
     * @param obj l'activite a supprimer
     */
    public function delete($obj){
        if ($obj instanceof Activity) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "delete from Activity where activityID = :aI";
                $stmt = $dbc->prepare($query);
                $stmt->bindValue(':aI', $obj->getActivityId(), PDO::PARAM_STR);
                $stmt->execute();

            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }

    /**
     * Methode qui permet de récupérer toutes les activites associe l'utilisateur passe en parametre
     * @param id l'utilisateur
     */
    final public function findUserActivities($id){
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "SELECT * FROM Activity WHERE activityAccount = '$id'";
            $stmt = $dbc->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchALL();

        } catch (PDOException $error) {
            echo "Erreur requete : " . $error->getMessage();
            exit();
        }
        return $results;
    }

    /**
     * Methode qui met à jour une activite associé à un utilisateur dans la base de données
     * @param obj l'activite a mettre à jour
     */
    public function update($obj) {
        if ($obj instanceof Activity) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "update Activity set dateAct=:dA, descriptionAct=:deA, activityAccount=:aA, frequenceMin=:fM, frequenceMax=:fMa, frequenceMoy=:fMo, temps=:t, distance =:d where activityID=:aI";
                $stmt = $dbc->prepare($query);

                $stmt->bindValue(':dA', $obj->getDateAct(), PDO::PARAM_STR);
                $stmt->bindValue(':deA', $obj->getDescriptionAct(), PDO::PARAM_STR);
                $stmt->bindValue(':aA', $obj->getActivityAccount(), PDO::PARAM_STR);
                $stmt->bindValue(':fM', $obj->getFrequenceMin(), PDO::PARAM_STR);
                $stmt->bindValue(':fMa', $obj->getFrequenceMax(), PDO::PARAM_STR);
                $stmt->bindValue(':fMo', $obj->getFrequenceMoy(), PDO::PARAM_STR);
                $stmt->bindValue(':t', $obj->getTemps(), PDO::PARAM_STR);
                $stmt->bindValue(':d', $obj->getDistance(), PDO::PARAM_STR);
                $stmt->bindValue(':aI', $obj->getActivityId(), PDO::PARAM_STR);

                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }
}
?>