<div class='headline'>
    <h1><?php echo $headline; ?></h1>
    <div class="btn-group">
        <?php
        echo anchor(backend_current_route(), '<i class="icon-chevron-left"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Regresar'));
        echo anchor(backend_current_route() . 'add', '<i class="icon-plus"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Agregar nuevo'));
        ?>
    </div>
</div>

<div id='breadcrumb'><?php echo $breadcrumb; ?></div>
<div class='container-fluid message-container'><?php echo $message; ?></div>
<div class='container-fluid'>
    <div class='row-fluid'>
        <div class='span12'>
            <div class='widget-box'>
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>&nbsp;</h5>
                </div><!-- end of widget-title -->
                <div class='widget-content nopadding'>
                    <?php echo form_open(backend_current_route(true) . $record->id_contacto, array('class' => 'form-horizontal')); ?>
                    <?php
                    echo form_control($informacion);
                    echo form_control($youtube);
                    echo form_control($lat);
                    echo form_control($lng);
                    echo form_control($facebook);
                    echo form_control($twitter);
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
