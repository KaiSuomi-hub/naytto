<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- omatyyli -->
    <link rel="stylesheet" href="./css/main-style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <title>Tilaus</title>
</head>

<body>
    <?php
ob_start();
include './header.html';
?>
    <br>
    <?php if ("$_COOKIE[admin]" == 1) {
    header("location: admin-index.php");
} else {
    echo "&nbsp";
}
?>
    <br>
    <div id="main" class="border w-75 container-fluid p-3">
        <h4>Tee tilaus </h4>
        <div id="info" class="border row p-3 bg-light">
            <DIV class=" bg-light">
                <a href="member-profile.php">Profiilini</a> | <a href="logout.php">Kirjaudu ulos</a>
            </DIV>
            <BR>
        </div>
    </div>
    <!-- haetaan tiedot tietokannasta tilaajalle -->
    <?php

require_once 'config.php';
// $id = $_COOKIE[id];
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "select * from members selectWithPrimaryKey where member_id = $_COOKIE[id] ";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["member_id"];
        $field2name = $row["firstname"];
        $field3name = $row["lastname"];
        $field4name = $row["login"];
        $field5name = $row["passwd"];
        $field6name = $row["email"];
        $field8name = $row["osoite"];
        $field9name = $row["city"];
        $field10name = $row["zip"];
        $field11name = $row["puhelin"];
        echo '
<div id="tilaus" class="border rounded w-75 container-fluid p-3">
<h4>Vahvista tilaamasi julisteet</h4>
<div class="bg-light row">
<div class="col-sm">
<!-- formi alkaa                              muuta VVVV postiksi -->
<form id="form" action="make-order.php" method="post">
<div class="form-group">
<label for="Etunimi"></label>
<input type="text" class="form-control" value="' . $field2name . '" name="enimi" id="enimi"
aria-describedby="helpId">
<small id="helpId" class="form-text text-muted">Etunimi</small>
<label for="Sukunimi"></label>
<input type="text" class="form-control" value="' . $field3name . '" name="snimi" id="snimi"
aria-describedby="helpId">
<small id="helpId" class="form-text text-muted">Sukunimi</small>
</div>
</div>
<div class="col-sm">
<div class="form-group">
<label for="Ohjeita"></label>
<input type="text" class="form-control" name="ohjeita" id="ohjeita" aria-describedby="helpId"
placeholder="Ohjeita tilaukseen">
<small id="helpId" class="form-text text-muted">Anna lisäohjeita tilaukseen</small>
<label for="Osoite"></label>
<input type="text" class="form-control" value="' . $field8name . ',\ ' . $field9name . ',\ ' . $field10name . '"
name="osoite" id="osoite" aria-describedby="helpId">
<small id="helpId" class="form-text text-muted">Osoite</small>
</div>
</div>
</div>
<div class="bg-light  row">
<div class="col-sm">
<div class="form-group">
<label for="Email"></label>
<input type="text" class="form-control" value="' . $field6name . '" name="email" id="email"
aria-describedby="helpId">
<small id="helpId" class="form-text text-muted">Email</small>
</div>
</div>
<div class="col-sm">
<div class="form-group">
<label for="Puhelinnumero"></label>
<input type="text" class="form-control" value="' . $field11name . '" name="puhelin" id="puhelin"
aria-describedby="helpId">
<small id="helpId" class="form-text text-muted">Puhelinnumero</small>
</div>
</div>
</div>
<!-- tahan valiin kappaleet kuvat -->
<div class="row">';
    }
    $result;
}

echo '
<div class="col-sm">
<div class="form-group">
<table class="table table-sm table-striped table-hover">
<thead class="thead-dark">
<tr>
<th> <font face="Arial">TNimi</font> </th>
<th> <font face="Arial">Kuvaus</font> </th>
<th> <font face="Arial">Tkuva</font> </th>
<th> <font face="Arial">Thinta</font> </th>
<th> <font face="Arial">Kappaletta</font> </th>
</tr>

</thead>';
$cookies = array("tilattuteos1" => "1", "tilattuteos2" => "2", "tilattuteos3" => "3");
foreach ($cookies as $check => $id) {
    if (isset($_COOKIE[$check])) {
        $query = "select * from teokset selectWithPrimaryKey where id = $id ";
        $result = mysqli_query($mysqli, $query);
        foreach ($result as $tilatut) {
            echo '    <td> <input type="hidden" name="tnimi[]" value="' . $tilatut['tnimi'] . '"><p>' . $tilatut['tnimi'] . '</p></td>
<td> <p>' . $tilatut['ttiedot'] . '</p></td>
<td> <img src="./' . $tilatut['tkuva'] . '" width="200" height="280"></td>
<td> <p>' . $tilatut['thinta'] . '</p></td>
<td>
<label for="Kpl"></label>
<select class="custom-select" name="tmaara[]" id="tmaara">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="0">0</option>
</select>
<small id="helpId" class="form-text text-muted">Valitse määrä</small>
</td>
</tr>
';
        }
        $result;
    }}

echo '
</div>
</div>
</div>
</div>
<form>
<!-- tahan valiin kappaleet kuvat -->
<div class="row">
<div class="col-sm  text-center">
<br>
<button id="tilaa" class="btn btn-primary" value="Tilaa" onclick="submit" type="submit">
Tilaa
</button>
</div>
</div>
</div>
</div>
</form>
<!-- formi loppuu -->
</div>
</div>
</div>
</body>
</html>';
?>