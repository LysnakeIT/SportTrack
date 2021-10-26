let sqlite3 = require('sqlite3').verbose();
let db = new sqlite3.Database(__dirname + '/./sport_track.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
        return console.error("Connexion echouee " + err.message);
    } else {
        console.log('Connexion réussie ');
    }
})

module.exports = db;