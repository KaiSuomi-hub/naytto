<!-- tilaus-success.php -->
<?php
    require_once('auth.php');
    require_once('config.php');
?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- font-awesome kopioi kaikille sivuille  -->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
include './header.html';
?>
    <br>
    <br>
    <div id="main" class="border w-75 container-fluid p-3">
        <div class="row">
            <div id="info" class="text-center border col p-3">
                <h6>Tilaus suorittu</h6>
                <p>Saat tekemästäsi tilauksesta vahvistuksen sähköpostiisi.</p>
            </div>
            <br><br>
            <DIV class="text-center col border p-3">
                <p>Mita tahdot tehda? </p>
                <a href="./index.html">Tilaa lisää</a> | <a href="logout.php">Logout</a>
            </DIV>
        </div>
        <?php 
$username = "suoant"; 
$password = "suoant887"; 
$database = "suoant"; 
$tid="$_COOKIE[id]";
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM tilaukset where tid=('$tid')";
echo 
'<div id="main" class="border text-center  p-3"> <h6>Tekemäni tilaukset</h6>
<div id="info" class="border row p-3 bg-light">
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
</thead>';
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $fieldname = $row["id"];
        $field1name = $row["enimi"];
        $field2name = $row["snimi"];
        $field3name = $row["osoite"];
        $field4name = $row["email"];
        $field5name = $row["ohjeita"];
        $field6name = $row["teos"];
        $field7name = $row["puhelin"];
        $field8name = $row["tmaara"];   
        echo '<tr>
                 <td>  <p>'.$field1name.'</p></td> 
                  <td> <p>'.$field2name.'</p></td> 
                  <td> <p>'.$field3name.'</p></td> 
                  <td> <p>'.$field4name.'</p></td> 
                  <td> <p>'.$field7name.'</p></td>
                  <td> <p>'.$field5name.'</p></td> 
                  <td> <p>'.$field6name.'</p></td>
                  <td> <p>'.$field8name.'</p></td> 
              </tr>     
              ';
    }
    $result->free();
} 
?>
</body>

</html>