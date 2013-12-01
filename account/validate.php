<?php
/*
 * 2011 Nov 1
 * CSCC40 - Tutorial Scheduling System
 *
 * This is a utility class in order to validate multiple fields
 *
 * @author Kobe Sun
 *
 */

function checkEmail($email) {
	// checks for proper syntax
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkUsername($username) {
	// checks for proper syntax
	return preg_match("/^[a-z\d_]{5,20}$/i", $username);
}

function checkName($name) {
	// checks for proper syntax
	return ($name == "") || preg_match("/^[a-zA-z]+([ '-][a-zA-Z]+)*$/", $name);
}

function checkTel($tel) {
	// checks for proper syntax
	return ($tel == "") || preg_match("/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x", $tel);
}

function checkPic($pic) {
	// checks for proper file type
	return (trim($pic["name"] == "")) || ((($pic["type"] == "image/gif")
		|| ($pic["type"] == "image/jpeg")
		|| ($pic["type"] == "image/png"))
		&& ($pic["size"] < 2048000));
}

function checksid($sid){
	return preg_match("/[0-9]{9}$/", $sid);
}
function checkForm() {
	$errMsg = "";
	
	if($_POST["sid"] == 000000000){
		$errMsg .= "The student number is required. <br />";
	}
	if ($_POST["sid"] != 000000000 && !checksid(trim($_POST["sid"]))) {
		$errMsg .= "The student number you entered was invalid. <br />";
		
	} elseif ($_POST["sid"] != 000000000) {
		$user = User::searchBy(array("sid" => trim($_POST["sid"])));
		if ($user) {
			if (is_null(retrieveUser()) || (retrieveUser()->getUid() != $user->getUid())) {
				$errMsg .= "The student number you entered already exists. <br />";
			}
		}
	}

	if (!empty($_POST["surname"]) && !checkName(trim($_POST["surname"]))) {
		$errMsg .= "The surname you entered was invalid. <br />";
	}
	
	if(empty($_POST["surname"])){
		$errMsg .= "The surname is required. <br />";
	}
	if (!empty($_POST["given"]) && !checkName(trim($_POST["given"]))) {
		$errMsg .= "The given name you entered was invalid. <br />";
	}
	

	if(empty($_POST["given"])){
		$errMsg .= "The given name is required. <br />";
	}
	if (!empty($_POST["middle"]) && !checkName(trim($_POST["middle"]))) {
		$errMsg .= "The middle name you entered was invalid. <br />";
	}
	if(empty($_POST["middle"])){
		$errMsg .= "The middle name is required. <br />";
	}

	

	if ( isset($_POST["pwd"]) &&  trim($_POST["pwd"]) == "" ) {
		$errMsg .= "The password you entered was invalid. <br />";
	
	} elseif ( isset($_POST["pwd"]) && ( trim($_POST["pwd"]) != trim($_POST["r_pwd"]) ) ) {
		$errMsg .= "The passwords you entered do not match. <br />";
	}
	if (isset($_POST["email"]) && !checkEmail(trim($_POST["email"]))) {
		$errMsg .= "The email you entered was invalid. <br />";
	} elseif (isset($_POST["v_email"]) && !checkEmail(trim($_POST["v_email"]))){
		$errMsg .= "The email you retyped was invalid. <br />";
	} elseif (isset($_POST["v_email"])&& isset($_POST["email"]) && ( trim($_POST["email"]) != trim($_POST["v_email"]) )){
		$errMsg .= "The emails you entered don't match. <br />";
	} elseif (isset($_POST["email"])) {
		
		$user = User::searchBy(array("email" => trim($_POST["email"])));
		
		if ($user) {
			if (is_null(retrieveUser()) || (retrieveUser()->getUid() != $user->getUid())) {
				$errMsg .= "The email you entered already exists. <br />";
			}
		}
	}
	if (isset($_POST["tel"]) && !checkTel(trim($_POST["tel"]))) {
		$errMsg .= "The telephone number you entered was invalid. <br />";
	}

	if (isset($_FILES["pic"]) && !checkPic($_FILES["pic"])) {
		$errMsg .= "The image you uploaded was invalid. <br />";
	}

	return $errMsg;
}

?>