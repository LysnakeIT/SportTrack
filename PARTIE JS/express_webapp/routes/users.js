var express = require('express');
var router = express.Router();
var user_dao = require('sport-track-db').user_dao;

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
  const ret = await user_dao.findAll()
  res.render('users', { data: ret });
}));


router.post('/', asyncMiddleware(async (req, res) => {

  var name = req.body.fName
  var prenom = req.body.pName
  var dateNaissance = req.body.start
  var sexe = req.body.sexe
  var taille = req.body.taille
  var poids = req.body.poids
  var email = req.body.email
  var pasword = req.body.password

  // Stocke les données fournit par l'utilisateur
  var info = [name, prenom, dateNaissance, sexe, taille, poids, email, pasword];
  const user = await user_dao.findAll()

  var check = true;
  // Regarde si l'email est unique donc non existant dans la base de données
  for (row of user) {
    if (row.adresseElectronique === info[6]) {
      check = false;
    }
  }

  // Insere l'utilisateur
  if (check) {
    await user_dao.insert(info);
    res.redirect("/")
    res.end();
  } else {
    res.redirect("/users")
  }
}));
module.exports = router;