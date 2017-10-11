<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="PokemonKarlstad, ett Pokemon Go community i Karlstad">
<meta name="author" content="PokemonKarlstad Crew">
<meta name="keywords" content="pokemonkarlstad, pokemon, karlstad, pokemongo, pokemongokarlstad, go">


<!--Google-->
<meta name="google-signin-client_id" content="854817398641-uflkg8rhh1e1i93o10bera66o01cqmqb.apps.googleusercontent.com">
<meta name="google-signin-scope" content="profile email">
<script src="https://apis.google.com/js/platform.js" async defer></script>

<link rel="icon" href="img/favicon.png">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<!-- Bootstrap core CSS -->
<link href="lib/css/bootstrap.min.css" rel="stylesheet">
<!--Behövs för att använda glyphicons -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<link href="include/style.css" rel="stylesheet">

<?php
	define( 'ROOT_DIR', dirname("pokemonkarlstad") );

	//Måste vara över session_start()
	include "classes/user.php";
	

	session_start();
	session_name("pokeSession");


	require "connect_db.php";
	include "functions.php";

?>

<!--jQuery-->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--Bootstrap-->
<script src="lib/js/bootstrap.min.js"></script>

<script src="scripts/java.js"></script>

<script src="ckeditor/ckeditor.js"></script>
