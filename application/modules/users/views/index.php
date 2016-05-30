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
        <div class='span12'>
            <?php if (!empty ($rs) && $rs !== FALSE) : ?>
            <div class='widget-box'>
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>&nbsp;</h5>
                </div><!-- end of widget-title -->
                <div class='widget-content nopadding'>
                    <table class='table table-striped table-bordered table-hover table-condensed'>
                        <thead>
                            <tr>
                                <th class='first'>ID</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $c=0; ?>
                        <?php foreach ($rs as $key => $value) : ?>
                            <tr class='<?php echo ($c++%2 == 1) ? 'even' : 'odd'; ?> <?php echo ($value->uacc_id == 1) ? 'superuser' : ''; ?>'>
                                <td class='first'><?php echo $value->uacc_id; ?></td>
                                <td><?php echo $value->uacc_username; ?></td>
                                <td><?php echo $value->uacc_first_name; ?></td>
                                <td><?php echo $value->uacc_last_name; ?></td>
                                <td><?php echo $value->uacc_email; ?></td>
                                <td class='td-action'>
                                    <div class="btn-group">
                                    <?php if ($value->uacc_id == 1) : ?>
                                    <?php echo anchor(get_current_route().'edit/'.$value->uacc_id, '<span><i class="icon-edit"></i></span>', array('class' => 'btn btn-small edit-button tip', 'title' => 'Editar')); ?>
                                    <?php else: ?>
                                    <?php echo anchor(get_current_route().'edit/'.$value->uacc_id, '<span><i class="icon-edit"></i></span>', array('class' => 'btn btn-small edit-button tip', 'title' => 'Editar')); ?>
                                    <?php echo anchor(get_current_route() . 'delete/'. $value->uacc_id, '<span><i class="icon-remove"></i></span>', array('class' => 'btn btn-small delete-button tip', 'title' => 'Eliminar')); ?>
                                    <?php endif;?>
                                    </div>
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