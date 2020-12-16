<?php
//json_encode password and username cookie values
if(isset($_COOKIE["password"])){
	
echo json_encode($_COOKIE["password"]);
echo json_encode($_COOKIE["username"]);
}

?>