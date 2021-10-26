var CalculDistance = function(){

    function proto(){}
    CalculDistance.prototype.calculDistance2PointsGPS = function(lat1, long1, lat2, long2){

        this.latOne = (lat1 * Math.PI) / 180.0;
        this.longOne = (long1 * Math.PI) / 180.0;
        this.latTwo = (lat2 * Math.PI) / 180.0;
        this.longTwo = (long2 * Math.PI) / 180.0;
    
        let rEarth = 6378137;
    
        let ret = rEarth * Math.acos(Math.sin(this.latTwo) * Math.sin(this.latOne) + Math.cos(this.latTwo) * Math.cos(this.latOne) * Math.cos(this.longTwo - this.longOne));
    
        return ret;
    }

    CalculDistance.prototype.calculDistanceTrajet = function(activite){
        let distance = 0;
        let distanceTotal = 0;
    
        for (let i = 0; i < activite.data.length - 1; i++) {
    
            let lat1 = activite.data[i].latitude;
            let long1 = activite.data[i].longitude;
            let lat2 = activite.data[i + 1].latitude;
            let long2 = activite.data[i + 1].longitude;
    
            distance = CalculDistance.prototype.calculDistance2PointsGPS(lat1, long1, lat2, long2);
    
            distanceTotal = distanceTotal + distance;
        }
        return distanceTotal;
    }
}
let activite = {
    "activity": {
        "date": "01/09/2018",
        "description": "IUT -> RU"
    },
    "data": [
        { "time": "13:00:00", "cardio_frequency": 99, "latitude": 47.644795, "longitude": -2.776605, "altitude": 18 },
        { "time": "13:00:05", "cardio_frequency": 100, "latitude": 47.646870, "longitude": -2.778911, "altitude": 18 },
        { "time": "13:00:10", "cardio_frequency": 102, "latitude": 47.646197, "longitude": -2.780220, "altitude": 18 },
        { "time": "13:00:15", "cardio_frequency": 100, "latitude": 47.646992, "longitude": -2.781068, "altitude": 17 },
        { "time": "13:00:20", "cardio_frequency": 98, "latitude": 47.647867, "longitude": -2.781744, "altitude": 16 },
        { "time": "13:00:25", "cardio_frequency": 103, "latitude": 47.648510, "longitude": -2.780145, "altitude": 16 }
    ]
}
var calcul = new CalculDistance();
var ret = calcul.calculDistanceTrajet(activite);
console.log("Résultat = " + ret);