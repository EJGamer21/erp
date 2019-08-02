<?php 
    $CI =& get_instance();
?>

<div id="vueapp">
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
                <tr v-for="user in users">
                    <td class="d-none">{{ user.id }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.firstname + ' ' + user.lastname }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.fecha_creacion }}</td>
                    <td>{{ user.id }}</td>
                </tr>
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
    let usuarios = <?= json_encode($users);?>;
</script>
<script src="/public/libs/js/fractal/users.js"></script>