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
    // Regarde si l'utilisateur est connecte et si il ne l'est pas, le redirige vers la page de connexion
    const ret = user_dao.findAll();
    if (req.session.login != true) {
    // Cherche les activitées liées à l'utilisateur et les stocke dans un tableau
        res.render('connect');
    } else {
        res.render('modify', { data: ret, email: req.session.email });
    }
}));

router.post('/', asyncMiddleware(async (req, res) => {
    // Stocke les données fournit par l'utilisateur
    var info = [req.body.fName, req.body.pName, req.body.start, req.body.sexe, req.body.taille, req.body.poids, req.body.password];

    // Update en fonction des données fournies
    await user_dao.update(req.session.email, info)
    res.redirect("/")
}));
module.exports = router;