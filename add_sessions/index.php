<?php
date_default_timezone_set("America/Los_Angeles");

// if(!$_SESSION){
//     session_start();
//  }
 // if (!$_SESSION['is_logged_in'] == 1){
 //         // not logged in move to login page
 //         header('Location: /coupons/adminLogin.php');
 //         exit;
 //     }

require $_SERVER['DOCUMENT_ROOT'].'/add_sessions/model.php';

//Function returns array by a SimpleXmlObject
function object2array($object){
    $return = NULL;
      
    if(is_array($object))
    {
        foreach($object as $key => $value)
            $return[$key] = object2array($value);
    }
    else
    {
        $var = get_object_vars($object);
          
        if($var)
        {
            foreach($var as $key => $value)
                $return[$key] = ($key && !$value) ? NULL : object2array($value);
        }
        else return $object;
    }

    return $return;
}


// ____________________________________________________________________

if ($_GET['singleSession']){
	$id = $_GET['singleSession'];

	$talkList = file_get_contents("http://tech.lds.org/mc/api/conference/talklist?SessionID=". $id);

	$talks = object2array(json_decode($talkList));

	$output = "";
		foreach ($talks['Talks'] as $value){
	        $output .= "<span class='conferenceLink'>" . $value['Title'] . "</span><br>";
	    }

	$output2 = "<button class='btn btn-primary' href=''>Add to My Sessions</button>";

	include "view.php";
	exit;
}
if ($_GET['requestSessions']){
	$id = $_GET['requestSessions'];

	$sessionList = file_get_contents("http://tech.lds.org/mc/api/conference/sessionlist?ConferenceID=" . $id);

	$sessions = object2array(json_decode($sessionList));

	$output = "";
		foreach ($sessions['Sessions'] as $value){
	        $output .= "<a class='conferenceLink' href='index.php/?singleSession=" . $value['ID'] . "'>" . $value['Title'] . "</a><br>";
	    }

    $output2 = "<button class='btn btn-primary' href=''>Add Conference to My Sessions</button>";

	include "view.php";
	exit;
}
else {
	$conferenceList = file_get_contents("http://tech.lds.org/mc/api/conference/list?LanguageID=1");

	$conferences = object2array(json_decode($conferenceList));

	$output = "";
		foreach ($conferences['Conferences'] as $value){
	        $output .= "<a class='conferenceLink' href='index.php/?requestSessions=" . $value['ID'] . "'>" . $value['Title'] . "</a><br>";
	    }

	include "view.php";
	exit;
}