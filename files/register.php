<?php
if(isset($_POST["username"]) && !empty($_POST["password"])){
//sanitize input
$username = filter_input(INPUT_POST,'username');
$password = filter_input(INPUT_POST,'password');
htmlspecialchars($username);
htmlspecialchars($password);
    //match username and password requirements
	if(!preg_match("/[a-zA-Z0-9]{0,50}$/",$username)){
	echo "Your user name can only consist of letters or numbers or both";
								echo "<meta http-equiv=Refresh content=1;url=../register.html>";
		}elseif(!preg_match("/[a-zA-Z0-9,*]{7,20}$/",$password)){
                      echo "password is too short";
								echo "<meta http-equiv=Refresh content=1;url=../register.html>";			
				}else{
					//connect and insert data using PDO
					require_once('../db_connect/db_con.php');
					$query="insert into users(username,password) values(AES_ENCRYPT(:username,'".$encrypt_key."'),AES_ENCRYPT(:password,'".$encrypt_key."'))";
						$statement = $conn->prepare($query);

						$statement->bindValue(':username',$username);
						$statement->bindValue(':password',$password);
						$success = $statement->execute();
						$statement->closeCursor();
						
						
						 
							
							if(count($success) == 0){
								echo "Something went wrong,Please try again";
								echo "<meta http-equiv=Refresh content=1;url=../register.html>";	
							}else if(count($success) == 1){
								require_once('../db_connect/db_con.php');
								 $query_user = "select * from users where AES_DECRYPT(username,'$encrypt_key')='".$username."' && AES_DECRYPT(password,'$encrypt_key')='".$password."'";
		                         $statement = $conn->prepare($query_user);
						         $statement->execute();
						         $user = $statement->fetchAll();
							    $statement->closeCursor();
								
								
								foreach($user as $users):
								$query_messages = "insert into messages(user_id,message,seen) values('".$users["user_id"]."','Welcome,Thank you for signup start managing your tasks today','F')";
		                         $statement_messages = $conn->prepare($query_messages);
						         $statement_messages->execute();
							    $statement_messages->closeCursor();
								
								$query_updates = "insert into updates(user_id,updates,seen) values('".$users["user_id"]."','We have added a new unpublish feature which you are sure to enjoy','F')";
		                         $statement_updates = $conn->prepare($query_updates);
						         $statement_updates->execute();
							    $statement_updates->closeCursor();
								
								$query_settings = "insert into settings(user_id,settings,seen) values('".$users["user_id"]."','You are now able to update your profile within the settings tab','F')";
		                         $statement_settings = $conn->prepare($query_settings);
						         $statement_settings->execute();
							    $statement_settings->closeCursor();
								
								setcookie("username",$username,time()+84600,"/");
								setcookie("usercookie",$users["user_id"],time()+84600,"/");
								setcookie("password",$password,time()+84600,"/");
									if(isset($_POST["checkbox-signup"])){
		
					setcookie("userremember","remember me",time()+84600,"/");	
				}
										$newURL="../index.php";
										header('Location: '.$newURL);
									
								endforeach;	
							}
					}
}
?>