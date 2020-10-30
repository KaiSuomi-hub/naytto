<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
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
  <!-- omatyyli -->
    <link rel="stylesheet" href="./css/main-style.css" />

    <title>Jäsenprofiili</title>

    <!-- font-awesome kopioi kaikille sivuille  -->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
include './header.html';
?>
    <br>

    <br>
    <div id="main" class="border container p-3">
        <div id="info" class="text-center border col p-3">
            <h6>Profiilini</h6>
        </div>
        <br><br>
        <DIV class="text-center col border p-3">
                <form id="loginForm" name="loginForm" method="post" action="selfalter-member.php">
                <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
<?php
require_once('config.php');
require_once('auth.php');
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
                    <tr>
                        <th>Etunimi </th>
                        <td><input class="m-2" name="firstname" type="text" class="textfield" id="firstname" value="'.$field2name.'"/></td>
                    </tr>
                    <tr>
                        <th>Sukunimi </th>
                        <td><input class="m-2" name="lastname" type="text" class="textfield" id="lastname" value="'.$field3name.'"/></td>
                    </tr>
                    <tr>
                        <th width="124">Nimimerkki</th>
                        <td width="168"><input class="m-2" name="login" type="text" class="textfield" id="login" value="'.$field4name.'"/></td>
                    </tr>
                    <tr>
                        <th width="124">Osoite</th>
                        <td width="168"><input class="m-2" name="osoite" type="text" class="textfield" id="osoite" value="'.$field8name.'"/>
                        </td>
                    </tr>
                    <tr>
                        <th width="124">Kaupunki</th>
                        <td width="168"><input class="m-2" name="city" type="text" class="textfield" id="city" value="'.$field9name.'"/></td>
                    </tr>
                    <tr>
                        <th width="124">Postinumero</th>
                        <td width="168"><input class="m-2" name="zip" type="text" class="textfield" id="zip" value="'.$field10name.'"/></td>
                    </tr>
                    <tr>
                        <th width="124">Puhelin</th>
                        <td width="168"><input class="m-2" name="puhelin" type="text" class="textfield" id="puhelin" value="'.$field11name.'"/>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <th width="124">Email</th>
                        <td width="168"><input class="m-2" name="email" type="text" class="textfield" id="email" value="'.$field6name.'"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input class="btn btn-sm btn-primary" type="submit" name="Submit" value="Muokkaa" />
                                                    </td>
                    </tr>
                </table>
            </form>

            <a href="logout.php">Kirjaudu ulos</a>
        </DIV>
    </div>
 
</body>

</html>';}}
?>