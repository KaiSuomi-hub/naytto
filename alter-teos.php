<!-- alter-teokset.php -->
<?php
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
    $ttiedot = 'ss';
    $id= ($_POST['id']);
    $tnimi = ($_POST['tnimi']);
    $ttiedot = ($_POST['ttiedot']);
    $tkuva = ($_POST['tkuva']);
    $thinta = ($_POST['thinta']);
//tämä on oikea mysql query formaatti
$update = "UPDATE `suoant`.`teokset` SET `tnimi`='$tnimi', `ttiedot`='$ttiedot', `tkuva`='$tkuva', `thinta`=$thinta where `id`=$id";    
$alter = mysqli_query($link, "UPDATE `suoant`.`teokset` SET `tnimi`='$tnimi', `ttiedot`='$ttiedot', `tkuva`='$tkuva', `thinta`=$thinta where `id`=$id");
echo " <br> this is where we alter<br>";

// koe yhdella muuttujalla
// $alter = mysqli_query($link, "update tilaukset set nimi='$nimi'");
echo $update.'<br>';
    mysqli_close($link);
    header("location:admin-index3.php"); 
    exit;
?>