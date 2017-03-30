<?php
function checkEmail($tmp) {
	if (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$tmp) != 1)
		return -1;
	else
		return $tmp;
}

function checkPsw($tmp) {
	if (strpos($tmp, ' ') === true || strlen($tmp) < 8) {
		return -1;
	}
	else {
		return $tmp;
	}
}

function checkPsw_hash($tmp) {
	if (strpos($tmp, ' ') === true || strlen($tmp) < 8)
		return -1;
	else
		return password_hash($tmp, PASSWORD_DEFAULT);
}

function checkName($tmp) {
	if (preg_match('/^[A-Za-z\s]+$/',$tmp) != 1)
		return -1;
	else
		return $tmp;
}

function checkGender($tmp) {
	if (strcmp($tmp, "Male") == 0)
		return 0;
	else if (strcmp($tmp, "Female") == 0)
		return 1;
	else if (strcmp($tmp, "Other") == 0)
		return 2;
	else
		return -1;
}
?>
