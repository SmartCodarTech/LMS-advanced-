<?php
	include 'includes/session.php';
	
	//$where = '';
	//if(isset($_GET['students'])){
		//$where = 'WHERE student_id = '.$stu_id;
	//}**/

	if(isset($_POST['submit'])){
		$title = $_POST['title'];
		$category_id = $_POST['category_id'];
	
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$link = $_POST['link'];
		$publish_date = $_POST['publish_date'];
	   
       $student_id = $_POST['student_id'];
	 
		
        
		
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
										move_uploaded_file($temp,"file/".$upload_file);
								
								
									

		$sql = "INSERT INTO article (title,category_id,student_id, author, publisher, publish_date,link,upload_file) VALUES ('$title','$category_id', '$student_id','$author', '$publisher', '$publish_date','$link','$upload_file')";
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