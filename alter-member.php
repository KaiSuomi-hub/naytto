<!-- alter-member.php -->
<?php
echo "hello";
require_once('config.php');
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

// kenttien arvot
    $member_id= ($_POST['member_id']);
    $firstname = ($_POST['firstname']);
    $lastname = ($_POST['lastname']);
    $login = ($_POST['login']);
    $passwd = ($_POST['passwd']);
    $osoite = ($_POST['osoite']);
    $city = ($_POST['city']);
    $zip = ($_POST['zip']);
    $puhelin = ($_POST['puhelin']);
    $admin = ($_POST['admin']);
    $email = ($_POST['email']);
$query = mysqli_query($link, "SELECT from FROM members WHERE member_id='".$member_id."'");
$alter=mysqli_query($link, "update members set firstname=('$firstname'), lastname=('$lastname'), login=('$login'), passwd=('$passwd'), 
email=('$email'), admin=('$admin'), osoite=('$osoite'), city=('$city'), zip=('$zip'), puhelin=('$puhelin') where member_id=('$member_id')");
 mysqli_query($link, $alter);
    mysqli_close($db);
    header("location:admin-index.php"); 
    exit;



?>