<?php
//json encode password
if(isset($_COOKIE["password"])){
echo json_encode($_COOKIE["password"]);
}

?>