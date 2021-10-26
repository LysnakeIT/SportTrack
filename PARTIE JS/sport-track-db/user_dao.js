var db = require('./sqlite_connection');

var UserDAO = function () {

    /**
     * Insertion d'un nouveau User
     * @param {Array} values le tableau de données de l'utiliseur
     * @returns une promesse
     */
    this.insert = function (values) {
        return new Promise(async function (resolve, reject) {
            const query = `INSERT INTO Account("nom", "prenom", "dateNaissance", "sexe", "taille", "poids", "adresseElectronique", "motDePasse") VALUES (?, ?, ?, ?, ?, ?, ?, ?)`;
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], values[6], values[7]], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        });
    }

    /**
     * Update le user passe en parametre
     * @param {String} key l'identifiant du user à update
     * @param {Array} values le tableau de donnée avec les nouvelles valeurs de l'user
     * @returns une promesse
     */
    this.update = function (key, values) {
        return new Promise(async function (resolve, reject) {
            const query = "UPDATE Account SET nom=?, prenom=?, dateNaissance=?, sexe=?, taille=?, poids=?, motDePasse=? WHERE adresseElectronique = ?"
            db.run(query, [values[0], values[1], values[2], values[3], values[4], values[5], values[6], key], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            })
        })
    };

    /**
     * Delete le user passe en parametre
     * @param {Int} key l'identifiant du user à delete
     * @returns une promesse
     */
    this.delete = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = `DELETE FROM Account WHERE adresseElectronique = ?`
            db.run(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Permet de récupérer touts les users stockées dans la base de donnée
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findAll = function () {
        return new Promise(async function (resolve, reject) {
            const query = "select * from Account"
            db.all(query, [], (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    };

    /**
     * Recupere les données du user passe en parametre
     * @param {Int} key l'identifiant du user à chercher
     * @returns une promesse avec le résultat de la requete si la requete est valide
     */
    this.findByKey = function (key) {
        return new Promise(async function (resolve, reject) {
            const query = "SELECT * FROM Account WHERE adresseElectronique = ?"
            db.all(query, key, (err, rows) => {
                if (err) reject(err)
                resolve(rows)
            });
        })
    }
};
var dao = new UserDAO();
module.exports = dao;