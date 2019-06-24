<?php
	include 'includes/session.php';

	if(isset($_POST['login'])){
		$student = $_POST['student'];
		$password =$_POST['password'];
		$sql = "SELECT * FROM students WHERE student_id = '$student'";
		$query = $conn->query($sql);
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$_SESSION['student'] = $row['id'];
			header('location: transaction.php');
		}
		
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['student'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		

	}
	else{
		$_SESSION['error'] = 'Enter student id first';
		header('location: index.php');
	}


?>