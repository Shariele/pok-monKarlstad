<?php
include( "../include/connect_db.php" );
$categoryId = 3; //News category id
$nrRows = 3;
$newsLimit = ($nrRows*3)+1;
//$newsLimit max nr of news for page 1
$sql = "SELECT * FROM topics WHERE categoryId=".$categoryId." ORDER BY time DESC LIMIT ".$newsLimit;
//get last $newsLimit posts from category 3
$sth = $pdo->prepare($sql);
$sth->execute();
$result = $sth->fetchAll();

$news_array = array();
$i = 1;
foreach($result as $n){
    $news_array[$i] = $n;
    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $news_array[$i]['message'], $image);
    if (isset($image['src'])){
    	$news_array[$i]['src'] = $image['src'];
    }
    $i++;
}
unset($i);
?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
	                <table class="table" style="border-bottom: 1px solid white;">
	                   	<tr>
	                        <th style="border-bottom: 1px solid white;">
								<div class="col-md-12">
									<div class="row">
										<div id="news_1_img_box" class="news_1_img_max">
											<?php
												//News 1 stor
								                echo'<p style="font-size: 18px; cursor: pointer;" id="'.$news_array[1]['topicId'].'" class="topic">'.$news_array[1]['topicName'].'</p>';
								                echo'<p>'.$news_array[1]['message'].'</p>';
								                echo'<p>'.$news_array[1]['time'].'</p>';

								            ?>
						            	</div>
						            </div>
						        </div>
						    </th>
						</tr>
						<?php
							$i = 1;
							$n = 1;
							while($i <= $nrRows) {
								echo '<tr>';
									echo '<td id="nolinefoot">';
							    		echo '<div class="col-md-12">';
							        		for ($a = 1; $a <= 3; $a++) {
								        		$n++;
								        		if (array_key_exists($n, $news_array)){
													echo '<div class="col-md-4">';
														//News 3 små per row
														echo'<p class="thumbnail topic" id="'.$news_array[$n]['topicId'].'" style="cursor: pointer;">';
														echo $news_array[$n]['topicName'];
														if (isset($news_array[$n]['src'])){
															echo'<img src="'.$news_array[$n]['src'].'">';
														}
									            		echo '<br><small>'.$news_array[$n]['time'].'</small></p>';

									            	echo '</div>';	
												}
								        }
								        echo '</div>';
									echo '</td>';
								echo '</tr>';
							$i++;
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
    $(document).off('click', '.topic').on('click', '.topic', function(e) {

        changeForumPageDetailedJs($(this).attr('id'));

    });
});
</script>