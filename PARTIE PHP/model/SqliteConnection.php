<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Classe permettant la connexion à la base de données
 */
class SqliteConnection {
    /**
     * @var SqliteConnection
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {}

    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return SqliteConnection
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new SqliteConnection();
        }
        return self::$_instance;
    }

    public function getConnection() {
        try {
            $db = new PDO('sqlite:resources/sport_track.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (Exception $error) {
            echo "Impossible d'accéder à la base de données SQLite : " . $error->getMessage();
            exit();
        }
    }
}
?>