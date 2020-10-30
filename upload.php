<?php

require_once 'auth.php';

$tkuva = ($_POST['tkuva']);
// echo $tkuva . '<br>';
if (isset($_FILES['kuva'])) {
    $target_Path = substr($tkuva, 0, 24);
    $polku = substr($tkuva, 0, 24);
    $knimi = substr($tkuva, 24, 33);
    // echo "polku <br>";
    // echo $target_Path . '<br>';
    $target_Path = $target_Path . basename($_FILES['kuva']['name']);
    // echo "knimi <br>";
    // echo $knimi . '<br>';
    // echo "target path <br>";
    // echo $target_Path . '<br>';
    // echo "posted image name <br>";
    // echo $_FILES['kuva']['name'];
    // echo "<br>";
    move_uploaded_file($_FILES['kuva']['tmp_name'], $target_Path);
    $name = $_FILES['kuva']['name'];
    rename($target_Path, $tkuva);
    // echo "image name <br>";
    // echo $name;
}
header("location:admin-index3.php");


// files/assets/36674702/1/ranta.jpg
// files/assets/36674703/1/glossy.jpg
// files/assets/36674702/1/ranta.jpg