<?php
/**
 * Classe qui représente un utilisateur
 */
class Account {
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $sexe;
    private $taille;
    private $poids ;
    private $adresseElectronique;
    private $motDePasse;

    public function __construct() {}

    /**
     * Initialise les attributs d'un utilisateur
     * @param n le nom de l'utilisateur
     * @param pr le prenom de l'utilisateur
     * @param dN la date de naissance de l'utilisateur
     * @param s le sexe de l'utilisateur
     * @param t la taille de l'utilisateur
     * @param po le poids de l'utilisateur
     * @param aE l'adresse mail de l'utilisateur qui est aussi l'identifiant du compte
     * @param mDP le mot de passe de l'utilisateur
     */
    public function init($n, $pr, $dN, $s, $t, $po, $aE, $mDP) {
        $this->nom = $n;
        $this->prenom = $pr;
        $this->dateNaissance = $dN;
        $this->sexe = $s;
        $this->taille = $t;
        $this->poids = $po;
        $this->adresseElectronique = $aE;
        $this->motDePasse = $mDP;
    }

    public function getNom() {return $this->nom;}
    public function getPrenom() {return $this->prenom;}
    public function getDateNaissance() {return $this->dateNaissance;}
    public function getSexe() {return $this->sexe;}
    public function getTaille() {return $this->taille;}
    public function getPoids() {return $this->poids;}
    public function getAdresseElectronique(){return $this->adresseElectronique;}
    public function getMotDePasse() {return $this->motDePasse;}

    public function __toString() {return $this->nom . " " . $this->prenom . " " . $this->dateNaissance . " " . $this->sexe . " " . $this->taille . " " . $this->poids . " " . $this->adresseElectronique . " " . $this->motDePasse;}
}
?>