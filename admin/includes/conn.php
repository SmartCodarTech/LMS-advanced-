<?php
	$conn = new mysqli('localhost', 'root', '', 'LMS');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>