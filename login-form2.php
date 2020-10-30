<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- omatyyli -->
    <link rel="stylesheet" href="./css/main-style.css" />

    <!-- bootstrap jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    = "./jquery-json-form-binding.js"
    src
    </script>
    <!-- font-awesome kopioi kaikille sivuille  
    -->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <title>Login Form</title>



</head>

<body>
    <?php
include './header.html';
?>
    <br>
    <div class="border text-center  container p-3">
        <br>
        <b>Login </b><br>
        <br><br>
        <div id="chat" class="border row p-3 bg-light">
            <DIV class="col bg-light">
                <b>Anna käyttäjänimi ja salasana</b>
            </DIV>
            <BR>
        </div>
        <BR>
        <div class="border text-center  col p-3 bg-light">
            <form id="loginForm" name="loginForm" method="post" action="login-exec2.php">
                Käyttäjätunnus
                <input class="m-2 border bg-white" name="login" type="text" id="login" />
                Salasana
                <input class="m-2 border bg-white" name="password" type="password" id="password" />
                &nbsp;
                <input class="btn btn-primary" type="submit" name="Submit" value="Login" /><br><br> <br>
                <a href="./register-form.php">Rekisteröidy</a> | <a href="./reset-password-form.php">Unohtuiko
                    salasana?</a> <br>


            </form>

        </div>
    </div>
    <div class="container-fluid text-center" id="overlay">
        <div id="popup">
            <div id="close">X</div>
            <br>
            <p>Käyttäjätunnus: ss <br>Salasana: ss</p>
            <p>Admintunnus: aa <br>Salasana: aa</p>
        </div>
    </div>



    <!-- skrptia -->
    <script>
    $(document).ready(function() {
        $('#trigger').click(function() {
            $('#overlay').fadeIn(300);
        });

        $('#close').click(function() {
            $('#overlay').fadeOut(300);
        });
    });
    </script>
 
</body>


</html>