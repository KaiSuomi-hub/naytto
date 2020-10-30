<!-- alter-ytiedot.php
 -->
<?php
require_once 'config.php';
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
$osoite = ($_POST['osoite']);
$sposti = ($_POST['sposti']);
$puh = ($_POST['puh']);
$kartta = mysqli_real_escape_string($link, $_POST['kartta']);

//tämä on oikea mysql query formaatti
$update = "UPDATE `suoant`.`tiedot` SET `osoite`='$osoite', `sposti`='$sposti', `puh`='$puh', `kartta`='$kartta' where `id`=1";
$alter = mysqli_query($link, $update);
echo " <br> this is where we alter<br>";

// koe yhdella muuttujalla
// $alter = mysqli_query($link, "update tilaukset set nimi='$nimi'");
echo $update . '<br>';
mysqli_close($link);
header("location:ytiedot.php");
exit;