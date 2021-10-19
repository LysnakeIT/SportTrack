<?php
/**
 * Classe qui représente la donnée d'une activité
 */
class ActivityData {
    private $dataID;
    private $timeData;
    private $cardioFrequency;
    private $latitude;
    private $longitude;
    private $altitude;
    private $dataActivity;

    public function __construct() {}

    /**
     * Initialise les attributs d'un utilisateur
     * @param id le numéro de la donnée
     * @param tD le temps enregistré
     * @param cA la frequence cardiaque enregistrée
     * @param la la latitude enregistrée
     * @param lo la longitude enregistrée
     * @param al l'altitude enregistrée
     * @param dA l'indentifiant de l'activité
     */
    public function init($id, $tD, $cA, $la, $lo, $al, $dA) {
        $this->dataID = $id;
        $this->timeData = $tD;
        $this->cardioFrequency = $cA;
        $this->latitude = $la;
        $this->longitude = $lo;
        $this->altitude = $al;
        $this->dataActivity = $dA;
    }

    public function getDataID() {return $this->dataID;}
    public function getTimeData() {return $this->timeData;}
    public function getCardioFrequency() {return $this->cardioFrequency;}
    public function getLatitude() {return $this->latitude;}
    public function getLongitude() {return $this->longitude;}
    public function getAltitude() {return $this->altitude;}
    public function getDataActivity() {return $this->dataActivity;}

    public function __toString() {return $this->dataID . " " . $this->timeData . " " . $this->cardioFrequency . " " . $this->latitude . " " . $this->longitude . " " . $this->altitude . " " . $this->dataActivity;}
}
?>