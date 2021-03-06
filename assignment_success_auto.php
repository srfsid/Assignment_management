<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered">
<?php
require 'core.php';
require 'connect.php';
$query = sprintf("SELECT MAX(Assignment_ID) FROM assignment");
$query_run = mysqli_query($link,$query);
if($query_run){
	$row = mysqli_fetch_array($query_run);
}

$tset = 1;
if(isset($_SESSION['auto_ans_set']) && $_SESSION['auto_ans_set'] != $_SESSION['assign_set']){
	echo nl2br("There is a problem with the format of your ans file.\nTry again.\n");
}
else{
	for(;$tset<=$_SESSION['assign_set'];$tset++){
		$query = sprintf("INSERT INTO assignment VALUES('','%d','%d','%s','%s','%b','%s','%b','%s','%s','%s','%d','%d','%d','%s','%s','%s')",
			mysqli_real_escape_string($link,$row[0]+1),
			mysqli_real_escape_string($link,$_SESSION['user_id']),
			mysqli_real_escape_string($link,$_SESSION['assign_name']),
			mysqli_real_escape_string($link,$_SESSION['assign_topic']),
			mysqli_real_escape_string($link,$_SESSION['Flink']),
			mysqli_real_escape_string($link,$_SESSION['assign_problem']),
			mysqli_real_escape_string($link,$_SESSION['Rlink']),
			mysqli_real_escape_string($link,$_SESSION['assign_resource'] ),
			mysqli_real_escape_string($link,$_SESSION['assign_starting_time']),
			mysqli_real_escape_string($link,$_SESSION['assign_ending_time']),
			mysqli_real_escape_string($link,$_SESSION['assign_set']),
			mysqli_real_escape_string($link,$tset),
			mysqli_real_escape_string($link,$_SESSION['assign_nVariable']),
			mysqli_real_escape_string($link,$_SESSION['assign_variable'.$tset]),
			mysqli_real_escape_string($link,$_SESSION['assign_ans'.$tset]),
			mysqli_real_escape_string($link,$_SESSION['assign_password']));

			$query_run = mysqli_query($link,$query);
			if(!$query_run){
				break;
			}
	}


	if($tset==$_SESSION['assign_set']+1){
		echo nl2br("Assignment created successfully\n\n\n");
		echo nl2br("<strong>Your Assignment ID : ".($row[0]+1)."</strong>\n");
		echo nl2br("<strong>And Password : ".$_SESSION['assign_password']."</strong>\n\n");
		echo '<a href="teacher_core.php">Main Menu</a><br>';
	}
	else{
		echo nl2br("Sorry, try again\n");
	}
}

?>
</div>
</body>
</html>
