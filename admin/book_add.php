<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$pub_date = $_POST['pub_date'];


        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
       if( in_array($imageFileType,$extensions_arr) ){
 
    // Convert to base64 
       $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
       $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    // Insert record
  
  
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  }

		$sql = "INSERT INTO books (isbn, category_id, title, author, publisher, publish_date,image) VALUES ('$isbn', '$category', '$title', '$author', '$publisher', '$pub_date','$image')";
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