<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- omatyyli -->
    <link rel="stylesheet" href="./css/main-style.css" />

    <!-- bootstrap jquery -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      = "./jquery-json-form-binding.js"
      src
    </script>
    <!-- font-awesome kopioi kaikille sivuille  
    -->
    <script
      src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
      crossorigin="anonymous"
    ></script>
    <title>Virtuaali-galleria</title>
  </head>

  <body>
    <?php
include './header.html';
?>
    <iframe
      width="100%"
      height="1440px"
      src="./pc-load.html"
      frameborder="0"
    ></iframe>
    <div class="container-fluid text-center" id="overlay">
        <div id="popup">
            <div id="close">X</div>
            <p>Paina <b>ESC</b> vapauttaaksesi hiiren jotta voit tilata teoksen klikkaamalla.</p>
            <p>Liiku <b>WASD</b> näppäimistöllä tai kosketusnäytön <b>oikealla ja vasemmalla reunalla<b> raahaten.</p>
            <p>Klikkaa lopuksi <b>kassaa</b> siirtyäksesi tilaamaan.</p>
        </div>
    </div>
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
