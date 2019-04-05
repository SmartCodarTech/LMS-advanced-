<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../upload/'.$filename);	
		}
		
		$sql = "UPDATE books SET photo = '$filename' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select Book to update photo first';
	}

	header('location: book.php');
?>