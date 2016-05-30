<div class='headline'>
	<h1><?php echo $headline; ?></h1>
</div>

<div class='container-fluid message-container'><?php echo $message; ?></div>

<div class='container-fluid'>
	<div class='row-fluid'>
		<div class='span12 padding-top-20'>                    
            <div class='widget-box'>
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>&nbsp;</h5>
                </div><!-- end of widget-title -->
                <div class='widget-content nopadding'>
                    <?php echo form_open(get_current_route(true), array('class' => 'form-horizontal')); ?>
                    <?php 
                    echo form_control($current_password);
                    echo form_control($password);
                    echo form_control($password_confirm);
                    ?>
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- end of .widget-content -->
            </div><!-- end of .widget-box -->
		</div>
	</div>
</div>