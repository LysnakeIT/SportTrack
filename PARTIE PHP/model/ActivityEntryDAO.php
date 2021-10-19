<?php
require_once ('SqliteConnection.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Classe permettant la selection, l'insertion, la mise à jour et la suppression de données dans la BDD
 */
class ActivityEntryDAO {
    private static $dao;
            
    private function __construct() {}

    final public static function getInstance() {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityEntryDAO();
        }
        return self::$dao;
    }

    /**
     * Methode qui selectionne l'ensemble des données stockées dans la base
     * @return result l'ensemble des données contenues dans la base de données
     */
    final public function findAll() {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "SELECT * FROM ActivityData";
            $stmt = $dbc->prepare($query);
            $stmt-> execute();
            $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'ActivityData');
        } catch (PDOException $error) {
            echo "Erreur requete findAll: " . $error->getMessage();
            exit();
        }

        return $results;

    }

    /**
     * Methode qui insere une nouvelle donnée associée à une activité dans la base de données
     * @param st la donnée
     */
    final public function insert($st) {
        if ($st instanceof ActivityData) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "INSERT INTO ActivityData(dataID, timeData, cardioFrequency, latitude, longitude, altitude, dataActivity) VALUES (:dID,:tD,:cF,:la,:lo,:al,:dA)";
                $stmt = $dbc->prepare($query);
                $stmt->bindValue(':dID', $st->getDataID(), PDO::PARAM_STR);
                $stmt->bindValue(':tD', $st->getTimeData(), PDO::PARAM_STR);
                $stmt->bindValue(':cF', $st->getCardioFrequency(), PDO::PARAM_STR);
                $stmt->bindValue(':la', $st->getLatitude(), PDO::PARAM_STR);
                $stmt->bindValue(':lo', $st->getLongitude(), PDO::PARAM_STR);
                $stmt->bindValue(':al', $st->getAltitude(), PDO::PARAM_STR);
                $stmt->bindValue(':dA', $st->getDataActivity(), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete Insert: " . $error->getMessage();
                exit();
            }
        }
    }

    /**
     * Methode qui supprime une donnée associée à une activité dans la base de données
     * @param obj la donnée à supprimer
     */
    public function delete($obj){
        if ($obj instanceof ActivityData) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "delete from ActivityData where dataID = :dID";
                $stmt = $dbc->prepare($query);
                $stmt->bindValue(':dID', $obj->getDataID(), PDO::PARAM_STR);
                $stmt->execute();

            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }

    /**
     * Methode qui met à jour une donnée associée à une activité dans la base de données
     * @param obj la donnée à mettre à jour
     */
    public function update($obj) {
        if ($obj instanceof ActivityData) {
            try {
                $dbc = SqliteConnection::getInstance()->getConnection();
                $query = "update ActivityData set dataActivity=:dA, timeData=:tD, cardioFrequency=:cF, latitude=:la, longitude=:lo, altitude=:al where dataID=:dID";
                $stmt = $dbc->prepare($query);

                $stmt->bindValue(':dID', $obj->getDataID(), PDO::PARAM_STR);
                $stmt->bindValue(':tD', $obj->getTimeData(), PDO::PARAM_STR);
                $stmt->bindValue(':cF', $obj->getCardioFrequency(), PDO::PARAM_STR);
                $stmt->bindValue(':la', $obj->getLatitude(), PDO::PARAM_STR);
                $stmt->bindValue(':lo', $obj->getLongitude(), PDO::PARAM_STR);
                $stmt->bindValue(':al', $obj->getAltitude(), PDO::PARAM_STR);
                $stmt->bindValue(':dA', $obj->getDataActivity(), PDO::PARAM_STR);

                $stmt->execute();
            } catch (PDOException $error) {
                echo "Erreur requete : " . $error->getMessage();
                exit();
            }
        }
    }
}
?>