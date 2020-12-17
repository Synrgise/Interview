<?php 
//recover password
$username = filter_input(INPUT_POST,'username');
$email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email) && isset($_POST["username"]))
{
htmlspecialchars($username);
htmlspecialchars($email);
strip_tags($username);
strip_tags($email);
require_once('../db_connect/db_con.php');
$query_user = "select * from users where AES_DECRYPT(username,'$encrypt_key')='".$username."'";
$statement = $conn->prepare($query_user);
$statement->execute();
$user = $statement->fetchAll();
$statement->closeCursor();
if(count($user) == 0){
echo "You are not signed up.";
 echo "<meta http-equiv=Refresh content=1;url=../register.html>";	
}else{
                $adminEmail ="svellem51@gmail.com";
                $headers ="From: $adminEmail\n";  
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
                $subject ="Password Recovery";

                $body='';
                 foreach($user as $users):
                $body.=" <p>Your password is ".$users["password"].",thank you for email remember to keep your data safe.</p>";
			 endforeach;
if(mail($email,$subject,$body,$headers)) {
	
 echo "Your  Login password has been emailed to you.";
 echo "<meta http-equiv=Refresh content=1;url=../recover_password.html>";
} 
else {	
 echo "<script>alert('Something went wrong please try again later');</script>";
 echo "<meta http-equiv=Refresh content=1;url=../recover_password.html>";
}
}
}elseif(!preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email)){
echo "Email format incorrect ";
echo "<meta http-equiv=Refresh content=1;url=../recover_password.html>";	
}
?>