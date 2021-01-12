<?php
	$conn = new mysqli("127.0.0.1", "root", "toor", "precipitacion", 3306);
	if (!$conn){
		die("Something went wrong ".mysqli_connect_error());
	}
