var CalculDistance = function () {

    /**
     * Permet de calculer la distance entre deux coordonnees GPS
     * @param {int} lat1
     * @param {int} long1
     * @param {int} lat2
     * @param {int} long2
     * @returns  la distance en metres
     */
    this.calculDistance2PointsGPS = function (lat1, long1, lat2, long2) {

        this.latOne = (lat1 * Math.PI) / 180.0;
        this.longOne = (long1 * Math.PI) / 180.0;
        this.latTwo = (lat2 * Math.PI) / 180.0;
        this.longTwo = (long2 * Math.PI) / 180.0;

        let rEarth = 6378137;

        let ret = rEarth * Math.acos(Math.sin(this.latTwo) * Math.sin(this.latOne) + Math.cos(this.latTwo) * Math.cos(this.latOne) * Math.cos(this.longTwo - this.longOne));

        return ret;
    }

    /**
     * Permet de calculer la distance parcourue en un trajet
     * @param {ActivityDAO} activite l'activite dont on prend les distances
     * @returns  la distance en metres
     */
    this.calculDistanceTrajet = function (activite) {
        let distance = 0;
        let distanceTotal = 0;

        for (let i = 0; i < activite.data.length - 1; i++) {

            let lat1 = activite.data[i].latitude;
            let long1 = activite.data[i].longitude;
            let lat2 = activite.data[i + 1].latitude;
            let long2 = activite.data[i + 1].longitude;

            distance = this.calculDistance2PointsGPS(lat1, long1, lat2, long2);

            distanceTotal = distanceTotal + distance;
        }
        return distanceTotal;
    }
}
var calcul = new CalculDistance();
module.exports = calcul;