<!--Page for coordinating all the different Ajax file requests-->

<?php
include "../include/classes/user.php";
include "../include/connect_db.php";
include "../include/functions.php";
include "../components/pages.php";


session_start();

//Variabel from java.js för att avgöra vad som ska göras.
$action = $_REQUEST['action'];

switch($action){

	//Create a forum topic
	case 'submitForumTopic':
		//Returns newly created topics id.
		//functions.php
		$topicId = submitForumTopic();

		//Changes page to the newly created topic.
		//pages.php
		changeForumTopicPagePhp($topicId);
	break;

	//Create a topic comment
	case 'submitForumComment':
		//Returns newly created topics id.
		//functions.php
		$topicId = submitForumComment();

		//Changes page to the newly created topic.
		//pages.php
		changeForumTopicPagePhp($topicId);
	break;

	//Changes the page from Ajax comamnds.	
	case 'changePage':
		//pages.php
		changePagePhp();
	break;

	case 'changeForumPage':
		//pages.php
		changeForumPagePhp();
	break;

	case 'changeForumPageTopic':
		//pages.php
		changeForumTopicPagePhp("none");
	break;

	case 'signin':
		//functions.php
		login();
	break;

	case 'signout':
		//functions.php
		signout();
	break;
	case 'updateUserdata':
		//functions.php
		updateUserdataPhp();
	break;
	
}