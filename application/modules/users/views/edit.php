<div class='headline'>
    <h1><?php echo $headline; ?></h1>
    <div class="btn-group">
        <?php
        echo anchor(get_current_route(), '<i class="icon-chevron-left"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Regresar'));
        echo anchor(get_current_route() . 'add', '<i class="icon-plus"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Agregar nuevo'));
        ?>
    </div>
</div>

<div id='breadcrumb'><?php echo $breadcrumb; ?></div>

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
                    <?php echo form_open_multipart(get_current_route(true) . $record->uacc_id, array('class' => 'form-horizontal')); ?>
                    <?php
                    echo form_control($group);
                    echo form_control($id_plaza);
                    echo form_control($first_name);
                    echo form_control($last_name);
                    echo form_control($email);
                    echo form_control($phone);
                    echo form_control($cel_phone);
                    echo form_control($username);
                    echo form_control($password);
                    echo form_control($password_confirm);
                    echo form_control($image);
                    ?>
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <?php echo anchor(get_current_route(), 'Cancelar', array('class' => 'btn')); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- end of .widget-content -->
            </div><!-- end of .widget-box -->
        </div>
    </div>
</div>