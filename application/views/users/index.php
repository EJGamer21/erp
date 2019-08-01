<?php 
    $CI =& get_instance();
?>

<div>
    <h1 class="my-4">Usuarios</h1>
    
    <?php
        $this->view('_includes/users/user-form');
        if (isset($users)): 
    ?>

    <div class="table-responsive my-4 mr-4">
        <table id="users-table" class="table table-striped table-hover centered">
        <caption>Listado de usuarios</caption>
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Creaci&oacute;n</th>
                    <th style="text-align:center;"><i class="fas fa-bars"></i></th>
                </tr>
            </thead>
            <tbody>
                <!-- Add viewFormatter -->
                <?php foreach ($users as $user): ?>
                <tr id="<?= $user->id ?>">
                    <td>
                        <a href="<?= base_url('users/view/').$user->id.'/'.strtolower($user->firstname.'-'.$user->lastname) ?>">
                            <?php if ($user->activo == 1): ?>
                                <span class="badge badge-success"><i class="fas fa-user-check"></i></span>
                            <?php else: ?>
                                <span class="badge badge-danger"><i class="fas fa-user-times"></i></span>
                            <?php endif; ?>
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
                    <td style="text-align:center;">
                        <button data-id="<?= $user->id ?>" type="button" class="delete-btn btn btn-danger" onclick="removeRow(this)">
                            <i class="fas fa-trash-alt"></i>
                        </button>
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
</div>
<script>
    let users = <?= json_encode($users);?>;
</script>
<script src="/public/libs/js/fractal/users.js"></script>