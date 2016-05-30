<div class='headline'>
    <h1><?php echo $headline; ?></h1>
    <div class="btn-group">
        <?php echo anchor(backend_current_route() . 'add', '<i class="icon-plus"></i>', array('class' => 'btn btn-large tip-bottom', 'title' => 'Agregar Nuevo')); ?>
    </div>
</div>

<div class='container-fluid message-container'>
    <?php echo $message; ?>
</div>

<div class='container-fluid'>   
    <div class='row-fluid'>
        <div class='span12'>
            <?php if (!empty($rs) && $rs !== FALSE) : ?>
                <div class='widget-box'>
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>&nbsp;</h5>
                    </div><!-- end of widget-title -->
                    <div class='widget-content nopadding' style=" overflow-y: scroll;">
                        <table class='table table-striped table-bordered table-hover table-condensed'>
                            <thead>
                                <tr>
                                    
                                    <th class='first'>Información</th>
                                    <th>Telefono</th>
                                    <th>Facebook</th>
                                    <th>Twitter</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rs as $key => $value) : ?>
                                    <tr class="info">                                                  
                                        <td><?php echo word_limiter(filter_var($value->informacion, FILTER_SANITIZE_STRING), 15); ?></td>
                                        <td><?php echo $value->youtube ;?></td>
                                        <td><?php echo character_limiter(filter_var($value->facebook, FILTER_SANITIZE_STRING), 15); ?></td>
                                        <td><?php echo character_limiter(filter_var($value->twitter, FILTER_SANITIZE_URL), 15); ?></td>
                                        <td class='td-action'>
                                            <?php echo anchor(backend_current_route() . 'edit/' . $value->id_contacto, '<span><i class="icon-edit"></i>Editar</span>', array('class' => 'btn btn-small edit-button tip', 'title' => 'Editar')); ?>
                                            <?php echo anchor(backend_current_route() . 'delete/' . $value->id_contacto, '<span><i class="icon-remove"></i>Eliminar</span>', array('class' => 'btn btn-small delete-button tip', 'title' => 'Eliminar')); ?>
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
        <?php echo $links; ?>
    </div>
</div>