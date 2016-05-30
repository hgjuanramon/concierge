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
        <meta name="viewport" content="width=device-width">
        <?php echo $template['metadata']; ?>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url();?>">Logo</a>
                </div>    
                <ul class="nav navbar-right top-nav">                    
                    <li>
                        <?php echo anchor('admin/logout', '<i class="glyphicon glyphicon-share-alt"></i> <span class="text">Cerrar Session</span>'); ?>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <?php echo $template['nav'] ?>                    
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="main-content">
                <div class="container-fluid">
                    <?php echo $template['body'] ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <footer>
            <div class='container-fluid'>
                <div class="row-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="copyright text-center">&copy; Juan Ramón</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php echo $template['scripts_footer']; ?>
    </body>
</html>