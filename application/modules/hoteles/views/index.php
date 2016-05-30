<div class="most-popular"><h3 class="title">Hoteles</h3></div>  
<div class="container">
    <div style="text-align:center;" class="margin-top-30 margin-bottom-30">
        <h1>Texto prueba</h1>
        <p style="margin-top: 15px;color:gray;">Un texto pequeño de prueba</p>
        <div style="margin-top:20px;margin-left: auto;margin-right: auto;width: 60px;border-bottom: solid red 3px;"></div>
    </div>
        <?php foreach ($rs as $value): ?>
        <div class=" col-lg-4 col-md-4 col-xs-12"><div class="hotel ">
            <div class="feature">
                <div class="feature2">
                    <img src="assets/images/hotel-hotel.jpg" class="img-responsive" alt=""/>
                    <h4><?php echo $value->name;?></h4>
                </div>
                <div class="feature2">
                    <p><?php echo word_limiter($value->description,20) ;?></p>
                </div>
            </div>
        </div>
    </div>
        <?php endforeach; ?>
   
</div>
