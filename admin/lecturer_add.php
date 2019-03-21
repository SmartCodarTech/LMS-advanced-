<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number'];
		$specialization = $_POST['specialization'];
		$department = $_POST['department'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating studentid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$lecturer_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO lecturer (lecturer_id, firstname, lastname, email, phone_number,specialization,department,  photo, created_on) VALUES ('$lecturer_id', '$firstname', '$lastname', '$email','$phone_number','$department','$specialization', '$filename', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Lectuerer added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: lecturer.php');
?>