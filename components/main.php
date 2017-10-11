<?php
include( "../include/connect_db.php" );
$categoryId = 3; //News category id
$sql = "SELECT * FROM topics WHERE categoryId=".$categoryId." ORDER BY time DESC LIMIT 4";
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
                    <table class="table">
                    	<tr>
                            <td>
                            	<div class="col-md-12" id="welcome_text">
	                            	<p>Hej och välkommen till PokémonKarlstad!</p><br>
	                            	<p>Vi är tre studenter på Karlstad Universitet som Gillar och är uppvuxna med Pokémon och därför var Pokémon Go det självklara valet!</p>
	                            	<p>Vi har skapat denna sida för att få ihop folket enkelt i Karlstad med omnejd. Här har vi ett community som alla får skriva ner frågor, erfarenheter, byten av Pokémons(när det implementeras i spelet) och självklart bara för att vara sociala/meet-ups!</p>
	                            	<p>Vi vill att Pokémon Karlstad communityt ska vara tryggt och ett riktigt kul ställe för folk i alla åldrar och erfarenheter att samlas!</p>
	                            	<p>Har ni några som helst frågor eller problem, skriv till pokemonkarlstad@gmail.com så svarar vi så fort som möjligt!</p><br>
	                            	<p>Så, ut och “Catch ‘em all!”</p>
	                            	<p>//PokémonKarlstad Crew</p>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            	<div class="col-md-12">
								<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active" style="float: none;"></li>
								<li data-target="#myCarousel" data-slide-to="1" style="float: none;"></li>
								<li data-target="#myCarousel" data-slide-to="2" style="float: none;"></li>
								<li data-target="#myCarousel" data-slide-to="3" style="float: none;"></li>
								</ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<div class="item active">
										<div id="<?php echo $news_array[1]['topicId'];?>" class="col-xs-12 topic" style="cursor: pointer;">
											<img class="img-rounded center-block" border="0" name="myimage" src="<?php echo $news_array[1]['src'];?>" alt="I have no picture yet!" height="400">
											<div class="carousel-caption">
								                <h4 id="carousel_caption_bg"><?php echo $news_array[1]['topicName'];?></h4>
								            </div>
										</div>
									</div>
									<div class="item">
										<div id="<?php echo $news_array[2]['topicId'];?>" class="col-xs-12 topic" style="cursor: pointer;">
											<img class="img-rounded center-block" border="0" name="myimage" src="<?php echo $news_array[2]['src'];?>" alt="I have no picture yet!" height="400">
											<div class="carousel-caption">
								                <h4 id="carousel_caption_bg"><?php echo $news_array[2]['topicName'];?></h4>
								            </div>
										</div>
									</div>
									<div class="item">
										<div id="<?php echo $news_array[3]['topicId'];?>" class="col-xs-12 topic" style="cursor: pointer;">
											<img class="img-rounded center-block" border="0" name="myimage" src="<?php echo $news_array[3]['src'];?>" alt="I have no picture yet!" height="400">
											<div class="carousel-caption">
								                <h4 id="carousel_caption_bg"><?php echo $news_array[3]['topicName'];?></h4>
								            </div>
										</div>
									</div>
									<div class="item">
										<div id="<?php echo $news_array[4]['topicId'];?>" class="col-xs-12 topic" style="cursor: pointer;">
											<img class="img-rounded center-block" border="0" name="myimage" src="<?php echo $news_array[4]['src'];?>" alt="I have no picture yet!" height="400">
											<div class="carousel-caption">
								                <h4 id="carousel_caption_bg"><?php echo $news_array[4]['topicName'];?></h4>
								            </div>
										</div>
									</div>
								</div>

								<!-- Left and right controls -->
								<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
								</a>
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
    $(document).off('click', '.topic').on('click', '.topic', function(e) {

        changeForumPageDetailedJs($(this).attr('id'));

    });
});
</script>