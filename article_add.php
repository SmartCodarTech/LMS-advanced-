<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$title = $_POST['title'];
		$category_id = $_POST['category_id'];
		$student_id = $_POST['student_id'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$publish_date = $_POST['publish_date'];
	
        $sql = "SELECT * FROM students WHERE student_id = '$student'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			if(!isset($_SESSION['error'])){
				$_SESSION['error'] = array();
			}
			$_SESSION['error'][] = 'Student not found';
		}
                       
	



		                        $upload_file = $_FILES["upload_file"] ["name"];
								$type = $_FILES["upload_file"] ["type"];
								$size = $_FILES["upload_file"] ["size"];
								$temp = $_FILES["upload_file"] ["tmp_name"];
								$error = $_FILES["upload_file"] ["error"];
										
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
										move_uploaded_file($temp,"file/".$file);
								
								
									

		$sql = "INSERT INTO article (title,category_id,student_id, author, publisher, publish_date,upload_file) VALUES ('$title','$category_id', '$student_id','$author', '$publisher', '$pub_date','$upload_file')";
	}}

		if($conn->query($sql)){  
			
			$_SESSION['success'] = 'Article added successfully';
		}
		else
		{
			$_SESSION['error'] = $conn->error;
		}
	}
		
	else
	{

		$_SESSION['error'] = 'Fill up add form first';
	}


	header('location: article.php');


		

?>