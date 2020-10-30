<?php
session_start();
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


    <title>Rekisteröidy</title>
    <script>
    function resetForm() {
        document.getElementById("loginForm").reset();
    }

    function loginii() {
        window.location.href = "./login-form.php";
    }
    </script>

    <!-- font-awesome kopioi kaikille sivuille  -->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
include './header.html';
?>
    <br>

    <?php
if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
    echo '<ul class="err">';
    foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>', $msg, '</li>';
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
}
?>
    <br>
    <div id="main" class="border container p-3">
        <br>
        <b>Rekisteröidy käyttäjäksi </b><br><br>

        <div id="chat" class="border row p-3 bg-light">
            <DIV class="col bg-light">
                <b>Anna tietosi</b>
            </DIV>
            <BR>
        </div>
        <BR>
        <div id="rekisteroidy" class="border col p-3 bg-light">
            <form id="loginForm" name="loginForm" method="post" action="register-exec.php">
                <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
                    <tr>
                        <th>Etunimi </th>
                        <td><input class="m-2" name="firstname" type="text" class="textfield" id="firstname" /></td>
                    </tr>
                    <tr>
                        <th>Sukunimi </th>
                        <td><input class="m-2" name="lastname" type="text" class="textfield" id="lastname" /></td>
                    </tr>
                    <tr>
                        <th width="124">Nimimerkki</th>
                        <td width="168"><input class="m-2" name="login" type="text" class="textfield" id="login" /></td>
                    </tr>
                    <tr>
                        <th width="124">Osoite</th>
                        <td width="168"><input class="m-2" name="osoite" type="text" class="textfield" id="osoite" />
                        </td>
                    </tr>
                    <tr>
                        <th width="124">Kaupunki</th>
                        <td width="168"><input class="m-2" name="city" type="text" class="textfield" id="city" /></td>
                    </tr>
                    <tr>
                        <th width="124">Postinumero</th>
                        <td width="168"><input class="m-2" name="zip" type="text" class="textfield" id="zip" /></td>
                    </tr>
                    <tr>
                        <th width="124">Puhelin</th>
                        <td width="168"><input class="m-2" name="puhelin" type="text" class="textfield" id="puhelin" />
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <th width="124">Email</th>
                        <td width="168"><input class="m-2" name="email" type="text" class="textfield" id="email" /></td>
                    </tr>
                    <th>Salasana</th>
                    <td><input class="m-2" name="password" type="password" class="textfield" id="password" /></td>
                    </tr>
                    <tr>
                        <th>Vahvista salasana</th>
                        <td><input class="m-2" name="cpassword" type="password" class="textfield" id="cpassword" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input class="btn btn-sm btn-primary" type="submit" name="Submit" value="Rekisteröidy" />
                            <br><br>
                            <p class="btn btn-primary btn-sm" onclick="resetForm()">Tyhjennä</P>
                            <p class="btn btn-primary btn-sm" onclick="loginii()">Kirjaudu</P>
                            <br><br> <br>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


 
</body>


</html>