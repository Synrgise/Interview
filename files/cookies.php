<?php
//get cookies 
if(isset($_COOKIE["usercookie"]) && isset($_COOKIE["userremember"])){
		echo json_encode($_COOKIE["username"]);
				echo json_encode($_COOKIE["password"]);
}
?>