<?php
include( "../include/connect_db.php" );
$categoryId = $_REQUEST['categoryId'];

$sql = "SELECT topics.topicId, topics.topicName, topics.time, topics.categoryId, topics.authorId, topics.replies, users.id, users.username, categories.id, categories.name FROM topics INNER JOIN users ON topics.authorId=users.id INNER JOIN categories ON topics.categoryId=categories.id WHERE categoryId=".$categoryId." ORDER BY time DESC";
$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();

$latest_replies = array();
foreach($result as $n){
    $sql = "SELECT topicreplies.replyId, topicreplies.authorId, topicreplies.time, users.id, users.username FROM topicreplies INNER JOIN users ON topicreplies.authorId=users.id WHERE replyId=".$n['topicId']." ORDER BY time DESC LIMIT 1";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    foreach($res as $r){
        $latest_replies[$n['topicId']] = $r;
    }
}
?>
<body>
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>
                                <div class="col-md-2">
                                    <Strong><p class="text-center"><button id="pokeForum" style="border-color: white; " class="btn btn btn-primary btn-s"> Back </button></p></strong>
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
                                        echo "<a style=\"cursor: pointer;\" class=\"category\" id=\"".$n['categoryId']."\"><strong>".$n['name']."</strong></a>\n";
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
                            echo "<td><Strong><p class=\"text-left\">".$n['name']."</p></strong></td>\n";
                            break;
                        }
                        echo "</tr>\n";
                        foreach($result as $n){
                            echo "<tr class=\"pokeball\">\n";
                                echo "<td>\n";
                                    echo "<div class=\"col-md-12\">\n";
                                        echo "<div class=\"col-md-6\">\n";
                                            if ($n['name']!="Team Valor"&&$n['name']!="Team Instinct"&&$n['name']!="Team Mystic"){
                                            echo "<img src=\"img/pokeball.png\" alt=\" \" style=\" heigth: 32px; width: 32px;\">\n";
                                            }else{
                                                if ($n['name']=='Team Valor'){
                                                    echo "<img src=\"img/pokeballTeamValor.png\" alt=\" \" style=\" heigth: 32px; width: 32px;\">\n";
                                                }elseif ($n['name']=='Team Mystic'){
                                                    echo "<img src=\"img/pokeballTeamMystic.png\" alt=\" \" style=\" heigth: 32px; width: 32px;\">\n";
                                                }elseif ($n['name']=='Team Instinct'){
                                                    echo "<img src=\"img/pokeballTeamInstinct.png\" alt=\" \" style=\" heigth: 32px; width: 32px;\">\n";
                                                }
                                            }   
                                             echo "<a class=\"topic\" style=\"cursor: pointer; padding-right: 50%;\" id=".$n['topicId'].">".$n['topicName']."</a></p><p>".$n['username'].", "."<small>".$n['time']."</small></p>\n";
                                        echo "</div>\n";
                                        echo "<div class=\"col-md-6\">\n";
                                            if(isset($latest_replies[$n['topicId']]['username'])){
                                                echo "<br><p style=\"margin: 0px; padding-top: 8px;\"><small>Commentarer: </small>".$n['replies']."<small> Senaste av: </small>".$latest_replies[$n['topicId']]['username'].", <small>".$latest_replies[$n['topicId']]['time']."</small></p>\n";
                                            }else{
                                                echo "<br><p style=\"margin: 0px; padding-top: 8px;\"><small>Commentarer: </small>".$n['replies']."</p>\n";
                                            }
                                        echo "</div>\n";
                                    echo "</div>\n";
                                echo "</td>\n";
                            echo "</tr>\n";
                        }
                        ?>
                    </table>
                </div>
            </div>
		</div>
	</div>
</body>

<script>
$(document).ready(function(){
    $(document).off('click', '.category').on('click', '.category', function(e) {
        
        changeForumPageJs($(this).attr('id'));

    });
    $(document).off('click', '.topic').on('click', '.topic', function(e) {

        changeForumPageDetailedJs($(this).attr('id'));

    });
});
</script>