<?php
if(isset($_POST["username"]) && !empty($_POST["password"])){
		$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
		htmlspecialchars($username);
		htmlspecialchars($password);
		strip_tags($username);
		strip_tags($password);
		require_once('../db_connect/db_con.php');
		$query_user = "select * from users where AES_DECRYPT(username,'$encrypt_key')='".$username."' && AES_DECRYPT(password,'$encrypt_key')='".$password."'";
		$statement = $conn->prepare($query_user);
		$statement->execute();
		$user = $statement->fetchAll();
		$statement->closeCursor();

				if(count($user) == 0){
				
					echo "<script>alert('username or password are incorect,Please try again');window.location.href='../login.html'</script>";
                
				}else if(count($user) == 1){
	
					foreach($user as $users):
	
						setcookie("usercookie",$users["user_id"],time()+84600,"/");
						setcookie("username",$username,time()+84600,"/");
						setcookie("password",$password,time()+84600,"/");
			if(isset($_POST["remember"])){
		
					setcookie("userremember","remember me",time()+84600,"/");	
				}
							$newURL="../index.php";
							header('Location: '.$newURL);
								endforeach;
		}
	}
?>