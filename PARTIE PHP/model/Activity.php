<?php
/**
 * Classe qui représente une activité
 */
class Activity {
    private $activityID;
    private $dateAct;
    private $descriptionAct;
    private $activityAccount;
    private $frequenceMin;
    private $frequenceMax;
    private $frequenceMoy;
    private $temps;
    private $distance;

    public function __construct() {}

    /**
     * Initialise les attributs d'une activité
     * @param id le numéro de l'activité
     * @param dA la date de l'activité
     * @param deA la description de l'activité
     * @param aA l'identfication de l'utilisateur a qui appartient cette activité
     * @param fMin la frequence minimum de l'activité
     * @param fMax la frequence maximum de l'activité
     * @param fMoy la frequence moyenne de l'activité
     * @param t la durée de l'activité
     * @param d la distance parcourue pendant l'activité
     */
    public function init($id, $dA, $deA, $aA, $fMin, $fMax, $fMoy, $t, $d) {
        $this->activityID = $id;
        $this->dateAct = $dA;
        $this->descriptionAct = $deA;
        $this->activityAccount = $aA;
        $this->frequenceMin = $fMin;
        $this->frequenceMax = $fMax;
        $this->frequenceMoy = $fMoy;
        $this->temps = $t;
        $this->distance = $d;
    }

    public function getActivityId() {return $this->activityID;}
    public function getDateAct() {return $this->dateAct;}
    public function getDescriptionAct() {return $this->descriptionAct;}
    public function getActivityAccount() {return $this->activityAccount;}
    public function getFrequenceMin() {return $this->frequenceMin;}
    public function getFrequenceMax() {return $this->frequenceMax;}
    public function getFrequenceMoy() {return $this->frequenceMoy;}
    public function getTemps() {return $this->temps;}
    public function getDistance() {return $this->distance;}

    public function __toString() {return $this->activityID . " " . $this->dateAct . " " . $this->descriptionAct . " " . $this->activityAccount . " " . $this->frequenceMin . " " . $this->frequenceMax . " " . $this->frequenceMoy . " " . $this->temps . " " . $this->distance;}
}
?>