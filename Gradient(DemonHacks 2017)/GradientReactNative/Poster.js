/**
 * Created by diamondrubix on 5/29/17.
 */
//url = '172.18.100.133' //home


exports.AllPage = function (key) {
    return fetch('http://'+url+':'+port+'/phoneGetPost',
        {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                key: key
            })
        })
    //.then((result)=> {console.warn("Result:",result); return result})
    //.catch((error)=> {console.warn("Error: ",result); return result})
}


exports.getAllPost = function(key,username){
    return fetch('http://'+url+':'+port+'/phoneGetAllUserPost', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            key: key,
            username: username,
            logged: "true"
        })
    })

}

exports.getPostAnswers = function(key,url){
    return fetch('http://'+url+':'+port+'/phoneGetPostAnswers', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            key: key,
            username: username,
            url: url,
            logged: "true"
        })
    })

}

/*
exports.Test = function () {
    return fetch('http://www.programminginitiative.com/gradient/new_account.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: JSON.stringify({
            username: 'coffee100',
            password: 'test',
        })
    })
}*/

exports.Test2 = function(){
    return fetch('http://'+url+":"+port+'/gradient/new_account.php', {
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username=coffee24&password=password"
    })
}

exports.SignUp = function(username,password){
    return fetch('http://'+url+":"+port+'/gradient/new_account.php', {
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username="+username+"&password="+password
    })
}

exports.Login = function(username,password){
    return fetch('http://'+url+":"+port+'/gradient/login.php', {
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username="+username+"&password="+password
    })
}

exports.UploadPost = function (text) {
    return fetch('http://'+url+":"+port+'/gradient/upload_post.php',{
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "session_id="+key+"&text="+text
    })

}
//http://www.programminginitiative.com/gradient/get_feed.php
exports.GetFeed = function(){
    return fetch('http://'+url+":"+port+'/gradient/get_feed.php',{
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username="+username
    })
}

exports.SendLocation = function(latitude,longitude){
    return fetch('http://'+url+":"+port+'/gradient/swap_geographical.php',{
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username="+username+"&latitude="+latitude+"&longitude="+longitude
    })
}

exports.GetAllPost = function(){
    return fetch('http://'+url+":"+port+'/gradient/get_all_posts.php',{
        method: 'POST',
        headers: { 'Accept': 'application/json','Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: "username"
    })
}
//"session_id="+key+"&text="+text+"&colorA="+colorA+"&colorB="+colorB

//* this post request works
exports.testConnection =  function() {
    fetch('http://'+url+':'+port+'/phone/', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            firstParam: 'yourValue',
            secondParam: 'yourOtherValue',
        })
    })
}
