var express = require('express');
var uploadFile = require('express-fileupload');
var calculDistance = require('sport-track-db').distance;
var activity_dao = require('sport-track-db').activity_dao;
var activity_entry_dao = require('sport-track-db').activity_entry_dao;
var router = express.Router();

/**
 * Permet de faire fonctionner les promesses avec express
 * @param {*} fn 
 * @returns 
 */
function asyncMiddleware(fn) {
  return (req, res, next) => {
    Promise.resolve(fn(req, res, next)).catch(next);
  }
}


router.get('/', asyncMiddleware(async (req, res, next) => {
  const activity = await activity_dao.findAll();
  if (req.session.login != true) {
    res.render('connect');
  } else {
    res.render('upload', { activity });
  }
}))

router.post('/', asyncMiddleware(async (request, response) => {

  // Extraction des informations du fichier
  var content = request.files.fileToUpload.data.toString('utf-8');
  var json = JSON.parse(content);

  var activity_date = json['activity']['date'];
  var activity_description = json['activity']['description'];
  var data = json["data"];
  var login = request.session.email

  // Récuperation des activités liées à l'utilisateur
  var activitésTrouvées = false;
  const info = await activity_dao.findActivityInfo(login)
  if (info !== undefined) {
    activitésTrouvées = true;
  }

  // Verification des données contenues dans le fichier par rapport aux données liées à l'utilisateur. On utilise la date et la description pour vérifier.
  var insert = true;
  if (activitésTrouvées) {
    for (var i = 0; i < info.length; i++) {
      if (info[i]["dateAct"] == activity_date && info[i]["descriptionAct"] == activity_description) {
        insert = false;
      }
    }
  }

  // On selectionne l'ID max des activités stockées pour choisir un id valide pour l'activité fournie
  if (insert) {
    const id = await activity_dao.findMax()
    var myObj = JSON.parse(JSON.stringify(id[0]))
    var row = parseInt(myObj.maxID);
    if (myObj.maxID == null) {
      row = 1;
    } else {
      row++;
    }

    // On selectionne l'ID max des data stockées pour choisir un id valide pour les futures data fournies
    const idData = await activity_entry_dao.findMax()
    var myObjData = JSON.parse(JSON.stringify(idData[0]))
    var rowData = parseInt(myObjData.maxDataID)
    if (myObjData.maxDataID == null) {
      rowData = 1;
    } else {
      rowData++;
    }

    // On calcule la distance parcourue de l'activité
    var distance = calculDistance.calculDistanceTrajet(json)

    // On insère l'activité avec des valeurs par défaut pour les fréquences et le temps qui seront mis à jour par les triggers
    var activity = [row, activity_date, activity_description, login, 0, 0, 0, "12:00:00", distance];
    await activity_dao.insert(activity);

    // On insère chaque donnée contenue dans le fichier en incrémentant leurs id respectives et on les insère
    for (let i = 0; i < json['data'].length; i++) {
      var data_time = data[i]['time'];
      var cardio_frequency = data[i]['cardio_frequency'];
      var latitude = data[i]['latitude'];
      var longitude = data[i]['longitude'];
      var altitude = data[i]['altitude'];
      var dataActivity = [rowData, data_time, cardio_frequency, latitude, longitude, altitude, row];
      await activity_entry_dao.insert(dataActivity);
      rowData++;
    }
    response.redirect("/");
  } else {
    response.redirect("/upload")
  }

}));

module.exports = router;