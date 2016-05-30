<div class="row-fluid">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class='headline'>
            <h1><?php echo $headline; ?></h1>
            <div class="btn-group">
                <?php echo anchor(backend_current_route() . 'add', '<i class="glyphicon glyphicon-plus"></i>', array('class' => 'btn btn-primary', 'title' => 'Agregar Nuevo')); ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class='message-container'>
            <?php echo $message; ?>
        </div>
    </div>
</div>
<div class='row-fluid'>
    <div class='col-lg-12 col-md-12 col-xs-12'>
        <?php if (!empty($rs) && $rs !== FALSE) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <span class="icon"><i class="glyphicon glyphicon-align-justify"></i></span> </h3>
                </div>
                <div class="table-responsive">
                    <table class='table table-striped table-bordered table-hover table-condensed'>
                        <thead>
                            <tr>
                                <th class='first'>Imagén</th>
                                <th>Titulo</th>
                                <th>Promoción</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 0; ?>
                            <?php foreach ($rs as $key => $value) : ?>
                                <tr>
                                    <td class='first'>
                                        <?php echo img(array('src' => 'uploads/promotion/48x48_' . $value->image, 'class' => 'img-responsive')); ?>
                                    </td>
                                    <td><?php echo $value->title; ?></td>
                                    <td><?php echo word_limiter(filter_var($value->description, FILTER_SANITIZE_STRING),10); ?></td>
                                    <td class='td-action'>
                                        <div class="btn-group" role="group" >
                                            <?php echo anchor(backend_current_route() . 'edit/' . $value->promotion_id, '<span><i class="glyphicon glyphicon-edit"></i></span>', array('class' => 'btn btn-default btn-sm edit-button tip', 'title' => 'Editar')); ?>
                                            <?php echo anchor(backend_current_route() . 'delete/' . $value->promotion_id, '<span><i class="glyphicon glyphicon-remove"></i></span>', array('class' => 'btn btn-danger btn-sm delete-button tip', 'title' => 'Eliminar')); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>       
        <?php else : ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                No se encontraron registros
            </div>
        <?php endif; ?>
    </div>
</div>