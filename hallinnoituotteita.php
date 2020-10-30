<?php
require_once 'config.php';
require_once 'auth.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "SELECT * FROM teokset";
echo '
<table class="table table-sm table-striped table-hover">
<thead class="thead-dark">
<h4>Hallinnoi Tuotteita</h4>
<tr>
<th>
<font face="Arial">ID</font>
</th>
<th>
<font face="Arial">Nimi</font>
</th>
<th>
<font face="Arial">Kuvaus</font>
</th>
<th>
<font face="Arial">Kuva</font>
</th>
<th>
<font face="Arial">Hinta</font>
</th>
<th>
<font face="Arial">Muokkaa</font>
</th>
<th>
<font face="Arial">Poista</font>
</th>
<th>
<font face="Arial">Vaihda kuva</font>
</th>
</tr>
</thead>';
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $fieldname = $row["id"];
        $field1name = $row["tnimi"];
        $field2name = $row["ttiedot"];
        $field3name = $row["tkuva"];
        $field4name = $row["thinta"];
        echo '<form method="post" id="tiedot" class="form-inline" action="./alter-teos.php">
<tr>
<td> ' . $fieldname . '</td>
<td> <input class="form-control" type="text" name="tnimi" value="' . $field1name . '"></td>
<td> <input class="form-control" type="text" name="ttiedot" value="' . $field2name . '"></td>
<td>
<input type="hidden" name="tkuva" id="tkuva" value="' . $field3name . '">
<img  width=200 height=280 src="' . $field3name . '">
</td>
<td> <input class="form-control" type="text" name="thinta" value="' . $field4name . '"></td>
<td><button class="btn btn-primary" type="submit" name="id" value="' . $fieldname . '">Muokkaa</button></td>
<td><a class="btn btn-primary" href="delete-teos.php?id=' . $fieldname . '">Poista</a></td>
<td>
</form>
<form method="post" enctype="multipart/form-data" action="upload.php">
<input type="file" name="kuva" >
<input type="hidden" name="tkuva" id="tkuva" value="' . $field3name . '">
<button class="btn btn-primary" type="submit" value="Lataa">lataa</button>
</form>
</td>
</tr>
';
    }
    $result->free();
}