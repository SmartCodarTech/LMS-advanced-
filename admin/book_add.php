<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$pub_date = $_POST['pub_date'];
		$filename = $_FILES['photo']['name'];

		if(!empty($filename)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../img/'.$filename);
			
		}

		$sql = "INSERT INTO books (isbn, category_id, title, author, publisher, publish_date,photo) VALUES ('$isbn', '$category', '$title', '$author', '$publisher', '$pub_date','$filename')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: book.php');

?>