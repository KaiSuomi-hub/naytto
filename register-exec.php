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

//Sanitize the POST values
$enimi = ($_POST['firstname']);
$snimi = ($_POST['lastname']);
$login = ($_POST['login']);
$login = ($_POST['login']);
$osoite = ($_POST['osoite']);
$city = ($_POST['city']);
$zip = ($_POST['zip']);
$puhelin = ($_POST['puhelin']);
$password = ($_POST['password']);
$cpassword = ($_POST['cpassword']);
$email = ($_POST['email']);
//Input Validations
if ($enimi == '') {
    $errmsg_arr[] = 'Etunimi uupuu';
    $errflag = true;
}
if ($snimi == '') {
    $errmsg_arr[] = 'Sukunimi uupuu';
    $errflag = true;
}
if ($login == '') {
    $errmsg_arr[] = 'Nimimerkki uupuu';
    $errflag = true;
}
if ($email == '') {
    $errmsg_arr[] = 'Sähköposti uupuu';
    $errflag = true;
}

if ($password == '') {
    $errmsg_arr[] = 'Salasana uupuu';
    $errflag = true;
}
if ($cpassword == '') {
    $errmsg_arr[] = 'Salasanat eivät täsmää';
    $errflag = true;
}
if (strcmp($password, $cpassword) != 0) {
    $errmsg_arr[] = 'Salasanat eivät täsmää';
    $errflag = true;
}

// Check for duplicate login ID
if ($login != '') {
    $qry = "SELECT * FROM members WHERE login='$login'";
    $result = mysqli_query($link, $qry);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $errmsg_arr[] = 'Nimimerkki on jo käytössä';
            $errflag = true;
        }
        @mysqli_free_result($result);
    } else {
        die("Query failed1");
    }
}

//If there are input validations, redirect back to the registration form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: register-form.php");
    exit();
}

//Create INSERT query
$hashpass = md5($_POST['password']);
$qry = "INSERT INTO members(firstname, lastname, login, passwd,
 email, osoite, city, zip, puhelin) VALUES('$enimi','$snimi','$login', '$hashpass','$email', '$osoite', '$city', '$zip', '$puhelin')";
$result = @mysqli_query($link, $qry);
echo $qry;
//Check whether the query was successful or not
if ($result) {
    header("location: register-success.php");
    exit();
} else {
    die("Query failed2");
}