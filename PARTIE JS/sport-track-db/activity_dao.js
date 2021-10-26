var db = require('./sqlite_connection');

var ActivityDAO = function () {

    /**
     * Insertion d'une nouvelle activite
     * @param {Array} values le tableau de donnée de l'activite
     * @returns une promesse
     */
    this.insert = function (values) {
        return new Promise(async function (resolve, reject) {
            const query = `INSERT INTO Activity("activityID", "dateAct", "descriptionAct", "activityAccount", "frequenceMin", "frequenceMax", "frequenceMoy", "temps", "distance") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`;
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], values[6], values[7], values[8]], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        });
    }

    /**
     * Update l'activite passe en parametre
     * @param {Int} key l'identifiant de l'activite à update
     * @param {Array} values le tableau de donnée avec les nouvelles valeurs de l'activite
     * @returns une promesse
     */
    this.update = function (key, values) {
        return new Promise(async function (resolve, reject) {
            const query = "UPDATE Activity SET dateAct=?, descriptionAct=?, activityAccount=?, frequenceMin=?, frequenceMax=?, frequenceMoy=?, temps=?, distance=? WHERE activityID= ?"
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], values[6], values[7], key], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            })
        })
    };

    /**
     * Delete l'activite passe en parametre
     * @param {Int} key l'identifiant de l'activite à delete
     * @returns une promesse
     */
    this.delete = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = `DELETE FROM Activity WHERE activityID = ?`
            db.run(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Permet de récupérer toutes les activites stockées dans la base de donnée
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findAll = function () {
        return new Promise(async function (resolve, reject) {
            const query = "select * from Activity"
            db.all(query, [], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }

    /**
     * Recupere les données de l'activité passe en parametre
     * @param {Int} key l'identifiant de l'activite à chercher
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findByKey = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT * FROM Activity WHERE activityID = ?"
            db.all(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Recupere les données enregistrées par l'utilisateur passé en paramètre
     * @param {String} email l'utilisateur
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findByEmail = function (email) {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT * FROM Activity WHERE activityAccount = ?"
            db.all(query, email, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * 
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findMax = function () {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT MAX (activityID) AS maxID FROM Activity"
            db.all(query, [], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }

    /**
     * Recupere la date et la description des activités enregistrées par l'utilisateur passe en parametre
     * @param {String} key l'utilisateur
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findActivityInfo = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT dateAct, descriptionAct FROM Activity WHERE activityAccount = ?"
            db.all(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }
};
var dao = new ActivityDAO();
module.exports = dao;