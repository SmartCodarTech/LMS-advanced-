<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$course_code = $_POST['course_code'];
		$program = $_POST['program'];
		
		$sql = "INSERT INTO specialization (course_code, program) VALUES ('$program', '$course_code')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Program added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: specialization.php');

?>