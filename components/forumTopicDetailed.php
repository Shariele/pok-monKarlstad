<?php
include( "../include/connect_db.php" );

if(isset($_REQUEST['topicId'])){
    $topicChoice = $_REQUEST['topicId'];
}

if(isset($variableForTopicId) && $variableForTopicId != "none"){
    $topicChoice = $variableForTopicId;
}

//Get data of the topic.
$sql = "SELECT topics.topicId, topics.topicName, topics.message, topics.time, topics.categoryId, topics.authorId, users.id, users.username, users.avatar, users.userType, users.team, categories.id, categories.name FROM topics INNER JOIN users ON topics.authorId=users.id INNER JOIN categories ON topics.categoryId=categories.id WHERE topicId=".$topicChoice;

$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();

//get comments data
$sql2 = "SELECT topicreplies.replyId, topicreplies.time, topicreplies.message, topicreplies.authorId, users.id, users.username, users.avatar, users.userType, users.team FROM topicreplies INNER JOIN users ON topicreplies.authorId=users.id WHERE replyId=".$topicChoice." ORDER BY time";

$sth2 = $pdo->prepare($sql2);
$sth2->execute();

$result_comments = $sth2->fetchAll();

?>
<body>
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>
                                <div class="col-md-2"> <!--forum nav-->
                                    <?php 
                                    foreach($result as $i){
                                        echo "<Strong><p class=\"text-center\"><button id=\"".$i['categoryId']."\" style=\"border-color: white; \" class=\"btn btn btn-primary btn-s backButtonTopics\"> Back </button></p></strong>\n";
                                        }
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <p style="margin: 0px; padding: 5px; text-decoration-style: none; font-weight: normal;">
                                    /
                                    <a style="cursor: pointer;" id="indexPage">Home</a>
                                    /
                                    <a style="cursor: pointer;" id="pokeForum">Forum</a>
                                    /
                                    <?php 
                                    foreach($result as $n){
                                        echo "<a style=\"cursor: pointer;\" class=\"category\" id=\"".$n['categoryId']."\">".$n['name']."</a>\n";
                                        break;
                                    }
                                    ?>
                                    /
                                    <?php 
                                    foreach($result as $n){
                                        echo "<a style=\"cursor: pointer;\" class=\"topic\" id=\"".$n['topicId']."\"><strong>".$n['topicName']."</strong></a>\n";
                                        break;
                                    }
                                    ?>
                                    </p>
                                </div>
                                <?php if(isset($_SESSION['activeUser'])){
                                    echo "<div class=\"col-md-2 pull-right\">\n";
                                        echo "<Strong><p class=\"text-center\"><button id=\"createForumTopic\" style=\"border-color: white;\" class=\"btn btn btn-primary btn-s\">Create Topic</button></p></strong>\n";
                                    echo "</div>\n";
                                    }
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <?php
                            foreach($result as $n){
                                echo "<td><Strong><p class=\"text-center\" style=\"font-size: 16px;\">".$n['topicName']."</p></strong></td>\n";
                                break;
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <!--Topic-->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div id="author_box">
                                                <div class="row">
                                                    <!--Avatar-->
                                                    <div class="col-md-12 text-center">
                                                        <?php
                                                        foreach($result as $i){
                                                            if($i['avatar'] == "" or $i['avatar'] == null){
                                                                echo "<img src=\"img/pokeball.png\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                            }else{
                                                                echo "<img src=".$i['avatar']." alt=\"Avatar\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <!--Name-->
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <?php
                                                        foreach($result as $i){
                                                            echo "<p>".$i['username']."</p>";
                                                            echo "<p>".$i['team']."</p>";
                                                            if($i['userType'] == 1 or $i['userType'] == 2){
                                                                echo " <p><span class=\"label label-warning\">".$i['userType']."</span></p>";
                                                            }else{
                                                                echo " <p><span class=\"label\">".$i['userType']."</span></p>";
                                                            }
                                                        }
                                                         ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 img_max">
                                            <?php
                                            foreach($result as $i){
                                                echo "".$i['message']."";
                                            }
                                             ?>
                                        </div>
                                    </div>
                        		</div>
                            </td>
                        </tr>        
                        <tr>
                            <td id="nolinefoot">    
                                <div class="col-md-12 text-center" id="topic_footer">
                                    <div class="row">
                                        <?php
                                        foreach($result as $i){
                                            echo "<p>".$i['username']."";
                                            echo " <small>".$i['time']."</small>";
                                            echo "<span class=\"pull-right\">[<small> #1 </small>] </span></p>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <!--Comments-->
                        <?php
                        $cmd_nr = 1;
                        foreach($result_comments as $n){
                            $cmd_nr++;
                            echo "<tr>\n";
                                echo "<td id=\"nolinefoot\">\n";
                                    echo "<div class=\"col-md-12\">\n";
                                        echo "<div class=\"row\">\n";
                                            echo "<div class=\"col-md-3\">\n";
                                                echo "<div id=\"author_box\">\n";
                                                    echo "<div class=\"row\">\n";
                                                        //avatar
                                                        echo "<div class=\"col-md-12 text-center\">\n";
                                                        if($n['avatar'] == "" or $n['avatar'] == null){
                                                            echo "<img src=\"img/pokeball.png\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                        }else{
                                                            echo "<img src=".$n['avatar']." alt=\"Avatar\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                        }
                                                        echo "</div>\n";
                                                    echo "</div>\n";
                                                    echo "<div class=\"row\">\n";
                                                        echo "<div class=\"col-md-12 text-left\">\n";
                                                            echo "<p>".$n['username']."</p>\n";
                                                            echo "<p>".$n['team']."</p>\n";
                                                            if($n['userType'] == 1 or $n['userType'] == 2){
                                                                echo " <p><span class=\"label label-warning\">".$n['userType']."</span></p>";
                                                            }else{
                                                                echo " <p><span class=\"label\">".$n['userType']."</span></p>";
                                                            }
                                                        echo "</div>\n";
                                                    echo "</div>\n";
                                                echo "</div>\n";
                                            echo "</div>\n";
                                            echo "<div class=\"col-md-9 img_max\">\n";
                                                echo "".$n['message']."";
                                            echo "</div>\n";
                                        echo "</div>\n";
                                    echo "</div>\n";
                                echo "</td>\n";
                            echo "</tr>\n";
                            echo "<tr>\n";
                                echo "<td id=\"nolinefoot\">\n";
                                    echo "<div class=\"col-md-12 text-center\" id=\"topic_footer\">\n";
                                        echo "<div class=\"row\">\n";
                                            echo "<p>".$n['username']."";
                                            echo " <small>".$n['time']."</small>";
                                            echo "<span class=\"pull-right\">[<small> #".$cmd_nr." </small>] </span></p>";
                                        echo "</div>\n";
                                    echo "</div>\n";
                                echo "</td>\n";
                            echo "</tr>\n";
                        }
                        ?>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if(isset($_SESSION['activeUser'])){
                                        echo "<div class=\"col-md-12\">\n";
                                            echo "<div class=\"row\">\n";
                                                echo "<div class=\"col-md-3\">\n";
                                                    echo "<div id=\"author_box\">\n";
                                                        echo "<div class=\"row\">\n";
                                                            //avatar
                                                            echo "<div class=\"col-md-12 text-center\">\n";
                                                            if($_SESSION['activeUser']->Get_avatar() == "" or $_SESSION['activeUser']->Get_avatar() == null){
                                                                echo "<img src=\"img/pokeball.png\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                            }else{
                                                                $sessionavatar = $_SESSION['activeUser']->Get_avatar();
                                                                echo "<img src=".$sessionavatar." alt=\"Avatar\" style=\"width:150px;height:150px; border-radius: 5px;\"> ";
                                                            }
                                                            echo "</div>\n";
                                                        echo "</div>\n";
                                                        echo "<div class=\"row\">\n";
                                                            echo "<div class=\"col-md-12 text-left\">\n";
                                                                $sessionusername = $_SESSION['activeUser']->Get_name();
                                                                echo "<p>".$sessionusername."</p>\n";
                                                                $sessionteam = $_SESSION['activeUser']->Get_team();
                                                                echo "<p>".$sessionteam."</p>\n";
                                                                $sessionusertype = $_SESSION['activeUser']->Get_type();
                                                                if($sessionusertype == 1 or $sessionusertype == 2){
                                                                    echo " <p><span class=\"label label-warning\">".$sessionusertype."</span></p>";
                                                                }else{
                                                                    echo " <p><span class=\"label\">".$sessionusertype."</span></p>";
                                                                }
                                                            echo "</div>\n";
                                                        echo "</div>\n";
                                                    echo "</div>\n";
                                                echo "</div>\n";
                                                echo "<div class=\"col-md-9\">\n";
                                                    echo "<textarea id=\"topicComment\"></textarea>";
                                                echo "</div>\n";
                                            echo "</div>\n";
                                        echo "</div>\n";
                                        echo "<div class=\"col-md-2 pull-right\">\n";
                                            echo "<Strong><p class=\"text-center\"><button id=\"".$topicChoice."\" style=\"border-color: white;\" class=\"btn btn btn-primary btn-s submitForumComment\">Submit Comment</button></p></strong>\n";
                                        echo "</div>\n";
                                    }else{                             
                                        echo "<div class=\"col-md-12 text-center\">\n";
                                            echo "<div class=\"row\">\n";
                                                echo "<p> You need to be logged in to write a comment! </p>\n";
                                            echo "</div>\n";
                                        echo "</div>\n";
                                    }
                                ?>
                            </td>
                        </tr>   
                    </table>
                </div>
            </div>
        </div>
    </div> 

</div> <!--Container-->
</body>
                        
<script>
$(document).ready(function(){
    $(document).off('click', '.backButtonTopics').on('click', '.backButtonTopics', function(e) {

        changeForumPageJs($(this).attr('id'));

    });
    $(document).off('click', '.topic').on('click', '.topic', function(e) {

        changeForumPageDetailedJs($(this).attr('id'));

    });
    $(document).off('click', '.submitForumComment').on('click', '.submitForumComment', function(e) {

        if ( CKEDITOR.instances.topicComment.getData() == "" ){
            alert( 'Ingen commentar skriven' );
        }else{
            submitForumComment($(this).attr('id'), CKEDITOR.instances.topicComment.getData());
        }

    });
});
CKEDITOR.replace( 'topicComment' );
CKEDITOR.config.height = 200;
</script>