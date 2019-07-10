<div>
    <h1 class="my-4">Usuarios</h1>
    <div class="card mb-4">
        <div class="card-header">
            Registrar producto
        </div>
        <div class="card-body">
            <form class="form" action="#" method="POST">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="firstname" placeholder="John" autofocus>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input class="form-control" type="text" name="lastname" placeholder="Doe">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nombre de usuario</label>
                            <input class="form-control" type="text" name="username" placeholder="John_doe01">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Correo electr&oacute;nico</label>
                            <input class="form-control" type="text" name="email" placeholder="jhondoe@example.com">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Contrase&ntilde;a</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="**********">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Confirmar Contrase&ntilde;a</label>
                            <input class="form-control" type="password" id="retyped-password" placeholder="**********">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Sexo</label><br/>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">M</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">F</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label>Direcci&oacute;n</label><br/>
                        <div class="form-group">
                            <select class="form-control" type="text" name="province">
                            <?php foreach ($users as $user): ?>
                                <option><?=$user->nombre?></option>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="city">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="sector">
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div>
        <table class="table table-striped table-hover table-responsive-lg">
            <caption>Listado de usuarios</caption>
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Creaci&oacute;n</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                            <?= $user->username ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                            <?= $user->nombre.' '.$user->apellido ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                            <?= $user->email ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                            <?= $user->fecha_creacion ?>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-warning">Edit <?=$user->id ?></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>