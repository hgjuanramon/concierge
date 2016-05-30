<div class='row'>
	<div class="vcenter-outer">
        <div class="vcenter-middle">
            <div class='vcenter-inner'>
                <div class='vcenter-content' id='login-box'>
                    <?php echo img('assets/img/Hello-House-logo.png'); ?>
                    <?php echo $message; ?>
                    <?php echo form_open('admin/login', array('class' => 'form', 'id' => 'frm-login')); ?>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class='icon-user'></i></span>
                                <input type="text" id="username" required placeholder="Usuario" name='username' class='textbox'>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class='icon-lock'></i></span>
                                <input type="password" id="password" required placeholder="Password" name='password' class='textbox'>
                            </div>
                        </div>
                    </div>
                    <div class='text-center'><button type="submit" class="btn btn-primary"><i class='icon-share-alt icon-white'></i> Entrar </button></div>
                    <?php echo form_close(); ?>
                </div><!-- End of #login-box.vcenter-content -->
            </div><!-- End of .vcenter-inner -->
        </div><!-- End of .vcenter-middle -->
    </div><!-- End of -vcenter-outer -->
</div>