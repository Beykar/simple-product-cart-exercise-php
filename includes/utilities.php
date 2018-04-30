<?php


//=========== DEFINING CONSTANTS:
define('ROOT',
    'http://localhost:8080/recruitment-task-jr-dev/');

define("USR", "root");
define("PSW", ""); // default: root
define("HST", "localhost");
define("DBN", "recruitment_task_db");

//===========  DATABASE LOGIC:

// creating a MYSQLI object
$mysqli = new mysqli(HST, USR, PSW, DBN);

//print_r($mysqli);

if($mysqli->connect_error){
    // die("=====ERROR======" . $mysqli->connect_error);
    echo "there is an error!";
}

/**
 *	@name   trace
 *	@desc   this foo will display the content of arrays/superglobals
 *	            in a nice and readable fashion
 *  @param   object	$obj		the object to print
 */

function trace($obj){
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}//end trace
