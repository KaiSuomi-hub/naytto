<?php
require_once 'config.php';
//require_once 'auth.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "SELECT * FROM tiedot";
$result = mysqli_query($mysqli, $query);
foreach ($result as $tiedot) {
    echo '
<br>
<div class="border text-center  container p-3">
    <br>
    <b>Yhteystietomme</b><br>
    <br><br>
    <div class="border row p-3 bg-light">
        <DIV class="col bg-light">
            <b>Tähän osoite </b>
            <p>' . $tiedot["osoite"] . '</p>
            <b>Tähän email </b>
            <p>' . $tiedot["sposti"] . '</p>
            <b>Tähän puhelin </b>
            <p>' . $tiedot["puh"] . '</p>
        </DIV>
        <BR>
    </div>
    <BR>
    <div class="border text-center  col p-3 bg-light">
        <div class="col p-3">
            <P>Tähän kartta</P>
            <iframe src="' . $tiedot["kartta"] . '
            " width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>';
}
;