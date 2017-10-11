<?php

function submitForumTopic(){
    include "connect_db.php";

    $topicName = $_REQUEST['topicName'];
    $topicMessage = $_REQUEST['topicMessage'];
    $topicCategoryId = $_REQUEST['categoryId'];
    $authorId = $_SESSION['activeUser']->Get_id();


    $sql = "INSERT INTO topics(topicName, message, categoryId, authorId) VALUES ('$topicName', '$topicMessage', '$topicCategoryId', '$authorId')";
    $sth = $pdo->prepare($sql);
    $sth->execute();

    $sql = "SELECT * FROM topics WHERE topicName = '$topicName' && message = '$topicMessage' && categoryId = '$topicCategoryId' && authorId = '$authorId'";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll();

    $topicId = 0;
    foreach($result as $i){
        $topicId = $i['topicId'];
    }

    //For debugging
    function debug_to_console( $data ) {

        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

    debug_to_console($topicId);

    return $topicId;

}

function submitForumComment(){
    include "connect_db.php";

    $topicId = $_REQUEST['topicId'];
    $topicMessage = $_REQUEST['topicMessage'];
    $authorId = $_SESSION['activeUser']->Get_id();


    $sql1 = "INSERT INTO topicreplies(replyId, message, authorId) VALUES ('$topicId', '$topicMessage', '$authorId')";
    $sth1 = $pdo->prepare($sql1);
    $sth1->execute();

    // updating comment counter
    $sql2 = "SELECT topics.topicId, topics.replies FROM topics WHERE topicId =".$topicId;
    $sth2 = $pdo->prepare($sql2);
    $sth2->execute();
    $result = $sth2->fetchAll();

    $replycount = 0;
    foreach($result as $i){
        $replycount = $i['replies'];
        $replycount++;
    }
    $sql3 = "UPDATE topics SET replies='".$replycount."' WHERE topicId = ".$topicId;
    $sth3 = $pdo->prepare($sql3);
    $sth3->execute();

    function debug_to_console( $data ) {

        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

    debug_to_console($topicId);

    return $topicId;

}



function login(){
 
    include "connect_db.php";

	$username = $_POST['username'];
    $avatar = $_POST['userPic'];
    $email = $_POST['email'];


    $sql = "SELECT * FROM users WHERE email = '$email'";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll();

    if(!empty($result)){
        foreach($result as $i){
            $user = new User($i['username'], $i['userType'], $i['id'], $i['email'], $i['avatar'], $i['signupDate'], $i['team']);
            $_SESSION['activeUser'] = $user;
        }

    }else{
        //Register new data
        $sql = "INSERT INTO users(username, avatar, email) VALUES ('$username','$avatar','$email')";
        $sth = $pdo->prepare($sql);
        $sth->execute();

        //Get new data
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();

        foreach($result as $i){
            $user = new User($i['username'], $i['userType'], $i['id'], $i['email'], $i['avatar'], $i['signupDate'], $i['team']);
            $_SESSION['activeUser'] = $user;
        }
    }
}

function signout(){
    session_unset("activeUser");
    session_destroy("activeUser");
}


function updateUserdataPhp(){
    $userId = $_REQUEST['userId'];
    $varname = $_REQUEST['varname'];
    $value = $_REQUEST['value'];

    include( "../include/connect_db.php" );
    $sql = "UPDATE users SET ".$varname."='".$value."' WHERE id = ".$userId;
    $sth = $pdo->prepare($sql);
    $sth->execute();

    if ($varname == "username"){
        $_SESSION['activeUser']->Set_name($value);
    }else if($varname == "team"){
        $_SESSION['activeUser']->Set_team($value);
    }else if($varname == "avatar"){
        $_SESSION['activeUser']->Set_avatar($value);
    }
}
?>