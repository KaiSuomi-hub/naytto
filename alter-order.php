<!-- alter-order.php -->
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
    $id= ($_POST['id']);
    $enimi = ($_POST['enimi']);
    $snimi = ($_POST['snimi']);
    $osoite = ($_POST['osoite']);
    $email = ($_POST['email']);
    $ohjeita = ($_POST['ohjeita']);
    $teos = ($_POST['teos']);
    $tmaara = ($_POST['tmaara']);
$alter="update tilaukset set `enimi`='$enimi', `snimi`='$snimi', `ohjeita`='$ohjeita', `osoite`='$osoite', `email`='$email', `ohjeita`='$ohjeita', `teos`='$teos', `tmaara`='$tmaara' where `id`=$id";
mysqli_query($link, $alter);
// koe yhdella muuttujalla
// $alter = mysqli_query($link, "update tilaukset set nimi='$nimi'");
echo " <br> this is the check if we find the id";
echo " <br> this is where we alter<br>";
echo $alter;
    mysqli_close($link);
    header("location:admin-index2.php"); 
    exit;
?>