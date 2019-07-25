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
        <table id="users-table" class="table table-striped table-hover">
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
    let username = $('#username');
    let passwd = $('#password');
    let repasswd = $('#retyped-password');
    let submitBtn = $('#submit-btn');

    $(document).ready(function() {
        $('#province').select2({
            placeholder: 'Provincia...'
        }),
        $('#city').select2({
            placeholder: 'Ciudad...'
        }),
        $('#sector').select2({
            placeholder: 'Sector...'
        }),
        $('#users-table').DataTable({
            "order": [
                [3, 'desc'],
                [0, 'asc']
            ],
            "columnDefs": [
                { "orderable": false, "targets": 4}
            ],
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        })
    });

    submitBtn.on('click', () => {
        if (username.val() == "" && passwd.val() == "") {
            toastr["error"]('Campos no opcionales son requeridos', "Error");
            return;
        }
    });

    userForm.submit((event) => {
        event.preventDefault();

        submitBtn.attr('disabled', 'disabled');
        let formData = userForm.serialize();

        $.ajax({
            url: "/users/register",
            type: "POST",
            data: formData,
            dataType: 'json'
        })
        .done((response) => {
            console.log(response);
            toastr[response.status](response.message, "Notificaci&oacute;n");
            
            if (response.status == 'success') {
                userForm.trigger('reset');
                submitBtn.removeAttr('disabled');
            } else {
                passwd.val('');
                repasswd.val('');
                submitBtn.removeAttr('disabled');
            }                
        })
        .fail((jqXHR, textStatus, error) => {
            toastr["error"]("Error 500: Error interno del servidor", "Error");

            submitBtn.removeAttr('disabled');
        });
    });    

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>