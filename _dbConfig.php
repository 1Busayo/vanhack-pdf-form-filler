<?php
	// Connection variables
	$host = "us-cdbr-iron-east-05.cleardb.net"; 
	$username = "b7a42e4d404f00"; 
	$password = "47c28c0d"; 
	$db_name = "heroku_7e811b01741de43"; 
	
	// Connect to server and select database.
	$connection = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
	mysqli_select_db($connection,"$db_name")or die("cannot select DB");


#############################################################################
#
#	Function name: cleanText
#
#	Purpose: Clean user submitted data for insertion into the database. Works regardless of magic_quotes.
#
#	Incoming parameters: 
#		$string - $_GET or $_POST string to be cleaned
#		$allowedTags - Choose which HTML tags you want to allow in this format: <a>, <b>, <strong>, <i>, etc.
#
#	Returns: Cleaned data ready to be inserted
#
#############################################################################
	
	function cleanText($connection,$string, $allowedTags = "") {
		$string = strip_tags($string, $allowedTags);
	
		if(get_magic_quotes_gpc()) {
            return mysqli_real_escape_string($connection,stripslashes($string));
        } else {
            return mysqli_real_escape_string($connection,$string);
        }
		
	}
?>