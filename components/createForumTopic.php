<?php 
include "../include/connect_db.php";


$sql = "SELECT * FROM categories";
$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();

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
                                    <Strong><p class="text-center"><button id="pokeForum" style="border-color: white;" class="btn btn btn-primary btn-s"> Back </button></p></strong>
                                </div>
                                <div class="col-md-10">
                                    <p style="margin: 0px; padding: 5px; text-decoration-style: none; font-weight: normal;">
                                    /
                                    <a style="cursor: pointer;" id="indexPage">Home</a>
                                    /
                                    <a style="cursor: pointer;" id="pokeForum">Forum</a>
                                    /
                                    <select id="categoryChoice" style="width: 50%;color: rgb(51, 51, 51);text-decoration-style: none; font-weight: normal;">
                                        <option value="" disabled selected>Choose category</option>
                                         <?php
                                            foreach($result as $i){
                                                if($i['name'] == "News"){
                                                    if($_SESSION['activeUser']->Get_type() == 1 or $_SESSION['activeUser']->Get_type() == 2){
                                                        echo "<option value=$i[id] style=\"cursor: pointer;\" class=\"divider\" id=$i[id]>$i[name]</option>";
                                                    }
                                                }else if($i['name']=="Team Valor"||$i['name']=="Team Instinct"||$i['name']=="Team Mystic"){
                                                    if($_SESSION['activeUser']->Get_Team() == $i['name']){
                                                        echo "<option value=$i[id] style=\"cursor: pointer;\" id=$i[id]><a>$i[name]</option>";
                                                    }
                                                }else{
                                                    echo "<option value=$i[id] style=\"cursor: pointer;\" id=$i[id]><a>$i[name]</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                    /
                                    </p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td id="nolinefoot">
                                <div class="col-md-12">
                                    <div class="col-md-1">
                                        <p>Title: <p>
                                    </div> 
                                    <div class="col-md-10">
                                        <input id="topicName" class="col-md-12" style="color: rgb(51, 51, 51);" type="text" placeholder="Topic title">
                                    </div>  
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="nolinefoot">
                                <div class="col-md-12">
                                    <textarea id="topicMessage"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="nolinefoot">
                                <div class="col-md-12">
                                    <div class="col-xs-4 pull-right">
                                        <Strong><p class="text-right"><button id="submitForumTopic" style="border-color: white;" class="btn btn btn-primary btn-s">Submit Topic</button></p></strong>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>


<script type="text/javascript">
$(document).ready(function(){
    $(document).off('click', '#submitForumTopic').on('click', '#submitForumTopic', function(e) {
        
        if ( $("#categoryChoice").val() == null ){
            alert( 'Välj en categori' );
        }else if ( $("#topicName").val() == "" ){
            alert( 'Ingen Titel angiven' );
        }else if ( CKEDITOR.instances.topicMessage.getData() == "" ){
            alert( 'Ingen topic skriven' );
        }else{
            submitForumTopic($(this).attr('id'), $("#topicName").val(), CKEDITOR.instances.topicMessage.getData(), $("#categoryChoice").val());        
        }

    });
});
CKEDITOR.replace( 'topicMessage' );
CKEDITOR.config.height = 400;
</script>