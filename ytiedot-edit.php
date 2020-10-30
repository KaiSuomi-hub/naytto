<?php
// if ("$_COOKIE[admin]" == 0) {
//     include './access-denied.php';
//     exit;
// } else {
//     echo "&nbsp";
// }
require_once 'config.php';
//require_once 'auth.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "SELECT * FROM tiedot";
$result = mysqli_query($mysqli, $query);
foreach ($result as $tiedot) {
    echo '<form method="post" id="tiedot" class="form-inline" action="./alter-ytiedot.php">
<br>
<div class="border text-center  container p-3">
    <br>
    <b>Yhteystietomme</b><br>
    <br><br>
    <div class="border row p-3 bg-light">
        <DIV class="col bg-light">
            <b>Tähän osoite </b>
            <p><input class="form-control" type="text" name="osoite" value="' . $tiedot["osoite"] . '"></p>
            <b>Tähän email </b>
            <p><input class="form-control" type="text" name="sposti" value="' . $tiedot["sposti"] . '"></p>
            <b>Tähän puhelin </b>
            <p><input class="form-control" type="text" name="puh" value="' . $tiedot["puh"] . '"></p>
        </DIV>
        <BR>
    </div>
    <BR>
    <div class="border text-center  col p-3 bg-light">
        <div class="col p-3">
            <P>Tähän kartta</P>
            <iframe src="' . $tiedot["kartta"] . '
            " width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <P>Uusi kartta url </P>
            <input class="form-control" type="text" name="kartta" value="' . $tiedot["kartta"] . '">
            <button class="btn btn-primary" type="submit" name="ytiedot">Muokkaa</button></td>
        </div>
        </form>
    </div>
</div>';
}
;