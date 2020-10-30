<!-- make-order.php -->
<?php
//Include database connection details
require_once 'config.php';
require_once 'auth.php';
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;
//Connect to mysql server
// $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
// if(!$link) {
//     die('Failed to connect to server: ' . mysqli_error());
// }
// //Select database
// $db = mysqli_select_db($link, DB_DATABASE);
// if(!$db) {
//     die("Unable to select database");
// }
// muuttujat
$tid = "$_COOKIE[id]";
$enimi = ($_POST['enimi']);
$snimi = ($_POST['snimi']);
$osoite = ($_POST['osoite']);
$email = ($_POST['email']);
$ohjeita = ($_POST['ohjeita']);
$teos[0] = $_POST['tnimi'][0];
$teos[1] = $_POST['tnimi'][1];
$teos[2] = $_POST['tnimi'][2];
$tmaara[0] = ($_POST['tmaara'][0]);
$tmaara[1] = ($_POST['tmaara'][1]);
$tmaara[2] = ($_POST['tmaara'][2]);
$puhelin = ($_POST['puhelin']);
echo $tnimi[0] . '<br><br>';
echo $teos[1] . '<br><br>';
//Create INSERT query
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$qry = "INSERT INTO tilaukset (tid, enimi, snimi, osoite, email, ohjeita, teos, tmaara, puhelin) VALUES ('$tid',
'$enimi', '$snimi','$osoite','$email', '$ohjeita',
'$teos[0],$teos[1],$teos[2]',
'$tmaara[0],$tmaara[1],$tmaara[2]',
'$puhelin')";
////echo $qry.'<br><br>';
$to = $email;
$subject = "Tilausvahvistus";
$message = "<h6>Kiitos tilksesta</H6>";
$message .= "<p>Tilasit seuraavia tuotteita</p>";
$message .= '<html lang="en-US">
<head>
<!-- omatyyli -->
<link rel="stylesheet" href="./css/main-style.css" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- bootstrap jquery -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<br>
<div id="main" class="w-75 container-fluid p-3">
<div class="row">
<div id="info" class="text-center  col p-3">
<h6>Alla näet vahvistuksen tilaamistasi tuotteista</h6>
</div>
<br><br>
</div>
<div id="main" class=" text-center  p-3"> <h6>Tekemäni tilaus</h6>
<div id="info" class=" row p-3 bg-light">
<DIV class="col-sm bg-light">
<table class="table table-sm table-striped table-hover">
<thead class="thead-dark">
<tr>
<th> <font face="Arial">Nimi</font> </th>
<th> <font face="Arial">S.Nimi</font> </th>
<th> <font face="Arial">Osoite</font> </th>
<th> <font face="Arial">Email</font> </th>
<th> <font face="Arial">Puhelin</font> </th>
<th> <font face="Arial">Ohjeita</font> </th>
<th> <font face="Arial">Teos</font> </th>
<th> <font face="Arial">Teosmäärä</font> </th>
</tr>
</thead><tr>
<td>  <p>' . $enimi . '</p></td>
<td> <p>' . $snimi . '</p></td>
<td> <p>' . $osoite . '</p></td>
<td> <p>' . $email . '</p></td>
<td> <p>' . $puhelin . '</p></td>
<td> <p>' . $ohjeita . '</p></td>
<td> <p>' . $teos[0] . ' ' . $teos[1] . ' ' . $teos[2] . '</p></td>
<td> <p>' . $tmaara[0] . ' ' . $tmaara[1] . ' ' . $tmaara[2] . '</p></td>
</tr>
</table>
</div>
</div>
</div>
</body>
</html>
';
$header = "From:Antti@geronimo.okol.org \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
$retval = mail($to, $subject, $message, $header);
echo "$teos[0]$teos[1]$teos[2]";
$x = 1;
while ($x <= 3) {
    setcookie('tilattuteos' . $x, "", time() - 3600);
    $x++;
}
if ($conn->multi_query($qry) === true) {
//echo "New records created successfully";
} else {
//echo $qry.'<br><br>';
}
//echo $teos[0].'<br><br>';
header("location: tilaus-success.php");
exit();
?>