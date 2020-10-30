<?php
require_once('config.php');
require_once 'auth.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "SELECT * FROM tilaukset";
echo '
<table class="table table-sm table-striped table-hover"> 
<thead class="thead-dark">      <h4>Hallinnoi tilauksia</h4>
      <tr>
          <th> <font face="Arial">TID</font> </th> 
          <th> <font face="Arial">ID</font> </th> 
          <th> <font face="Arial">Nimi</font> </th> 
          <th> <font face="Arial">S.Nimi</font> </th> 
          <th> <font face="Arial">Osoite</font> </th> 
          <th> <font face="Arial">Email</font> </th> 
          <th> <font face="Arial">Ohjeita</font> </th>  
          <th> <font face="Arial">Teos</font> </th> 
          <th> <font face="Arial">Teosmäärä</font> </th> 
          <th> <font face="Arial">Muokkaa</font> </th> 
          <th> <font face="Arial">Poista</font> </th> 
      </tr>
</thead>';
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $fieldname = $row["id"];
        $field7name = $row["tid"];
        $field1name = $row["enimi"];
        $field2name = $row["snimi"];
        $field3name = $row["osoite"];
        $field4name = $row["email"];
        $field5name = $row["ohjeita"];
        $field6name = $row["teos"];
        $field8name = $row["tmaara"];
        $field10name = $row["puhelin"];
        echo '<form id="tilausmuutos" name="tilausmuutos" method="post" class="form-inline" action="alter-order.php"><tr>
                  <td> '.$field7name.'</td>
                  <td> '.$fieldname.'</td> 
                  <td> <input class="form-control" type="text" name="enimi" value="'.$field1name.'"></td> 
                  <td> <input class="form-control" type="text" name="snimi" value="'.$field2name.'"></td> 
                  <td> <input class="form-control" type="text" name="osoite" value="'.$field3name.'"></td> 
                  <td> <input class="form-control" type="text" name="email" value="'.$field4name.'"></td> 
                  <td> <input class="form-control" type="text" name="ohjeita" value="'.$field5name.'"></td> 
                  <td> <input class="form-control" type="text" name="teos" value="'.$field6name.'"></td>
                  <td> <input class="form-control" type="text" name="tmaara" value="'.$field8name.'"></td> 
                  <td><button class="btn btn-primary" type="submit" name="id" value="'.$fieldname.'">Muokkaa</button></td>
                  <td><a class="btn btn-primary" href="delete-order.php?id='.$fieldname.'">Poista</a></td> 
              </tr>     
              </form>';
    }
    $result->free();
}
?>