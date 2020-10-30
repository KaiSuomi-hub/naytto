<!-- admin-index.php -->
<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- omatyyli -->
    <link rel="stylesheet" href="./css/main-style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- three.js -->
    <title>Tilaukset</title>
</head>

<body>
    <?php
include './header.html';
?>
    <br>
    <?php
// tarkistaa onko admin ja jos ei kieltaa
if ("$_COOKIE[admin]"==0) {
        include './access-denied.php';
    exit;
} else {
    echo "&nbsp";
}
?>
    <br>
    <div id="main" class="border container-fluid w-75  p-3">
        <h4>Admin-sivu</h4>
        <div id="info" class="border row p-3 bg-light">
            <p>
                <a href="admin-index.php">Käyttäjät</a>
                |
                <a href="admin-index2.php">Tilaukset</a>
                |
                <a href="admin-index3.php">Tuotteet</a>
            </p>
            <DIV class=" col bg-light">
                <a href="member-profile.php">Profiilini</a> | <a href="logout.php">Kirjaudu ulos</a>
            </DIV>
            <BR><BR>
        </div>
        <div class="col" id="text1">
            <?php
                                    include "./hallinnoitilauksia.php"
                                    ?>
        </div>
    </DIV>
    <!-- container loppuu -->
    <!-- koodia tilaukseen -->
</body>

</html>