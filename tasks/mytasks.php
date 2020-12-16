<?php
//fetch all the tasks from database
	if(isset($_COOKIE["usercookie"]) && isset($_POST["marktask"])){
	 $checked= $_POST["marktask"];
			foreach($checked as $check){
				require_once("../db_connect/db_con.php");
				$query = "select * from tasks where user_id='".$_COOKIE["usercookie"]."' AND task_id='".$check."'";
				$statement = $conn->prepare($query);
				$statement->execute();
				$tasks = $statement->fetchAll();
				$statement->closeCursor();
			}
							
				foreach($tasks as $task){
					require_once("../db_connect/db_con.php");
					$query_update = "update tasks SET complete='T' where task_id='".$task["task_id"]."'";
					$statement_update = $conn->prepare($query_update);
					$success =$statement_update->execute();
					$statement_update->closeCursor();
				}
					if(count($success) == 0){
						echo "Something went wrong,Please try again";
						echo "<meta http-equiv=Refresh content=1;url=../index.php>";	
					}else if(count($success) == 1){
					$newURL="../index.php";
					header('Location: '.$newURL);	
					}
	}else{
	$newURL="../index.php";
     header('Location: '.$newURL);	
	}
?>