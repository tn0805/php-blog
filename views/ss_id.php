<?php


if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout']) > 300) {
	session_unset();
    session_destroy();
    session_start();
}else{
	session_start();
}
$_SESSION['timeout'] = time();

?>