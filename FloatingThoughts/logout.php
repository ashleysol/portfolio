<?php
	session_start();
	session_destroy(); // deletes all session variables for this application
    header("Location: main.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout | Floating Thoughts</title>
</head>
<body>


</body>
</html>