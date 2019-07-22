<?php 
    $CI =& get_instance();
?>

<div>
    <h1 class="my-4">Usuarios</h1>
    
    <?php
        $this->view('_includes/users/user-form');
        if (isset($users)): 
    ?>

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
</div>
<script>
    let userForm = $('form#user-form');

    $(document).ready(function() {
        $('#province').select2({
            placeholder: 'Provincia...'
        }),
        $('#city').select2({
            placeholder: 'Ciudad...'
        }),
        $('#sector').select2({
            placeholder: 'Sector...'
        })
    });

    userForm.submit((event) => {
        event.preventDefault();
        let formData = userForm.serialize();

        $.ajax({
            url: "/users/register",
            type: "POST",
            data: formData
        })
        .done((res) => {
            console.log(res);
        })
        .fail((jqXHR, textStatus) => {
            console.error( "Request failed: " + textStatus );
        });
    });
</script>