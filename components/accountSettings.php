<?php
include( "../include/connect_db.php" );

// code to get global data
$id = $_SESSION['activeUser']->Get_id();

$sql = "SELECT * FROM users WHERE id = '$id'";
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
                            	<div class="col-md-10">
                                	<p>Account Settings</p>
                                </div>
                            </th>
                        </tr>
			            <tr>
			            	<td>
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
                                        <div class="col-md-7 col-md-offset-1">
			            		    		<!--Name-->
							                <div class="row" style="margin-top: 10px;">
							                    <div class="col-md-10 col-md-offset-2">
							                        <p>
							                        <strong>User Name: </strong>
							                        <?php
							                        foreach($result as $i){
							                            echo $i['username'];
							                        }
							                        ?>
							                        </p>
							                    </div>
							                </div>
							                <div class="row" style="padding: 10px; border-bottom: 1px solid white;">
							                    <div class="col-md-10 col-md-offset-2">
							                        <p><input id="input_username" placeholder="New username" name="new_username" style="color: black;">
							                        <Strong><span class="text-center"><button id="save_name" style="border-color: white; " class="btn btn btn-primary btn-s"> save </button></span></strong>
							                        </p>
							                    </div>
							                </div>
			                				<!--Team-->
			                				<div class="row" style="margin-top: 10px;">
			                    				<div class="col-md-10 col-md-offset-2">
				                        			<p>
				                        			<strong>Team: </strong>
				                        			<?php
				                        			foreach($result as $i){
				                            			echo $i['team'];
				                        			}
				                         			?>
				                        			</p>
				                   				</div>
			                				</div>
			                				<div class="row" style="padding: 10px; border-bottom: 1px solid white;">    
				                				<div class="col-md-10 col-md-offset-2">
				                    				<p>
									                <select id="select_team" name="new_team" style="color: black;">
									                    <option value="" disabled selected>Choose Team</option>
									                    <option value="Team Instinct">Team Instinct</option>
									                    <option value="Team Mystic">Team Mystic</option>
									                    <option value="Team Valor">Team Valor</option>
									                </select> 
				                    				<Strong><span class="text-center"><button id="save_team" style="border-color: white; " class="btn btn btn-primary btn-s"> save </button></span></strong>
				                    				</p>
									            </div>
									        </div>
		                    				<!--Avatar-->
			                				<div class="row" style="margin-top: 10px;">
			                    				<div class="col-md-10 col-md-offset-2">
			                        				<p>
			                        				<strong>Avatar: </strong>
                                                    </p>

                                                    <p>
                                                    <img src="img/pokeball.png" style="width:150px;height:150px; background: rgba(25, 25, 25, .10); border-radius: 5px; margin: 5px;">
			                            			<Strong><span class="text-center"> <button id="save_avatar_normal" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> save </button></span></strong>
			                            			</p>

                                                    <?php
                                                    foreach($result as $i){
                                                        if ($i['team'] == 'Team Valor') {
                                                            echo '<p>';
                                                            echo '<img src="img/pokeballTeamValor.png" style="width:150px;height:150px; background: rgba(25, 25, 25, .10); border-radius: 5px; margin: 5px;">';
                                                            echo '<Strong><span class="text-center"> <button id="save_avatar_Valor" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> save </button></span></strong>';
                                                            echo '</p>';
                                                        }elseif ($i['team'] == 'Team Mystic') {
                                                            echo '<p>';
                                                            echo '<img src="img/pokeballTeamMystic.png" style="width:150px;height:150px; background: rgba(25, 25, 25, .10); border-radius: 5px; margin: 5px;">';
                                                            echo '<Strong><span class="text-center"> <button id="save_avatar_Mystic" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> save </button></span></strong>';
                                                            echo '</p>';
                                                        }elseif ($i['team'] == 'Team Instinct') {
                                                            echo '<p>';
                                                            echo '<img src="img/pokeballTeamInstinct.png" style="width:150px;height:150px; background: rgba(25, 25, 25, .10); border-radius: 5px; margin: 5px;">';
                                                            echo '<Strong><span class="text-center"> <button id="save_avatar_Instinct" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> save </button></span></strong>';
                                                            echo '</p>';
                                                        }
                                                    }
                                                    ?>
                                                    
                                                    <p><input id="input_url" placeholder="Custom avatar URL" name="new_url" style="color: black;">
                                                     <Strong><span class="text-center"><button id="upload_avatar" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> upload </button> </span></strong>
                                                    </p>
                                                    <p>
                                                    <img id="customUrlImg" src="http://placehold.it/150x150" style="width:150px;height:150px; background: rgba(25, 25, 25, .10); border-radius: 5px; margin: 5px;">
                                                    <Strong><span class="text-center"> <button id="save_avatar_custom_url" style="border-color: white; " class="btn btn btn-primary btn-s save_avatar"> save </button></span></strong>
                                                    </p>


							                    </div>
							                </div>
        								</div>
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

<script>
$(document).ready(function(){
    $(document).off('click', '#save_name').on('click', '#save_name', function(e) {
    	if($("#input_username").val() != ""){
    		updateUserdataJs(<?php echo $id; ?>, 'username', $("#input_username").val());
        	changePageJs('accountSettings');
    	}else{
    		alert('New username kan inte vara tom');
    	}
    });
    $(document).off('click', '#save_team').on('click', '#save_team', function(e) {
    	if($("#select_team").val() != null){
    		updateUserdataJs(<?php echo $id; ?>, 'team', $("#select_team").val());
        	changePageJs('accountSettings');
    	}else{
    		alert('Inget Team selecterad');
    	}
    });
    $(document).off('click', '.save_avatar').on('click', '.save_avatar', function(e) {
    	if($(this).attr('id') == 'save_avatar_normal'){
    		updateUserdataJs(<?php echo $id; ?>, 'avatar', 'img/pokeball.png');
        	changePageJs('accountSettings');
    	}else if($(this).attr('id') == 'save_avatar_Valor'){
            updateUserdataJs(<?php echo $id; ?>, 'avatar', 'img/pokeballTeamValor.png');
            changePageJs('accountSettings');
        }else if($(this).attr('id') == 'save_avatar_Mystic'){
            updateUserdataJs(<?php echo $id; ?>, 'avatar', 'img/pokeballTeamMystic.png');
            changePageJs('accountSettings');
        }else if($(this).attr('id') == 'save_avatar_Instinct'){
            updateUserdataJs(<?php echo $id; ?>, 'avatar', 'img/pokeballTeamInstinct.png');
            changePageJs('accountSettings');
        }else if($(this).attr('id') == 'save_avatar_custom_url'){
            if (document.getElementById("customUrlImg").src != 'http://placehold.it/150x150'){
                updateUserdataJs(<?php echo $id; ?>, 'avatar', document.getElementById("customUrlImg").src);
                changePageJs('accountSettings');
            }else{
                alert('Först måster en bild laddas upp');
            }
        }else if($(this).attr('id') == 'upload_avatar'){
            if($("#input_url").val() != ""){
                function checkURL(url) {
                    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
                }
                if(checkURL($("#input_url").val())){
                    function checkImage (src, good, bad) {
                        var img = new Image();
                        img.onload = good; 
                        img.onerror = bad;
                        img.src = src;
                    }
                    checkImage($("#input_url").val(), function(){ document.getElementById("customUrlImg").src=$("#input_url").val(); }, function(){ alert('Custom avatar URL är ingen URL'); });
                }else{
                    alert('Custom avatar URL är ingen bild');
                }
            }else{
                alert('Custom avatar URL kan inte vara tom');
            }
        }
    });
});
</script>