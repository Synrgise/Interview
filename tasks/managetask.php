<?php
//unpublish tasks
if(isset($_COOKIE["usercookie"]) && isset($_POST["Unpublish"])){
	$unpublish= $_POST["Unpublish"];
	require_once("../db_connect/db_con.php");
							$query_update = "update tasks SET publish='T' where task_id='".$unpublish."'";
							$statement_update = $conn->prepare($query_update);
							$success =$statement_update->execute();
							$statement_update->closeCursor();
														if(count($success) == 0){
echo "Something went wrong,Please try again";
echo "<meta http-equiv=Refresh content=1;url=../index.php>";	
}else if(count($success) == 1){
$newURL="../index.php";
header('Location: '.$newURL);	
}
}
?>