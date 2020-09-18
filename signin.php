<?php
	
if(isset($_POST['submit'])){ //check if form was submitted
    
	ob_start(); // ensures anything dumped out will be caught
	
	$username = $_POST["email"];
	$pass = $_POST["pass"];
	

	if( !( $database = mysql_connect("localhost", "elhussin_hussin", "Azeem123")))
		die("could not connect to database</body></html>");

	if( !(mysql_select_db("elhussin_Project", $database)))
		die("could not open elhussin_Project Database</body></html>");

	$result = mysql_query("select * from Users where username = '$username' AND password = '$pass' ")
		or die("failed to query database. ".mysql_error());


	$row = mysql_fetch_array($result);
	$id = $row['uid'];
	 // this can be set based on whatever
	if($row['username'] == $username && $row['password'] == $pass){
		if ($row['role'] == "admin") {
			$succ = "http://webdev.cs.ku.edu.kw/~elhussiny/trial2/project1/ADMIN/adhome.php?id=$id";
		}else if ($row['role'] == "Doctor") {
			$succ = "http://webdev.cs.ku.edu.kw/~elhussiny/trial2/project1/DOCTOR/DrHome.php?id=$id";
		}else{
			$succ = "http://webdev.cs.ku.edu.kw/~elhussiny/trial2/project1/PATIENT/pathome.php?id=$id";
		}
		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}
		// no redirect
		header( "Location: $succ" );
	}
	else{
		alert("please try again");
	}

}

function alert($msg) {
    	echo "<script type='text/javascript'>alert('$msg');</script>";
	}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="signin.css">
    <title>logIn</title>
</head>
<body>

<form onsubmit="return checkemail(this)" class="box" action="" method="post">
    <h1>LogIn</h1>
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="pass" id="psw" placeholder="Password">
    <input type="submit" name="submit" value="Login">
    <a href="Home.php"><input type="button" name="submit" value="Back to Home page"></a>

</form>

<div id="message">
    <h3>Password must contain the following:</h3>
    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
    <p id="number" class="invalid">A <b>number</b></p>
    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

<script src="signin.js"></script>

</body>
</html>
