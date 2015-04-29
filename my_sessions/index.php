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

// ____________________________________________________________________

include "view.php";
exit;