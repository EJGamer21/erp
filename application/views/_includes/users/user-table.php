<?php if (isset($users)): ?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
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
                    <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->firstname.'-'.$user->lastname) ?>">
                        <?= $user->username ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->firstname.'-'.$user->lastname) ?>">
                        <?= $user->firstname.' '.$user->lastname ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->firstname.'-'.$user->lastname) ?>">
                        <?= $user->email ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->firstname.'-'.$user->lastname) ?>">
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
<?php 
    else: 
        show_404();
    endif;
?>