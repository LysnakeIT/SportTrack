var user_dao = require('./sport-track-db').user_dao;
var activity_dao = require('./sport-track-db').activity_dao
var activity_entry_dao = require('./sport-track-db').activity_entry_dao

var userDAO = ["Damien", "Lilian", "10/09/2020", "h", 1.69, 78, "lilian@live.com", "Mlkpoi25"]
var userUpdate = ["Arnaud", "Come", "10/09/2020", "h", 1.89, 78, "lilian@live.com", "Mlkpoi25"]
var activityDAO = [3, "14/08/2002", "Bonjour js", "lilian@live.com", 100, 120, 150, "13:00:00", 777]
var activityUpdate = ["14/08/2002", "Au revoir js", "lilian@live.com", 100, 120, 150, "11:00:00", 777]
var activityEntry = [13, "12:00:00", 120, 40, -1, 14, 1];
var activityEntryUpdate = ["12:00:15", 100, 50, -2, 18, 1];


async function scriptTest() {
    console.log("---- Account ----")
    let user = await user_dao.findAll()
    console.log("FindAll() -->")
    console.log(user)
    user = await user_dao.insert(userDAO)
    console.log("Insert() -->")
    user = await user_dao.update("lilian@live.com", userUpdate)
    console.log("Update() -->")
    user = await user_dao.findByKey("lilian@live.com")
    console.log("findByKey() -->")
    console.log(user)
    user = await user_dao.delete("lilian@live.com")
    console.log("Delete() -->")
    user = await user_dao.findAll()
    console.log("FindAll() -->")
    console.log(user)

    console.log("---- Activity ----")
    let activity = await activity_dao.findAll()
    console.log("FindAll() -->")
    console.log(activity)
    activity = await activity_dao.insert(activityDAO)
    console.log("Insert() -->")
    activity = await activity_dao.update("3", activityUpdate)
    console.log("Update() -->")
    activity = await activity_dao.findByKey("3")
    console.log("findByKey() -->")
    console.log(activity)
    activity = await activity_dao.findByEmail("lilian@live.com")
    console.log("findByEmail() -->")
    console.log(activity)
    activity = await activity_dao.findMax()
    console.log("FindMax() -->")
    console.log(activity)
    activity = await activity_dao.delete("3")
    console.log("Delete() -->")
    activity = await activity_dao.findAll()
    console.log("FindAll() -->")
    console.log(activity)

    console.log("---- Data ----")
    let data = await activity_entry_dao.findAll()
    console.log("FindAll() -->")
    console.log(data)
    data = await activity_entry_dao.insert(activityEntry)
    console.log("Insert() -->")
    data = await activity_entry_dao.update("13", activityEntryUpdate)
    console.log("Update() -->")
    data = await activity_entry_dao.findByKey("13")
    console.log("findByKey() -->")
    console.log(data)
    data = await activity_entry_dao.delete("13")
    console.log("Delete() -->")
    data = await activity_entry_dao.findAll()
    console.log("FindAll() -->")
    console.log(data)
}
scriptTest()