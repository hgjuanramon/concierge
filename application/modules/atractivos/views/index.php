<div class="most-popular"><h3 class="title">Atractivos</h3></div>  
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">           
                <div class="attractives col-lg-12 col-md-12 col-xs-12">
                    <?php foreach ($rs_state as $state): ?>
                        <div class="col-lg-3 col-md-3 col-xs-6">
                            <a hfer="#"><p class="padding-5"><?php echo $state->name; ?></p></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class=" margin-top-15 col-lg-4 col-md-4 col-xs-12">

                <div class="row">
                    <img src="assets/images/hotel1.jpg" class="img-responsive" alt=""/>
                    <h4><?php echo $value->name; ?></h4>
                </div>
                <div class="feature2">
                    <p><?php echo word_limiter($value->description, 20); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
