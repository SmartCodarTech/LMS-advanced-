<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender =$_POST['gender'];
		$course = $_POST['course'];
		$role = $_POST['role'];

		
                                $photo = $_FILES["photo"] ["name"];
								$type = $_FILES["photo"] ["type"];
								$size = $_FILES["photo"] ["size"];
								$temp = $_FILES["photo"] ["tmp_name"];
								$error = $_FILES["photo"] ["error"];
										
								if ($error > 0){
									die("Error uploading file! Code $error.");
								}
								else
								{
									if($size > 30000000000) //conditions for the file
									{
										die("Format is not allowed or file size is too big!");
									}
									else
									{
										move_uploaded_file($temp,"../upload/".$photo);
								
		//creating studentid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$student_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO students (student_id, firstname, lastname,gender, course_id, role, photo, created_on) VALUES ('$student_id', '$firstname', '$lastname','$gender', '$course','$role', '$photo', NOW())";

	}}
		if($conn->query($sql)){
			$_SESSION['success'] = 'User added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: student.php');
?>