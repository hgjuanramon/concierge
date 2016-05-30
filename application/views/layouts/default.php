<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie9 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $template['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $template['metadata']; ?>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Hospelry Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>       
    </head>
    <body>
        <!--[if lt IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

        <header>
            <?php echo $template['partials']['header']; ?>
        </header>

        <main id="main-content" class="marge-mobile">
            <?php echo $template['body']; ?>
        </main>
        <footer>
            <div class="footer-section">
                <div class="container">
                    <div class="footer-top">
                        <p>&copy; <?php echo date('Y')?> Concierge. Todos los derechos reservados | Diseñado por  <a href="https://secoweb.com.mx">Secoweb</a></p> <a href="#"><b>Aviso de Privacidad.</b></a>
                    </div>

                </div>
            </div>
        </footer>
        <span class="go-up"><i class="glyphicon glyphicon-chevron-up"></i></span>
            <?php echo $template['scripts_footer']; ?>
    </body>
</html>