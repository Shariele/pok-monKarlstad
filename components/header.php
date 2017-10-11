<!--Contains the top menus outlook and buttons. -->

<body>
	<div class="container">
		<div class="header-nav">
		    <nav class="navbar navbar-default" role="navigation">
		  		<div class="container-fluid">
			        <!-- Brand and toggle get grouped for better mobile display -->
			        <div class="navbar-header">
                <a class="navbar-brand" style="cursor: pointer;" id="indexPage"><img src="img/pokemonkarlstad.png" alt="Pokemon Karlstad"></a>
                <div id="socialdiv">
                  <a href="https://twitter.com/PokemonKarlstad" target="_blank" style="cursor: pointer;" id="facebook"></a>
                  <a href="https://twitter.com/PokemonKarlstad" target="_blank" style="cursor: pointer;" id="twitter"></a>
                  <a href="https://www.instagram.com/pokemonkarlstad" target="_blank" style="cursor: pointer;" id="instagram"></a>
                  <a href="https://twitter.com/PokemonKarlstad" target="_blank" style="cursor: pointer;" id="reddit"></a>
                </div>
			  		</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse in navbar-collapse" id="bs-example-navbar-collapse-1">
		          <!-- Google login + meny -->
              <div class="logintop">
              <ul class="nav navbar-nav">
                  <li><a id="login-button" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></a></li>
                  <li><a id="accountSettings" style="cursor: pointer; display: none;">My account</a></li>
                  <li><a style="cursor: pointer; display: none;" id="signoutButton" onclick="signOut();">Sign out</a></li>
              </ul>
              </div>
              <!-- knappar vänster --> 
              <ul class="nav navbar-nav navbuttons">
                <li><a style="cursor: pointer;" id="news">News</a></li>
	              <li><a style="cursor: pointer;" id="pokeForum">Forum</a></li>
	            </ul>

							<!-- knappar höger -->
              <ul class="nav navbar-nav navbar-right navbuttons">
                <li><a style="cursor: pointer;" id="pokeForum">Forum</a></li>
                <li><a style="cursor: pointer;" id="news">News</a></li>
              </ul>
	         </div><!-- /.navbar-collapse -->
		    	</div><!-- /.container-fluid -->
		  	</nav>
		</div>
	</div><!--Container-->
</body>

<script>
$(document).ready(function(){

	//Header
	$(document).off('click', '#indexPageContainer').on('click', '#loginButton', function(e) {

    	window.location.reload();

    	console.log("worked");

    });

    $(document).off('click', '#indexPageContainer').on('click', '#indexPage', function(e) {
    	e.preventDefault();

    	changePageJs($(this).attr('id'));

    });

    $(document).off('click', '#indexPageContainer').on('click', '#register', function(e) {
    	e.preventDefault();

    	changePageJs($(this).attr('id'));

    });

    $(document).off('click', '#indexPageContainer').on('click', '#news', function(e) {
    	e.preventDefault();

    	changePageJs($(this).attr('id'));

    });

    $(document).off('click', '#indexPageContainer').on('click', '#pokeForum', function(e) {
    	e.preventDefault();

    	changePageJs($(this).attr('id'));

    });
    $(document).off('click', '#accountSettings').on('click', '#accountSettings', function(e) {
      e.preventDefault();

      changePageJs($(this).attr('id'));

    });
});	

	  function signOut() {
	    var auth2 = gapi.auth2.getAuthInstance();
	    auth2.signOut().then(function () {
	        console.log('User signed out.');
	    });
	    signoutJs();
	    window.location.reload();
	  }
	  function disassociate() {
	    var auth2 = gapi.auth2.getAuthInstance();
	    auth2.disconnect().then(function () {
	        console.log('User disconnected from association with app.');
	        window.location.reload();
	    });
	}
	
    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();

        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);

        var fullName = profile.getName();
        var profilePic = profile.getImageUrl();
        var email = profile.getEmail();

    	fullName = profile.getName();
    	profilePic = profile.getImageUrl();
    	email = profile.getEmail();

    	loginJs(fullName, profilePic, email);
      
      // visa account knappar
      document.getElementById('accountSettings').style.display = "inline";
      document.getElementById('signoutButton').style.display = "inline";

      //reloading indexpage för att create topic knappen ska visas
      changePageJs("indexPage");
      
        // 
    }

      function refresh(){
      	window.location.reload();
      }

</script>