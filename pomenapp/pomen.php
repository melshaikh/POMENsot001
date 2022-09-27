<?php if(isset($_GET['pomenid'])){ include '../api/headl.inc.php'; $pomen = getUserByID($_GET['pomenid']);?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agnes Template</title>
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,700|Mukta:500,700" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/style.css">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
                                <svg width="48" height="32" viewBox="0 0 48 32" xmlns="http://www.w3.org/2000/svg">
                                    <title>Agnes</title>
                                    <defs>
                                        <linearGradient x1="0%" y1="100%" y2="0%" id="logo-a">
                                            <stop stop-color="#007CFE" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#007DFF" offset="100%"/>
                                        </linearGradient>
                                        <linearGradient x1="100%" y1="50%" x2="0%" y2="50%" id="logo-b">
                                            <stop stop-color="#FF4F7A" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#FF4F7A" offset="100%"/>
                                        </linearGradient>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <rect fill="url(#logo-a)" width="32" height="32" rx="16"/>
                                        <rect fill="url(#logo-b)" x="16" width="32" height="32" rx="16"/>
                                    </g>
                                </svg>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <?php $u_service = getServicesByUserID($pomen['id']); 
        $pomen_type = getPomenTypeByUserID($pomen['id']);?>
        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hero-title h2-mobile mt-0 is-revealing"><?php echo $pomen['name']; ?>
                                <br>I am a <?php echo $pomen_type['name']; ?></h1>
                            <h3 class="hero-title h3-mobile mt-0 is-revealing">List of my services:</h3>
                            <p class="hero-paragraph is-revealing">
                            <?php $i = 1; if(!is_null($u_service))while ($us=$u_service->fetch()){ 
                            echo '<br>'.$i.' - '.$us['name'];$i++;
                            }
                            ?>
                            </p>                            
                        </div>
                        <div class="hero-illustration is-revealing">
                            <img src="../images/userImages/<?php echo $pomen['image']; ?>">
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="dist/js/main.min.js"></script>
</body>
</html>

<?php } else {     echo 'Eroor 0'; } ?>