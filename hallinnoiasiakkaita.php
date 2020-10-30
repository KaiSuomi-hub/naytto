<?php
require_once('config.php');
require_once('auth.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query = "SELECT * FROM members";

 echo'
 
<table class="table table-sm table-striped table-hover"> <h4>Hallinnoi käyttäjiä</h4>
<thead class="thead-dark">      
      <tr>
          <th> <font face="Arial">ID</font> </th> 
          <th> <font face="Arial">Etunimi</font> </th>  
          <th> <font face="Arial">Sukunimi</font> </th> 
          <th> <font face="Arial">Nick</font> </th> 
          <th> <font face="Arial">Password</font> </th> 
          <th> <font face="Arial">Email</font> </th> 
          <th> <font face="Arial">Osoite</font> </th>
          <th> <font face="Arial">Kaupunki</font> </th>
          <th> <font face="Arial">Postinumero</font> </th>
          <th> <font face="Arial">Puhelin</font> </th>
          <th> <font face="Arial">Admin Status</font> </th> 
          <th> <font face="Arial">Muokkaa</font> </th> 
          <th> <font face="Arial">Poista</font> </th> 
      </tr>
</thead>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $nfield1name = $row["member_id"];
        $nfield2name = $row["firstname"];
        $nfield3name = $row["lastname"];
        $nfield4name = $row["login"];
        $nfield5name = $row["passwd"];
        $nfield6name = $row["email"];
        $nfield8name = $row["osoite"];
        $nfield9name = $row["city"];
        $nfield10name = $row["zip"];
        $nfield11name = $row["puhelin"];
        $nfield7name = $row["admin"];
        
        $oadminvalue = 1;
        

        echo '<form id="jasenmuutos" name="jasenmuutos" method="post" class="form-inline" action="alter-member.php"><tr>
                  <td> '.$nfield1name.'</td> 
                  <td> <input class="form-control" type="text" name="firstname" value="'.$nfield2name.'"></td> 
                  <td> <input class="form-control" type="text" name="lastname" value="'.$nfield3name.'"></td> 
                  <td> <input class="form-control" type="text" name="login" value="'.$nfield4name.'"></td> 
                  <td> <input class="form-control" type="text" name="passwd" value="'.$nfield5name.'"></td> 
                  <td> <input class="form-control" type="text" name="email" value="'.$nfield6name.'"></td> 
                  <td> <input class="form-control" type="text" name="osoite" value="'.$nfield8name.'"></td>
                  <td> <input class="form-control" type="text" name="city" value="'.$nfield9name.'"></td>
                  <td> <input class="form-control" type="text" name="zip" value="'.$nfield10name.'"></td>
                  <td> <input class="form-control" type="text" name="puhelin" value="'.$nfield11name.'"></td>
                  <td> <select class="form-control">  name="admin" 
                  <option> value="'.$nfield7name.'"</option>
                  <option> value="'.abs($nfield7name-=1).'"</option>
                  </select></td>
                  
                  <td><button class="btn btn-primary" type="submit" name="member_id" value="'.$nfield1name.'">Muokkaa</button></td>
                  <td><a class="btn btn-primary" href="delete-member.php?id='.$nfield1name.'">Poista</a></td> 
              </tr>     
              </form>';
    
    }
    $result->free();
}

?>