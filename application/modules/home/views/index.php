<!--inicia slider-->
<div id="wowslider-container1">
    <div class="ws_images"><ul>
            <li><img src="assets/images/1.jpg" alt="banner1" title="banner1" id="wows1_0"/></li>
            <li><img src="assets/images/2.jpg" alt="banner1" title="banner1" id="wows1_0"/></li>
            <li><img src="assets/images/3.jpg" alt="banner1" title="banner1" id="wows1_0"/></li>
            <li><img src="assets/images/4.jpg" alt="banner1" title="banner1" id="wows1_0"/></li>
        </ul></div>
    <div class="ws_script" style="position:absolute;left:-99%"></div>
    <div class="ws_shadow"></div>
    <!--termina slider-->
    <!--inicia buscador-->
    <div class="search-widget container hidden-xs">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="search-box">
                    <div class="search-heading">
                        <h1><strong>Buscador   <li class="pull-right glyphicon glyphicon-search"></li></strong></h1>
                    </div>
                    <div class="search-body">
                        <?php echo form_open('search', array('class' => '', 'method' => 'get')); ?>

                        <div class = "form-group">
                            <?php echo form_control($state_id); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_control($city_id, array('class' => 'city_id')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_control($inmueble_type_id); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_control($mode_id); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_control($term); ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <?php echo form_control($from); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo form_control($to); ?>
                            </div>
                        </div> 
                        <div class="margin-top-15 text-center">
                            <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
<!--termina buscador-->

<!--inica destinos turisticos-->
<div class="content">
    <div class="Welcome-section">
        <div class="container">
            <h2>Destinos Turísticos</h2>

            <div class="Welcome-grids">

                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/rivieraMaya.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>Riviera Maya</h4>
                </div>
                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/nayarit.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>Riviera Nayarit</h4>
                </div>
                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/cdmx.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>Ciudad de México</h4>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/zac.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>México Colonial</h4>
                </div>
                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/chiapas.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>Chiapas</h4>

                </div>
                <div class="col-md-4 welcome-grid">
                    <div class="welcome-grid1">
                        <img src="assets/images/pacifico.jpg" class="img-responsive" alt=""/>
                    </div>
                    <h4>Pacífico Mexicano</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!--termina destinos turisticos-->
<!--inicia hoteles-->
<div class="most-popular"><h3 class="title">Hoteles</h3></div>    
<div class="container">	
    <div class="row">
        
    </div>      
</div>
<div class="slider1">
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel4.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 5</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel1.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 1</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel2.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 2</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel3.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 3</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel4.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 4</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel1.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 6</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel1.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 7</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>

    <div class="slide"><div class="">
            <div class="feature">
                <div class="feature1">
                    <img src="assets/images/hotel1.jpg" class="img-responsive" alt=""/>
                    <h4>Hotel 8</h4>
                </div>
                <div class="feature2">
                    <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, lesuada at, neque. Viv eget nibh. Etam cus. Nulla facilisi. </p>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--ifrmaes-->
<div class="most-popular"><h3 class="title">Servicios</h3></div>    
<div class="container">	
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xs-12">
            <a href="#"><i class="glyphicon glyphicon-plane iframes"><br><br><p>AEROLÍNEAS </p></i></a>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12">
            <a href="#"><i class="glyphicon glyphicon-check iframes"><br><br><p>RESERVA DE HOTELES</p></i></a>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12">
            <a href="#"><i class="glyphicon glyphicon-plane iframes"><br><br><p>AUTOS COMPARTIDOS</p></i></a>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12">
            <a href="#"><i class="glyphicon glyphicon-bed iframes"><br><br><p>RESERBUS</p></i></a>
        </div>
    </div>
</div>
<!--termina iframes-->
