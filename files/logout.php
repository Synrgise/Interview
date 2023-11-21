<?php
//delete all the cookies
setcookie("username",$username,time()-84600,"/");
setcookie("usercookie",$users["user_id"],time()-84600,"/");
setcookie("password",$password,time()-84600,"/");
$newURL="../login.html";
header('Location: '.$newURL);
?>