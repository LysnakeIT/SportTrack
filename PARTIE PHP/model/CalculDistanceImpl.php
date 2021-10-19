<?php
require_once 'CalculDistance.php';
/**
 * Classe qui calcule la distance finale parcourue durant une activite
 */
class CalculDistanceImpl implements CalculDistance {

    public function json(String $fileName) {
        $arr1 = array(
            "latitude" => array(),
            "longitude" => array(),
        );
        $json = file_get_contents('./'.$fileName);

        $json_data = json_decode($json, true);

        for ($i = 0; $i < sizeof($json_data["data"]); $i++) {
            array_push($arr1["latitude"], $json_data["data"][$i]["latitude"]);
            array_push($arr1["longitude"], $json_data["data"][$i]["longitude"]);
        }
        return $arr1;
    }
    /**
     * Retourne la distance en mètres entre 2 points GPS exprimés en degrés.
     * @param float $lat1 Latitude du premier point GPS
     * @param float $long1 Longitude du premier point GPS
     * @param float $lat2 Latitude du second point GPS
     * @param float $long2 Longitude du second point GPS
     * @return float La distance entre les deux points GPS
     */

    public function calculDistance2PointsGPS($lat1, $long1, $lat2, $long2) {
        $R = 6378137;
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $long1 = deg2rad($long1);
        $long2 = deg2rad($long2);
        $distance = 0 + ($R * acos(sin($lat2) * sin($lat1) + cos($lat2) * cos($lat1) * cos($long2 - $long1)));
        return $distance;
    }

    /**
     * Retourne la distance en metres du parcours passé en paramètres. Le parcours est
     * défini par un tableau ordonné de points GPS.
     * @param Array $parcours Le tableau contenant les points GPS
     * @return float La distance du parcours
     */
    public function calculDistanceTrajet(array $parcours) {
        $d = 0;
        for ($i = 0; $i < sizeof($parcours["latitude"]) - 1; $i++) {
            $y = new CalculDistanceImpl();
            $d += $y->calculDistance2PointsGPS($parcours["latitude"][$i], $parcours["longitude"][$i], $parcours["latitude"][$i + 1], $parcours["longitude"][$i + 1]);
        }
        return $d;
    }
}
?>
