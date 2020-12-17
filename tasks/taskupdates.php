<?php
//decode json_encoded data that contains email 
$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);
	$ID = $obj['email'];
if(isset($ID)){
	require_once("../db_connect/db_con.php");
							$query = "select * from tasks where task_id='".$ID."'";
							$statement = $conn->prepare($query);
							$statement->execute();
							$tasks = $statement->fetchAll();
							$statement->closeCursor();
							echo json_encode($tasks);
							
}else{
echo "<script>alert('Something went wrong,Please try again');window.location.href='../index.php'</script>";
	
}

?>
