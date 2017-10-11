function loginJs(username, userPic, userEmail){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            username: username,
            userPic: userPic,
            email: userEmail,
            action: "signin"
        },
        success:  function(data){
        }
    });
}

function signoutJs(){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            action: "signout"
        },
        success:  function(data){
        }
    });
}

//Create a forum topic
function submitForumTopic(action, topicName, topicMessage, categoryChoice){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            topicName: topicName,
            topicMessage: topicMessage,
            categoryId: categoryChoice,
            action: "submitForumTopic"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("submittion worked!");
        }
    });
}

//Create a comment
function submitForumComment(topicId, topicMessage){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            topicId: topicId,
            topicMessage: topicMessage,
            action: "submitForumComment"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("Comment submittion worked!");
        }
    });
}

//Main navigation
function changePageJs(page){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            c: page,
            action: "changePage"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("changePageJs");
        }
    });
}

//Change forum category
function changeForumPageJs(categoryId){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            categoryId: categoryId,
            action: "changeForumPage"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("changeForumPageJs");
        }
    });
}

//Change forum topic
function changeForumPageDetailedJs(topicId){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            topicId: topicId,
            action: "changeForumPageTopic"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("changeForumPageDetailedJs");
        }
    });
}

function updateUserdataJs(id, varname, value){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            userId: id,
            varname: varname,
            value: value,
            action: "updateUserdata"
        },
        success:  function(data){
            $('#indexPageContainer').html(data);
            console.log("updateUserdataJs");
        }
    });
}
