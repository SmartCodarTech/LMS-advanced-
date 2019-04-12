<?php
	include 'includes/session.php';


	if(isset($_POST['submit'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$pub_date = $_POST['pub_date'];

       
                                $image = $_FILES["image"] ["name"];
								$type = $_FILES["image"] ["type"];
								$size = $_FILES["image"] ["size"];
								$temp = $_FILES["image"] ["tmp_name"];
								$error = $_FILES["image"] ["error"];
										
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
										move_uploaded_file($temp,"../images/".$image);
								
								
									

		$sql = "INSERT INTO books (isbn, category_id, title, author, publisher, publish_date,image) VALUES ('$isbn', '$category', '$title', '$author', '$publisher', '$pub_date','$image')";
	}}

		if($conn->query($sql)){  
			
			$_SESSION['success'] = 'Book added successfully';
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


	header('location: book.php');

?>