<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$pub_date = $_POST['pub_date'];



       	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;
 
	//mysqli_query($con,"insert into image_tb (img_location) values ('$location')");

		/**$filename = $_FILES['photo']['name'];

		if(!empty($filename)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
			
		}**/

		$sql = "INSERT INTO books (isbn, category_id, title, author, publisher, publish_date,location) VALUES ('$isbn', '$category', '$title', '$author', '$publisher', '$pub_date','$location')";
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