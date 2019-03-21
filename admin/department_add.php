<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$department_number= $_POST['department_number'];
		
		$sql = "INSERT INTO department (name, department_number) VALUES ('$name', '$department_number')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: department.php');

?>