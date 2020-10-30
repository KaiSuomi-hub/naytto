<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
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

  <title>Kirjauduit ulos</title>

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
		<h1>Kirjauduit ulos</h1>
		</div>
			<br><br>
			<DIV class="text-center col border p-3">

<p >&nbsp;</p>
<h4 class="err">Kirjauduit ulos sivulta</h4>
<p >Kirjaudu tästä sisään uudelleen <br> <a href="login-form2.php">Kirjaudu</a></p>
</DIV>
</div>
  <?php
include './footer.php';
?>
</body>

</html>
