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

            <ul class="grid cs-style-3">
                <li class="col-lg-4">
                    <figure>
                        <img src="assets/images/hotel1.jpg" alt="img01">
                        <figcaption>
                            <h3>Camera</h3>
                            <span>Jacob Cummings</span>
                            <a href="http://dribbble.com/shots/1115632-Camera">Take a look</a>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-lg-4">
                    <figure>
                        <img src="assets/images/hotel1.jpg" alt="img01">
                        <figcaption>
                            <h3>Camera</h3>
                            <span>Jacob Cummings</span>
                            <a href="http://dribbble.com/shots/1115632-Camera">Take a look</a>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-lg-4">
                    <figure>
                        <img src="assets/images/hotel1.jpg" alt="img01">
                        <figcaption>
                            <h3>Camera</h3>
                            <span>Jacob Cummings</span>
                            <a href="http://dribbble.com/shots/1115632-Camera">Take a look</a>
                        </figcaption>
                    </figure>
                </li>
                <!-- ... -->
            </ul>
        </div>
    </div>
</div>
