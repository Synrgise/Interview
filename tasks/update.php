
<?php
if(isset($_POST["idM"])){
	require_once("../db_connect/db_con.php");
							$query_update = "update tasks SET title='".$_POST['titleM']."',body='".$_POST['descriptionM']."',due_date='".$_POST['dateM']."' where task_id='".$_POST["idM"]."'";
							$statement_update = $conn->prepare($query_update);
							$success =$statement_update->execute();
							$statement_update->closeCursor();
							if(count($success) == 0){
	
echo "<script>alert('Something went wrong,Please try again');window.location.href='../index.php'</script>";

}else if(count($success) == 1){
$newURL="../index.php";
header('Location: '.$newURL);	
}
}
?>
