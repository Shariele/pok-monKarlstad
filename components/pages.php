<?php

function changePagePhp(){
	$pageChoice = $_REQUEST['c'];

	switch ($pageChoice) {
		//Main pages
		case 'indexPage':
			include "main.php";
			include "footer.php";
		break;

		case 'news':
			include "news.php";
			include "footer.php";
		break;

		case 'pokeForum':
			include "forumIndex.php";
			include "footer.php";
		break;

		case 'accountSettings':
			include "accountSettings.php";
			include "footer.php";
		break;

		default:
			# code...
			break;
	}
}

function changeForumPagePhp(){
	$categoryChoice = $_REQUEST['categoryId'];

	switch ($categoryChoice) {
		//Forum pages
		case '1': //General
			include "forumTopicsPage.php";
			include "footer.php";
		break;

		case '2': //Pokemon
			include "forumTopicsPage.php";
			include "footer.php";
		break;

		case '3': //News
			include "forumTopicsPage.php";
			include "footer.php";
		break;
		case '4': //valor
			include "forumTopicsPage.php";
			include "footer.php";
		break;
		case '5': //mystic
			include "forumTopicsPage.php";
			include "footer.php";
		break;
		case '6': //instinct
			include "forumTopicsPage.php";
			include "footer.php";
		break;

		case 'createForumTopic':
			include "createForumTopic.php";
			include "footer.php";
		break;

		default:
			# code...
			break;
	}
}

function changeForumTopicPagePhp($variable){
	$variableForTopicId = $variable;

	if($variable == "none"){
		//If not a newly created topic.
		include "forumTopicDetailed.php";
		include "footer.php";
	}else{
		//Newly created topic.
		include "forumTopicDetailed.php";
		include "footer.php";
	}
}

?>