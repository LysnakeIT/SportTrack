var db = require('./sqlite_connection');

var ActivityEntryDAO = function () {

    /**
     * Permet d'inserer une nouvelle activity data dans la base de donnees
     * @param {array} values le tableau de donnes de l'activity data
     * @returns  une promise qui resoud si la requette est valide
     */
    this.insert = function (values) {
        return new Promise(async function (resolve, reject) {
            const query = `INSERT INTO ActivityData("dataID", "timeData", "cardioFrequency", "latitude", "longitude", "altitude", "dataActivity") VALUES (?, ?, ?, ?, ?, ?, ?)`;
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], values[6]], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        });
    }

    /**
     * Permet de mettre a jour une activity data
     * @param {array} values le tableau de donnes de l'activity data
     * @param {int} key permet d'identifier l'activity data a modifier
     * @returns  une promise qui resoud et si la requette est valide
     */
    this.update = function (key, values) {
        return new Promise(async function (resolve, reject) {
            const query = "UPDATE ActivityData SET timeData=?, cardioFrequency=?, latitude=?, longitude=?, altitude=?, dataActivity=? WHERE dataID = ?"
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], key], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            })
        })
    };

    /**
     * Permet de supprimer une activity data
     * @param {int} key permet d'identifier l'activity data a supprimer
     * @returns  une promise qui resoud et si la requette est valide
     */
    this.delete = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = `DELETE FROM ActivityData WHERE dataID = ?`
            db.run(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Permet de recuperer toutes les activity data dans la base de donnees
     * @returns  une promise qui resoud et rend le resltat de la requete  si la requette est valide
     */
    this.findAll = function () {
        return new Promise(async function (resolve, reject) {
            const query = "select * from ActivityData"
            db.all(query, [], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }

    /**
     * Permet de recuperer une activity data dans la base de donnees
     * @param {int} key permet d'identifier l'activity data a trouver
     * @returns  une promise qui resoud et rend le resltat de la requete  si la requette est valide
     */
    this.findByKey = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT * FROM ActivityData WHERE dataID = ?"
            db.all(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Permet de recuperer l'activity data qui a l'ID la plus elevee dans la base de donnees
     * @param {int} key permet d'identifier l'activity data a trouver
     * @returns  une promise qui resoud et rend le resltat de la requete  si la requette est valide
     */
    this.findMax = function () {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT MAX (dataID) AS maxDataID FROM ActivityData"
            db.all(query, [], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }

};
var dao = new ActivityEntryDAO();
module.exports = dao;