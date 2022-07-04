<?php
	$conn = new mysqli("localhost","root","","bizim_ciftlik");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>