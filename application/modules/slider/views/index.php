<div class='headline'>
    <h1><?php echo $headline; ?></h1>
    <div class="btn-group">
        <?php echo anchor(get_current_route() . 'add', '<i class="icon-plus"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Agregar Nuevo')); ?>
    </div>
</div>

<div class='container-fluid message-container'>
    <?php echo $message; ?>
</div>

<div class='container-fluid'>
    <div class='row-fluid'>
        <div class='search'>
            <?php echo form_open(get_current_route(true), array('class' => 'form-inline', 'method' => 'get', 'id' => 'frm-search')); ?>
            <label class="control-label" for="name">Nombre</label>
            <div class='input-append'>
                <?php echo form_input($nombre); ?>
                <button type="submit" class="btn"><i class='icon-search'></i> Buscar</button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- End of .search -->
    </div><!-- End of .row-fluid -->

    <div class='row-fluid'>
        <div class='span12'>
            <?php if (!empty($rs) && $rs !== FALSE) : ?>
                <div class='widget-box'>
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>&nbsp;</h5>
                    </div><!-- end of widget-title -->
                    <div class='widget-content nopadding'>
                        <table class='table table-striped table-bordered table-hover table-condensed'>
                            <thead>
                                <tr>
                                    <th class='first'>Imagen</th>
                                    <th>Titulo</th>
                                    <th>Miami</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rs as $key => $value) : ?>
                                <tr class="info">            
                                        <td><?php echo !empty($value->imagen) ? img('uploads/slider/48x48_'.$value->imagen):''?></td>
                                        <td><?php echo $value->titulo; ?></td>
                                        <td>
                                        <input type="checkbox" id="store-status" data-id="<?php if ($this->flexi_auth->is_admin()){echo $value->id_slider;}?>" <?php echo ($value->status) ? 'checked' : ''; ?> >
                                    </td>
                                        <td class='td-action'>
                                            <?php echo anchor(get_current_route() . 'edit/' . $value->id_slider, '<span><i class="icon-edit"></i></span>', array('class' => 'btn btn-small edit-button tip', 'title' => 'Editar')); ?>
                                            <?php echo anchor(get_current_route() . 'delete/' . $value->id_slider, '<span><i class="icon-remove"></i></span>', array('class' => 'btn btn-small delete-button tip', 'title' => 'Eliminar')); ?>

                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- end of .widget-content -->
                </div><!-- end of .widget-box -->
            <?php else : ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    No se encontraron registros
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>