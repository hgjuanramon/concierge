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
        <header>
            <?php echo anchor(index_page(), 'Site Logo', array('class' => 'logo logo-top')); ?>
        </header>

        <nav id="user-nav" class="navbar navbar-inverse clearfix">
            <ul class="nav btn-group">
                <li class="btn btn-inverse dropdown">
                    <?php echo anchor('#', '<i class="icon icon-wrench"></i> <span class="text">Configuraciones</span> <span class="caret"></span>', array('data-toggle' => 'dropdown', 'data-target' => "#menu-messages", 'class' => "dropdown-toggle")); ?>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('users/change_password/', '<span class="text">Cambiar Password</span>'); ?></li>
                    </ul>
                </li>
                <li class="btn btn-inverse">
                    <?php echo anchor('admin/logout', '<i class="icon icon-share-alt"></i> <span class="text">Cerrar Session</span>'); ?>
                </li>
            </ul>
        </nav>

        <aside id='sidebar' class='clearfix'>
            <nav id='main-nav' class='clearfix'>
                <a href="#" class="visible-phone"><i class="icon icon-home"></i> Menu</a>
                <?php echo $template['nav']; ?>
            </nav>
        </aside>

        <section id='main-content'>
            <?php echo $template['body']; ?>
        </section>

        <footer>
            <div class='container-fluid'>
                <div class="row-fluid">
                    <div class="span12">
                        <p class="copyright align-center">&copy; </p>
                    </div>
                </div>
            </div>
        </footer>
        <?php echo $template['scripts_footer']; ?>
    </body>
</html>