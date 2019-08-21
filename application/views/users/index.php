<div id="vueapp">
    <h1 class="my-4">Usuarios</h1>
    
    <?php
        $this->view('_includes/users/user-form');
        if (isset($users)): 
    ?>
    <div class="table-responsive mt-4" v-cloak>
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
                <tr v-for="(user, index) in users" :id="user.id">
                    <td :data-user-id="user.id" class="d-none">{{ user.id }}</td>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()"
                        >
                            <template v-if="user.activo == 1">
                                <span title="Activo" class="badge badge-success">
                                    <i class="fas fa-user-check"></i>
                                </span>
                            </template>
                            <template v-else>
                                <span title="Inactivo" class="badge badge-danger">
                                    <i class="fas fa-user-times"></i>
                                </span>
                            </template>
                            <span>{{ user.username }}</span>
                        </a>
                    </td>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()"
                        >
                            <span>{{ user.firstname + ' ' + user.lastname }}<span>
                        </a>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()"
                        >
                            <span>{{ user.email }}</span>
                        </a>
                    </td>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()"
                        >
                            <span>{{ user.fecha_creacion }}</span>
                        </a>
                    </td>
                    <td style="text-align:center;">
                        <button :data-id="user.id"
                                title="Editar usuario"
                                type="button" 
                                class="edit-btn btn btn-info"
                                @click="editUser(user)"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <!-- <button :data-id="user.id" 
                                type="button" 
                                title="Borrar usuario"
                                class="btn btn-danger" 
                                @click="removeUser(user, index)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button> -->
                        <template v-if="user.activo == 1">
                            <button :data-id="user.id"
                                    title="Desactivar usuario"
                                    type="button" 
                                    class="btn btn-outline-danger"
                                    @click="toggleUserStatus(user, index)"
                            >
                                    <i class="fas fa-user-times"></i>
                            </button>
                        </template>
                        <template v-else>
                            <button :data-id="user.id"
                                    title="Activar usuario"
                                    type="button" 
                                    class="btn btn-outline-success"
                                    @click="toggleUserStatus(user, index)"
                            >
                                <i class="fas fa-user-check"></i>
                            </button>
                        </template>
                    </td>
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
    let direcciones = <?= json_encode($directions);?>;
</script>
<script src="/public/libs/js/fractal/users.js"></script>