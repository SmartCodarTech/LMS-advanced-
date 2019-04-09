<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$title = $_POST['title'];
		$category = $_POST['category'];
		$student_id = $_POST['student_id'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$publish_date = $_POST['publish_date'];
		$status = $_POST['status'];
		$filename = $_FILES['image']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);	
		}



		
		$sql = "SELECT * FROM students WHERE student_id = '$student'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			if(!isset($_SESSION['error'])){
				$_SESSION['error'] = array();
			}
			$_SESSION['error'][] = 'Student not found';
		}
		else{
			$row = $query->fetch_assoc();
			$student_id = $row['id'];

			$added = 0;
			foreach($_POST['isbn'] as $isbn){
				if(!empty($isbn)){
					$sql = "SELECT * FROM books WHERE isbn = '$isbn' AND status != 1";
					$query = $conn->query($sql);
					if($query->num_rows > 0){
						$brow = $query->fetch_assoc();
						$bid = $brow['id'];

						$sql = " INSERT INTO `article`(`category_id`, `student_id`, `title`, `author`, `publisher`, `publish_date`, `status`, `image`) VALUES ('$category_id', '$student_id','$title', '$author','$publisher','$publish_date','$image')";
						if($conn->query($sql)){
							$added++;
							$sql = "UPDATE article SET status = 1 WHERE id = '$bid'";
							$conn->query($sql);
						}
						else{
							if(!isset($_SESSION['error'])){
								$_SESSION['error'] = array();
							}
							$_SESSION['error'][] = $conn->error;
						}

					}
					else{
						if(!isset($_SESSION['error'])){
							$_SESSION['error'] = array();
						}
						$_SESSION['error'][] = 'Article with Title - '.$title.' unapproved';
					}
		
				}
			}

			if($added > 0){
				$book = ($added == 1) ? 'Book' : 'Books';
				$_SESSION['success'] = $added.' '.$book.' successfully borrowed';
			}

		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: article.php');

?>