<!-- forgotpass-exec.php -->
<?php
//Start session
session_start();

//Include database connection details
require_once 'config.php';

//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Connect to mysql server
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Failed to connect to server: ' . mysqli_error());
}

//Select database
$db = mysqli_select_db($link, DB_DATABASE);
if (!$db) {
    die("Unable to select database");
}

//Function to sanitize values received from the form. Prevents SQL injection
// function clean($str) {
//     $str = @trim($str);
//     if(get_magic_quotes_gpc()) {
//         $str = stripslashes($str);
//     }
//     return mysqli_real_escape_string($str);
// }
$email = ($_POST['email']);

//Input Validations

if ($email == '') {
    $errmsg_arr[] = 'Email is missing';
    $errflag = true;
}

//If there are input validations, redirect back to the login form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: reset-password-form.php");
    exit();
}

// check if we find email
$query = mysqli_query($link, "SELECT * FROM members WHERE email='" . $email . "'");
if (mysqli_num_rows($query) > 0) {
    //create random password
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $shuffled = str_shuffle($str);
    $newpass = substr($shuffled, 0, 8);
    $hashpass = md5($newpass);
    echo $newpass;
    //Create query
    $qry = "update members set passwd=('$hashpass') where email=('$email')";
    $result = mysqli_query($link, $qry);

    //send pass

    $to = $email;
    $subject = "Tässä uusi salasanasi";

    $message = "<h6>Tilillesi on uusittu salasana.</H6>";
    $message .= "<p>Käytä salasanaa $newpass kirjautuessasi.</p>";
    $header = "From:forum@somedomain.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail($to, $subject, $message, $header);

    echo " Sent your new pass";

} else {

    include "./no-found-email.html";

}

//Check whether the query was successful or not
// if($result) {
//     if(mysqli_num_rows($result) == 1) {
//         //Login Successful
//         session_regenerate_id();
//         $member = mysqli_fetch_assoc($result);
//         $_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
//         $_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
//         $_SESSION['SESS_LAST_NAME'] = $member['lastname'];
//         session_write_close();
//         header("location: login-form.php");
//         exit();
//     }else {
//         //Login failed
//         header("location: login-failed.php");
//         exit();
//     }
// }else {
//     die("Query failed");
// }
?>