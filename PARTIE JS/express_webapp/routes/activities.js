var express = require('express');
var activity_dao = require('sport-track-db').activity_dao;
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
  // Regarde si l'utilisateur est connecte et si il ne l'est pas, le redirige vers la page de connexion
  if (req.session.login != true) {
    res.render('connect');
  } else {
    // Cherche les activitées liées à l'utilisateur et les stocke dans un tableau
    const activity = await activity_dao.findByEmail(req.session.email);
    var tab = Array()
    for (var i = 0; i < activity.length; i++) {
      tab.push({ date: activity[i]["dateAct"], description: activity[i]["descriptionAct"], frequenceMinimum: activity[i]["frequenceMin"], frequenceMaximum: activity[i]["frequenceMax"], frequenceMoyenne: activity[i]["frequenceMoy"], temps: activity[i]["temps"], distance: activity[i]["distance"] })
    }
    res.render('activities', { data: tab });
  }
}))
module.exports = router;