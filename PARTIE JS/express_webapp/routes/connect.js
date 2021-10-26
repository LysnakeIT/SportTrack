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
    // Regarde si l'utilisateur est connecte et si il l'est, le redirige vers la page d'accueil    
    const ret = await user_dao.findAll()
    if (req.session.login == true) {
        res.redirect('/')
    } else {
        res.render('connect', { data: ret });
    }
}));

router.post('/', asyncMiddleware(async (req, res) => {
    var check = false;
    var email = req.body.email
    var pasword = req.body.password

    // Cherche l'utilisateur (par son email) dans la base de donnée et compare si le mot de passe fourni correspond
    const user = await user_dao.findByKey(email);
    if (user.length != 0 && user != undefined) {
        if (user[0].motDePasse === pasword) {
            check = true;
        }
    }

    // Si l'utilisateur existe et si le mdp est valide alors on crée des variable de session et on stocke si la connexion est valide et l'email de l'utilisateur
    if (check) {
        req.session.email = email
        req.session.login = true;
        res.redirect("/")
    } else {
        res.redirect("/connect")
    }
}));

router.get('/disconnect', function (req, res) {
    if (req.session.login == true) {
        //si la personne est connecté alors on detruit la session
        req.session.destroy()
    }
    res.redirect('/')
})
module.exports = router;