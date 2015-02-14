<?php
//SERVICES

function callPayutc(){
	

	
}

function checkLoginCAS(){
	header("Location: https://cas.utc.fr/cas/login?service=http://".$_SERVER['HTTP_HOST']."/picasso/templates/pages/index.php");
}
?>
