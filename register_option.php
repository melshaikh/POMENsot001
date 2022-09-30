<?php 
include 'api/headl.inc.php';
include 'api/config.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="templ_public/boos.min.css">
    <script src="templ_public/slim.min.js"></script>
    <script src="templ_public/poper.min.js"></script>
    <script src="templ_public/boos.min.js"></script>
</head>
<body>    
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center align-items-xl-baseline">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Please select Registration type</div>
                        <div class="card-body">
                            <form action="selection_nav.php" method="post">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" class="btn btn-primary" name="user" value="USER">
                                        <input type="submit" class="btn btn-primary" name="pomen" value="POMEN">
                                        <input type="hidden" name="selectionnav">
                                    </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</main>
</body>
<!-- initialize jQuery Library -->
  <script src="templ_public/plugins/jQuery/jquery.min.js"></script>
  <!-- Bootstrap jQuery -->
  <script src="templ_public/plugins/bootstrap/bootstrap.min.js" defer></script>
  <!-- Slick Carousel -->
  <script src="templ_public/plugins/slick/slick.min.js"></script>
  <script src="templ_public/plugins/slick/slick-animation.min.js"></script>
  <!-- Color box -->
  <script src="templ_public/plugins/colorbox/jquery.colorbox.js"></script>
  <!-- shuffle -->
  <script src="templ_public/plugins/shuffle/shuffle.min.js" defer></script>
  <!-- Template custom -->
  <script src="templ_public/js/script.js"></script>
</html>