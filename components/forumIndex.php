<?php
include( "../include/connect_db.php" );

$sql = "SELECT * FROM categories ORDER BY id";
$sth = $pdo->prepare($sql);
$sth->execute();
$result = $sth->fetchAll();
// var_dump($result);

$latest_entrys = array();
foreach($result as $n){
    $sql = "SELECT topics.topicId, topics.topicName, topics.time, topics.categoryId, topics.authorId, users.id, users.username FROM topics INNER JOIN users ON topics.authorId=users.id WHERE categoryId=".$n['id']." ORDER BY time DESC LIMIT 1";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    foreach($res as $r){
        $latest_entrys[$n['id']] = $r;
    }
}
    //print_r($latest_entrys);
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
                                    <Strong><p class="text-center"><button id="indexPage" style="border-color: white;" class="btn btn btn-primary btn-s"> Back </button></p></strong>
                                </div>
                                <div class="col-md-4">
                                    <p style="margin: 0px; padding: 5px; text-decoration-style: none; font-weight: normal;">
                                    /
                                    <a style="cursor: pointer;" id="indexPage">Home</a>
                                    /
                                    <a style="cursor: pointer;" id="pokeForum"><strong>Forum</strong></a>
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
                        <tr><td><Strong><p class="text-left">Forum</p></strong></td></tr>
                        <?php
                        if(!isset($_SESSION['activeUser'])){
                            echo "<tr class=\"pokeball\">\n";
                                echo "<td>\n";
                                    echo "<div class=\"col-md-12\">\n";
                                        echo "<div class=\"col-md-6\">\n";
                                            echo "<p>!! Du ska vara inloggad för att kunna se Team Forum\n";
                                        echo "</div>\n";
                                    echo "</div>\n";
                                echo "</td>\n";
                            echo "</tr>\n";
                        }else{
                            foreach($result as $n){
                                if($_SESSION['activeUser']->Get_team() == "No Team"){
                                    echo "<tr class=\"pokeball\">\n";
                                        echo "<td>\n";
                                            echo "<div class=\"col-md-12\">\n";
                                                echo "<div class=\"col-md-6\">\n";
                                                    echo "<p>!! Du ska joina ett Team för att kunna se Team Forum\n";
                                                echo "</div>\n";
                                            echo "</div>\n";
                                        echo "</td>\n";
                                    echo "</tr>\n";
                                    break;
                                }
                            }
                        }
                        foreach($result as $n){
                            if(isset($_SESSION['activeUser'])){
                                if ($n['name'] == $_SESSION['activeUser']->Get_team()){
                                    echo "<tr class=\"pokeball\">\n";
                                        echo "<td>\n";
                                            echo "<div class=\"col-md-12\">\n";
                                                echo "<div class=\"col-md-6\">\n";
                                                    if ($n['name']=='Team Valor'){
                                                        echo "<img src=\"img/pokeballTeamValor.png\" alt=\" \" style=\" heigth: 64px; width: 64px;\">\n";
                                                    }elseif ($n['name']=='Team Mystic'){
                                                        echo "<img src=\"img/pokeballTeamMystic.png\" alt=\" \" style=\" heigth: 64px; width: 64px;\">\n";
                                                    }elseif ($n['name']=='Team Instinct'){
                                                        echo "<img src=\"img/pokeballTeamInstinct.png\" alt=\" \" style=\" heigth: 64px; width: 64px;\">\n";
                                                    }
                                                     echo "<a class=\"category\" style=\"cursor: pointer;\" id=".$n['id'].">".$n['name']."</a>\n";
                                                echo "</div>\n";
                                                echo "<div class=\"col-md-6\">\n";
                                                    echo "<p style=\"margin: 0px; padding-top: 8px;\"><small>Senaste inlägg: </small><a class=\"topic\" style=\"cursor: pointer;\" id=".$latest_entrys[$n['id']]['topicId'].">".$latest_entrys[$n['id']]['topicName']."</a></p>\n";
                                                    echo "<p style=\"margin: 0px; padding: 4px;\"><small>".$latest_entrys[$n['id']]['username'].", ".$latest_entrys[$n['id']]['time']."</small></p>\n";
                                                echo "</div>\n";
                                            echo "</div>\n";
                                        echo "</td>\n";
                                    echo "</tr>\n";
                                }
                            }
                            if ($n['name']!="Team Valor"&&$n['name']!="Team Instinct"&&$n['name']!="Team Mystic"){
                                echo "<tr class=\"pokeball\">\n";
                                    echo "<td>\n";
                                        echo "<div class=\"col-md-12\">\n";
                                            echo "<div class=\"col-md-6\">\n";
                                                echo "<img src=\"img/pokeball.png\" alt=\" \" style=\" heigth: 64px; width: 64px;\">\n";
                                                 echo "<a class=\"category\" style=\"cursor: pointer;\" id=".$n['id'].">".$n['name']."</a>\n";
                                            echo "</div>\n";
                                            echo "<div class=\"col-md-6\">\n";
                                                echo "<p style=\"margin: 0px; padding-top: 8px;\"><small>Senaste inlägg: </small><a class=\"topic\" style=\"cursor: pointer;\" id=".$latest_entrys[$n['id']]['topicId'].">".$latest_entrys[$n['id']]['topicName']."</a></p>\n";
                                                echo "<p style=\"margin: 0px; padding: 4px;\"><small>".$latest_entrys[$n['id']]['username'].", ".$latest_entrys[$n['id']]['time']."</small></p>\n";
                                            echo "</div>\n";
                                        echo "</div>\n";
                                    echo "</td>\n";
                                echo "</tr>\n";
                            }
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
    $(document).off('click', '#createForumTopic').on('click', '#createForumTopic', function(e) {

        changeForumPageJs($(this).attr('id'));

    });
});
</script>