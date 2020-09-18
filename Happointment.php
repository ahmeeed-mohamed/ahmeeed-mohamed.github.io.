<?php

$departments = "SELECT dname FROM Departments";
$doctors = "SELECT CONCAT(fname, ' ', lname) FROM Doctors ";
$timing = "SELECT aid, doc_id, app_date, app_time FROM Appointments";
$patient = "SELECT pid, email FROM Patients"; 

if( !( $database = mysql_connect("localhost", "elhussin_hussin", "Azeem123")))
            die("could not connect to database</body></html>");

if( !(mysql_select_db("elhussin_Project", $database)))
    die("could not open elhussin_Project Database</body></html>");

if(!( $doc = mysql_query($doctors, $database))){
    print("<p>could not retrieve doctors.</p>");
    die( mysql_error()."</body></html>");
}

if(!( $dept = mysql_query($departments, $database))){
        print("<p>could not retrieve departments.</p>");
        die( mysql_error()."</body></html>");
}

if(!( $time = mysql_query($timing, $database))){
        print("<p>could not retrieve appointment timings.</p>");
        die( mysql_error()."</body></html>");
}

if(isset($_POST['book'])){ //check if form was submitted
    
    ob_start(); // ensures anything dumped out will be caught
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $dept = $_POST['dept'];
    $app_date = $_POST['app_date'];
    $app_time = $_POST['app_time'];
    $doctor = $_POST['doctor'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aid = rand ( 30000 , 39999 );
    $dname = explode (" ", $doctor);
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


    $get_did = "SELECT did FROM Doctors WHERE fname = '".$dname[0]."' and lname = '".$dname[1]."'";

    if(!( $drow = mysql_query($get_did, $database))){
        print("<p>could not retrieve doctor ID.</p>");
        die( mysql_error()."</body></html>");
    }

    $row = mysql_fetch_array($drow);
    $did = $row['did'];

    while ($row = mysql_fetch_array($time)){
        while ($row['aid'] == $aid) {
            $aid = rand ( 30000 , 39999 );
        }
        if ($row['doc_id'] == $did) {
                if ($row['app_time'] == $app_time) {
                    print("please choose a different Doctor, Date, or Time for your appointment");
                    // clear out the output buffer
                    while (ob_get_status()){
                            ob_end_clean();
                    }
                    // no redirect
                    header( "Location: Happointment.php" );
                    die("an the same details already exits");

                }
        }
    }

    $insert = "INSERT INTO Appointments VALUES(".$aid.", ".$pid.", ".$did.", '".$app_date."', '".$app_time."', '".$dept."', 'unpaid')";

    if(!( $result = mysql_query($insert, $database))){
        print("<p>could not Insert Appointment Data.</p>");
        die( mysql_error()."</body></html>");
    }

    // clear out the output buffer
    while (ob_get_status()){
            ob_end_clean();
    }

    // no redirect
    header( "Location: Home.php" );





}

function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book an Appointment</title>
    <link rel="stylesheet" type="text/css" href="appointment.css">
</head>
<body>

<div class="slogan">
    <div class="two">  
            <a href="Home.php"><img src="logo.png" class="logo"></a>   
            <ul id="one">
                <li><a href="Happointment.php" id='now'>New Appointment</a></li>
                <li><a href="HContact.php">Contact</a></li>
                <li><a href="Habout.php">AboutUs</a></li>
                <li><a href="signin.php">LogIn</a></li>
                <li><a href="signup.php">SignUp</a></li>
                <li><a href="ar_Happointment.php">عربي</a></li>
            </ul></div>


    <div class="form">
        <form action="" method="post" onsubmit="return check()">
            <fieldset class="fieldset">
                
                <h1>Please Fill This Form</h1>

                <?php

                print("<p><label>First Name<input type='text' id='fname' name='fname' placeholder='First Name'></label></p>");

                print("<p><label>Last Name<input type='text' id='lname' name='lname' placeholder='Last Name'></label></p>");

                print("<p><label>Gender<select name='gender'><option selected>male</option>
                        <option>female</option></select></label></p>");

                print("<p>Date of Birth <input type='date' name='dob' max='1979-12-31' placeholder='YYYY-MM-DD'></p>");

                print("<p>Phone Number<input type='tel' name='phone' id='phone' placeholder='+XXX-XXXX-XXXX'></p>");

                print("<p>Email <input type='email' id='mail' name='email' placeholder='user@domain.com'></p>");

                print("<p><label>Select Department<select name='dept'>");
                while ($deptrow = mysql_fetch_row($dept)){
                    foreach($deptrow as $key => $value )
                        print("<option>$value</option>");
                }
                print("</select></label></p>");
                

                print("<p><label>Select Doctor<select name='doctor'>");
                while ($docrow = mysql_fetch_row($doc)){
                    foreach($docrow as $key => $value )
                        print("<option>$value</option>");
                }
                print("</select></label></p>");

                print("<p><label>Appointment Date<input type='date' placeholder='YYYY-MM-DD' name='app_date'></label></p>");

                print("<p><label>Appointment Time<select name='app_time'>");
                print("<option>08:00 AM</option>");
                print("<option>09:00 AM</option>");
                print("<option>10:00 AM</option>");
                print("<option>11:00 AM</option>");
                print("<option>12:00 PM</option>");
                print("<option>01:00 PM</option>");
                print("<option>02:00 PM</option>");
                print("<option>03:00 PM</option>");
                print("</select></label></p>");

                ?>
                
                <input type="submit" class="submit" name="book" value="Book">
            </fieldset>
        </form>
    </div>

</div>
<div class="Bottom">


    <svg class="svg--source" width="0" height="0" aria-hidden="true">
        <symbol id="svg--twitter" viewbox="0 -7 15 30">
            <path d="M15.36 3.434c-0.542 0.241-1.124 0.402-1.735 0.476 0.624-0.374 1.103-0.966 1.328-1.67-0.583 0.346-1.23 0.598-1.917 0.733-0.551-0.587-1.336-0.954-2.205-0.954-1.668 0-3.020 1.352-3.020 3.019 0 0.237 0.026 0.467 0.078 0.688-2.51-0.126-4.735-1.328-6.224-3.155-0.261 0.446-0.41 0.965-0.41 1.518 0 1.048 0.534 1.972 1.344 2.514-0.495-0.016-0.961-0.151-1.368-0.378 0 0.013 0 0.025 0 0.038 0 1.463 1.042 2.683 2.422 2.962-0.253 0.069-0.52 0.106-0.796 0.106-0.194 0-0.383-0.018-0.568-0.054 0.384 1.2 1.5 2.073 2.821 2.097-1.034 0.81-2.335 1.293-3.75 1.293-0.244 0-0.484-0.014-0.72-0.042 1.336 0.857 2.923 1.357 4.63 1.357 5.554 0 8.592-4.602 8.592-8.593 0-0.13-0.002-0.261-0.009-0.39 0.59-0.426 1.102-0.958 1.507-1.563z"/>
        </symbol>
        <symbol id="svg--google" viewbox="-13 -13 72 72">
            <path d="M48,22h-5v-5h-4v5h-5v4h5v5h4v-5h5 M16,21v6.24h8.72c-0.67,3.76-3.93,6.5-8.72,6.5c-5.28,0-9.57-4.47-9.57-9.75
s4.29-9.74,9.57-9.74c2.38,0,4.51,0.82,6.19,2.42v0.01l4.51-4.51C23.93,9.59,20.32,8,16,8C7.16,8,0,15.16,0,24s7.16,16,16,16
c9.24,0,15.36-6.5,15.36-15.64c0-1.17-0.11-2.29-0.31-3.36C31.05,21,16,21,16,21z"/>
        </symbol>
        <symbol id="svg--facebook" viewbox="0 -7 16 30">
            <path d="M12 3.303h-2.285c-0.27 0-0.572 0.355-0.572 0.831v1.65h2.857v2.352h-2.857v7.064h-2.698v-7.063h-2.446v-2.353h2.446v-1.384c0-1.985 1.378-3.6 3.269-3.6h2.286v2.503z" />
        </symbol>
    </svg>

    <div class="wrapper">
        <p align="center" style="font-size:20px; color: white;"> Find us:</p>
        <div class="connect">
            <a href="www.twitter.com" rel="author" class="share twitter">
                <svg role="presentation" class="svg--icon">
                    <use xlink:href="#svg--twitter" />
                </svg>
                <span class="clip">TWITTER</span>
            </a>
            <a href="www.gmail.com"  rel="author" class="share google">
                <svg role="presentation" class="svg--icon">
                    <use xlink:href="#svg--google" />
                    <span class="clip">GOOGLE +</span>
                </svg>
            </a>
            <a href="www.facebook.com" rel="author" class="share facebook">
                <svg role="presentation" class="svg--icon">
                    <use xlink:href="#svg--facebook" />
                    <span class="clip">FACEBOOK</span>
                </svg>
            </a>
            <br>
            <br>
        </div>
        <br>
        <br>

    </div>
    <p class="info"> Kuwait University<br>
        Khaldiya Campus, Khaldiya<br>
        Kuwait City, Kuwait<br>
        Telephone: +965 99525102<br>
        Email: vita@ourclinic.kw</p>
    <br><br><p class="footer" align="center" style="font-size:15px"> Copyright© VITA. 2019. All rights reserved </p>
    <br>
</div>
<script src="edit.js"></script>
</body>
</html>