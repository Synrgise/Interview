	<?php
	if(isset($_COOKIE["usercookie"])){
							require_once("../db_connect/db_con.php");
							$query_complete = "select *,DATE_FORMAT(due_date,'%d') As niceday,DATE_FORMAT(due_date,'%m') As nicemonth from tasks where user_id='".$_COOKIE["usercookie"]."' AND complete='T' AND publish='F'";
							$statement_complete = $conn->prepare($query_complete);
							$statement_complete->execute();
							$tasks_complete = $statement_complete->fetchAll();
							$statement_complete->closeCursor();
							
$output = fopen("php://output",'w') or die("Can't open php://output");
header("Content-Type:application/pdf"); 
header("Content-Disposition:attachment;filename=pressurecsv.pdf"); 
foreach($tasks_complete as $task){
fputcsv($output, $task);
}
fclose($output) or die("Can't close php://output");
	}
							?>