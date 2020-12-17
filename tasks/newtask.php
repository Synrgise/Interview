	<?php
	//insert new task into mySQL
if(isset($_COOKIE["usercookie"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["datepicker"])){
	$title = filter_input(INPUT_POST,'title');
	$description = filter_input(INPUT_POST,'description');
	$datepicker = filter_input(INPUT_POST,'datepicker');
	htmlspecialchars($title);
	htmlspecialchars($description);
	htmlspecialchars($datepicker);
	$newURL="../index.php";
	
		if(!preg_match("/[a-zA-Z0-9]{0,50}$/",$title)){
		
			 echo "<script>alert('Title incorrect please try a new one');window.location.href='../index.php'</script>";

		}elseif(!preg_match("/[a-zA-Z0-9]{0,200}$/",$description)){
						 echo "<script>alert('Only letter and words allowed');window.location.href='../index.php'</script>";

			
							echo "<meta http-equiv=Refresh content=1;url=../index.php>";
			}elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$datepicker)){
				
	                
							 echo "<script>alert('date format incorrect');window.location.href='../index.php'</script>";

				}else{
					require_once('../db_connect/db_con.php');
					$query="insert into tasks(title,body,complete,due_date,user_id,publish) values(:title,:description,'F',:datepicker,'".$_COOKIE["usercookie"]."','F')";
					$statement = $conn->prepare($query);

					$statement->bindValue(':title',$title);
					$statement->bindValue(':description',$description);
					$statement->bindValue(':datepicker',$datepicker);
					$success = $statement->execute();
					$statement->closeCursor();
						if(count($success) == 0){
						
								echo "<script>alert('Something went wrong,Please try again');window.location.href='../index.php'</script>";

								}else if(count($success) == 1){
									header('Location: '.$newURL);
	
						}
				}
}
							?>