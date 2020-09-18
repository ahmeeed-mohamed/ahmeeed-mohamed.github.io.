<?php
    
if(isset($_POST['submit'])){ //check if form was submitted 

    ob_start(); // ensures anything dumped out will be caught

    if( !( $database = mysql_connect("localhost", "elhussin_hussin", "Azeem123")))
        die("could not connect to database</body></html>");

    if( !(mysql_select_db("elhussin_Project", $database)))
        die("could not open elhussin_Project Database</body></html>");
    
    $patient = "SELECT pid, email FROM Patients"; 

    $email = $_POST["email"];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $pass = $_POST['psw'];
    $pid = rand ( 20000 , 29999 );


    if(!( $prow = mysql_query($patient, $database))){
        print("<p>could not retrieve Patients.</p>");
        die( mysql_error()."</body></html>");
    }

    while ($row = mysql_fetch_array($prow)){
        if ($row['email'] == $email) {
            $pid = $row['pid'];
        }
    }
    

    $result = mysql_query("select * from Users where username = '$email'")
        or die("failed to query database. ".mysql_error());


    $row = mysql_fetch_array($result);
    $id = $row['uid'];
     

    if($row['username'] == $email){
            alert("an account with this Email already exists, please try to sign in");
            $succ = "http://webdev.cs.ku.edu.kw/~elhussiny/trial2/HOME/Home.php";
        }else{
            $insert = mysql_query("INSERT INTO Patients Values ($pid, '$fname', '$lname', '$dob', '$gender', '$phone', '$email')")
            or die("failed to query database. ".mysql_error());

            $insertUser = mysql_query("INSERT INTO Users Values ($pid, '$email', '$pass', 'Patient')")
            or die("failed to query database. ".mysql_error());

            $succ = "http://webdev.cs.ku.edu.kw/~elhussiny/trial2/HOME/signin.php";
        }
        // clear out the output buffer
        while (ob_get_status()) 
        {
            ob_end_clean();
        }
        // no redirect
        header( "Location: $succ" );
    }



function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="signup.css">
    <title>SignUp</title>
</head>
<body>

<form class = "box" onsubmit="check()" action="" method="post">
    <h1>SignUp</h1>
    <input type="text" name="fname" id="fname" placeholder="First Name">
    <input type="text" name="lname" id="lname" placeholder="Last Name">
    <input type="date" name="dob" id="dob" placeholder="Date of Birth: YYYY-MM-DD">
    <select name="gender">
        <option>male</option>
        <option>female</option>
    </select>
    <input type="text" name="phone" id="phone" placeholder="Phone Number: +XXX-XXXX-XXXX">
    <input type="text" name="email" id="mail" placeholder="Email: user@domain.com">
    <input type="password" name="psw" id="psw" placeholder="Enter Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <input type="password" name="psw" placeholder="Confirm Password">
    <input type="submit" name="submit" value="SignUp">
    <a href="Home.php"><input type="button" name="submit" value="Back to Home page"></a>
</form>

<div id="message">
    <h3>Password must contain the following:</h3>
    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
    <p id="number" class="invalid">A <b>number</b></p>
    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

<script src="signup.js"></script>
</body>
</html>