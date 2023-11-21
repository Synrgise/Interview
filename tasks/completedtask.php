<?php
// delete individual and delete all functionality
if(isset($_COOKIE["usercookie"]) && isset($_POST["Delete"])){
$delete_id= $_POST["Delete"];
	require_once("../db_connect/db_con.php");
							$query_delete = "delete from tasks where task_id='".$delete_id."'";
							$statement_delete = $conn->prepare($query_delete);
							$success =$statement_delete->execute();
							$statement_delete->closeCursor();
														if(count($success) == 0){

 echo "<script>alert('Something went wrong please try again later');window.location.href='../index.php'</script>";
	
}else if(count($success) == 1){
$newURL="../index.php";
header('Location: '.$newURL);	
}
}
if(isset($_COOKIE["usercookie"]) && isset($_POST["deleteAll"])){
	require_once("../db_connect/db_con.php");
							$query_delete = "delete from tasks where complete='T'";
							$statement_delete = $conn->prepare($query_delete);
							$success =$statement_delete->execute();
							$statement_delete->closeCursor();
														if(count($success) == 0){
 echo "<script>alert('Something went wrong please try again later');window.location.href='../index.php'</script>";
	
}else if(count($success) == 1){
$newURL="../index.php";
header('Location: '.$newURL);	
}	
}
?>