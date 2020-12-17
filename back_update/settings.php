
<?php
if(isset($_COOKIE["usercookie"])){
	require_once("../db_connect/db_con.php");
							$query_update = "update settings SET seen='T' where user_id='".$_COOKIE["usercookie"]."'";
							$statement_update = $conn->prepare($query_update);
							$success =$statement_update->execute();
							$statement_update->closeCursor();
							if(count($success) == 0){
echo "Something went wrong,Please try again";
echo "<meta http-equiv=Refresh content=1;url=../index.php>";
	
}else if(count($success) == 1){
	require_once("../db_connect/db_con.php");
$query_messages = "select * from messages where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_messages = $conn->prepare($query_messages);
							$statement_messages->execute();
							$tasks_messages = $statement_messages->fetchAll();
							$statement_messages->closeCursor();
							
							$query_updates = "select * from updates where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_updates = $conn->prepare($query_updates);
							$statement_updates->execute();
							$tasks_updates = $statement_updates->fetchAll();
							$statement_updates->closeCursor();
							
							$query_settings = "select * from settings where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_settings = $conn->prepare($query_settings);
							$statement_settings->execute();
							$tasks_settings = $statement_settings->fetchAll();
							$statement_settings->closeCursor();
							
echo (count($tasks_messages)+count($tasks_updates)+count($tasks_settings));							
}
}
?>
