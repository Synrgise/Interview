<?php
//update user details in settings page
if(isset($_COOKIE["password"]) && isset($_COOKIE["username"])){
	require_once("../db_connect/db_con.php");
	echo $_POST['usernamesettings'];
			$query_update = "update users SET username=AES_ENCRYPT('".$_POST['usernamesettings']."','".$encrypt_key."'), password=AES_ENCRYPT('".$_POST['passsettings']."','".$encrypt_key."') where user_id='".$_COOKIE["usercookie"]."'";
			$statement_update = $conn->prepare($query_update);
			$success =$statement_update->execute();
			$statement_update->closeCursor();
			
					if(count($success) == 0){

 echo "<script>alert('Something went wrong please try again later');window.location.href='../index.php'</script>";
	
	}else if(count($success) == 1){
			$newURL="../index.php";
			header('Location: '.$newURL);	
}
}
?>

