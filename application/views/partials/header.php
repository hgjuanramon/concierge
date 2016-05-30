<!--<div class="header-top">
    <div class="container">
        <div class="row">
            <div style="color:#707070;" class="col-lg-6 col-md-16 col-sm-6 col-xs-12 text-right">
                <div class="pull-left">
                    <p class="padding-top-5">
                    <p>
                </div>
            </div>
            <div style="color:#707070;" class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
                <div class="pull-right">
                    <span class="glyphicon glyphicon-earphone gray-text margin-top-10"> <span style="font-family: sans-serif;">(55) 43-36-89-94 | </span></span>
                    <span class="glyphicon glyphicon-envelope gray-text margin-top-10"><span style="font-family: sans-serif;"> contacto@hellohouse.com.mx</span></span>
                </div>
            </div>
                        <div style="color:#707070;" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                            <ul class="group-social list-inline">
                                <li>
                                    <a class="facebook" href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
        </div>
    </div>
</div>-->
<div class="header-site">
    <div class="container">
        <div class="row">  
            <div class="logo col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <?php echo anchor('home', img(array('src' => 'assets/img/logo.png', 'class' => 'img-responsive, hidden-xs'))); ?> 
            </div>
            <div style="bakcground-color" class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="hidden-xs" style="margin-top:20px;"></div>
                <nav class="navbar navbar-menu">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">    
                            <?php echo anchor('home', img(array('src' => 'assets/img/#.png', 'class' => 'img-responsive, hidden-lg'))); ?>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only"></span>
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </button>                            
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php echo $template['nav']; ?>      
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div>
</div>



