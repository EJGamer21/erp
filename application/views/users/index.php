<div id="vueapp">
    <h1 class="my-4">Usuarios</h1>
    <user-form></user-form>
    <users-table @show-modal="showModal"></users-table>
    <user-modal v-if="modalIsVisible" 
        :user="user"
        @close-modal="closeModal"
    ></user-modal>
</div>

<script type="text/x-template" id="user-form">
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <template v-if="user.id !== ''">
                <span>Editar usuario</span>
            </template>
            <template v-else>
                <span>Registrar usuario</span>
            </template>
        </div>
        <div class="card-body bg-light">
            <form method="POST" 
                action="/users/register" 
                enctype="multipart/form-data"
                @submit.prevent class="form">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" 
                                    type="text" 
                                    name="firstname" 
                                    v-model="user.firstname" 
                                    autofocus 
                                    required
                            >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input class="form-control" 
                                    type="text" 
                                    name="lastname" 
                                    v-model="user.lastname" 
                                    required
                            >
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nombre de usuario</label>
                            <input class="form-control" 
                                    type="text" 
                                    id="username" 
                                    name="username" 
                                    v-model="user.username" 
                                    autocomplete="username"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>
                                <span>Correo electr&oacute;nico</span>
                                <small class="text-muted">
                                    <i>Opcional</i>
                                </small>
                            </label>
                            <input class="form-control" 
                                    type="email" 
                                    name="email" 
                                    v-model="user.email"
                            >
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label id="password-label">Contrase&ntilde;a</label>
                            <input class="form-control" 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    v-model="user.password" 
                                    autocomplete="password"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label id="retyped-password-label">Repetir Contrase&ntilde;a</label>
                            <input class="form-control" 
                                    type="password" 
                                    id="retyped-password" 
                                    v-model="user.retypedPassword"
                                    required
                            >
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Sexo</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input id="m-radio" 
                                        type="radio" 
                                        name="sex" 
                                        class="custom-control-input" 
                                        value="M" 
                                        v-model="user.sex" 
                                        required
                                >
                                <label for="m-radio" 
                                        class="custom-control-label"
                                >
                                    Masculino
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input id="f-radio" 
                                        type="radio" 
                                        name="sex" 
                                        class="custom-control-input" 
                                        value="F" 
                                        v-model="user.sex" 
                                        required
                                >
                                <label for="f-radio" 
                                        class="custom-control-label"
                                >
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                            <label>
                                <span>Direcci&oacute;n</span>
                                <small class="text-muted">
                                    <i>Opcional</i>
                                </small>
                            </label>
                        <div class="form-row">
                            <div class="mb-2 col d-sm-block d-lg-inline">
                                <select class="custom-select"
                                        v-model="user.direction.city">
                                        <option value="" selected hidden>Seleccionar ciudad...</option>
                                    <optgroup v-for="province in directions.provinces" 
                                                :label="province.nombre">
                                        <option v-for="city in directions.cities"
                                                v-if="city.provincia_id == province.provincia_id"
                                                :value="city.ciudad_id">
                                            <span>{{ city.nombre }}</span>
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr"></div>
                <div class="form-row">
                    <div class="mb-2 col d-sm-block d-lg-inline">
                        <label>
                            <span>Foto de perfil</span>
                            <small class="text-muted">
                                <i>Opcional</i>
                            </small>
                        </label>
                        <input class="form-control-file" 
                                type="file" 
                                accept="image/*" 
                                name="image">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 offset-8">
                        <div class="float-right">
                            <button id="clear-btn"
                                    type = "button"
                                    title="Limpiar campos"
                                    class="btn btn-link"
                                    @click="clearInputs()">
                                <span>Limpiar</span>
                            </button>
                            <button id="submit-btn"
                                    type = "submit"
                                    title="Registrar usuario"
                                    class="btn btn-success"
                                    @click="saveUser()">
                                <template v-if="user.id !== ''">
                                    <span>Guardar</span>
                                </template>
                                <template v-else>
                                    <span>Registrar</span>
                                </template>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</script>

<script type="text/x-template" id="users-table">
    <div class="table-responsive mt-4" v-cloak>
        <table id="users-table"
                class="table table-striped table-hover centered">
            <caption>Listado de usuarios</caption>
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Creaci&oacute;n</th>
                    <th style="text-align:center;">
                        <i class="fas fa-bars"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :id="user.id">
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()">
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
                            (user.firstname + '-' + user.lastname).toLowerCase()">
                            <span>{{ user.firstname + ' ' + user.lastname }}</span>
                        </a>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()">
                            <span>{{ user.email }}</span>
                        </a>
                    </td>
                    <td>
                        <a :href="'/users/view/' + user.id + '/' + 
                            (user.firstname + '-' + user.lastname).toLowerCase()">
                            <span>{{ user.fecha_creacion }}</span>
                        </a>
                    </td>
                    <td style="text-align:center;">
                        <button title="Editar usuario"
                                type="button" 
                                class="edit-btn btn btn-info"
                                @click="emitEditUser(user)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <template v-if="user.activo == 1">
                            <button title="Desactivar usuario"
                                    type="button" 
                                    class="btn btn-outline-danger"
                                    @click="toggleUserStatus(user, index)">
                                <i class="fas fa-user-times"></i>
                            </button>
                        </template>
                        <template v-else>
                            <button title="Activar usuario"
                                    type="button" 
                                    class="btn btn-outline-success"
                                    @click="toggleUserStatus(user, index)">
                                <i class="fas fa-user-check"></i>
                            </button>
                        </template>
                        <button type="button" 
                                title="Ver usuario"
                                class="btn btn-dark"
                                @click="emitShowModal(user, index)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</script>

<script type="text/x-template" id="user-modal">
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="emitCloseModal">
                <div class="modal-container">
                    <div class="card bg-light my-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <template v-if="user.image !== null">
                                    <img :src="user.image" class="card-img" alt="No image">
                                </template>
                                <template v-else>
                                    <img src="/public/images/users/no_picture.png" class="card-img"  alt="No image">
                                </template>
                            </div>
                            <div class="col-md-8">
                                <button title="Cerrar"
                                        class="float-right btn btn-light"
                                        @click="emitCloseModal">
                                    <span><i class="fas fa-times"></i></span>
                                </button>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <span>{{ user.firstname + ' ' + user.lastname}}</span>
                                        <div class="mb-2">
                                            <span class="badge badge-secondary">{{ user.rol }}</span>
                                        </div>
                                    </h3>
                                        
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>ID:</strong> 
                                            <span>{{ user.id }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Usuario:</strong> 
                                            <span>{{ user.username }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Email:</strong> 
                                            <span>{{ user.email }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Sexo:</strong>
                                            <template v-if="user.sexo == 'M'">
                                                <span>Masculino</span>
                                            </template>
                                            <template v-else>
                                                <span>Femenino</span>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Dirección:</strong> 
                                            <span>{{ user.direction.city }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Creado en:</strong> 
                                            <span>{{ user.fecha_creacion }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <strong>Última modificación:</strong> 
                                            <span>{{ user.fecha_modificado }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Estado:</strong>
                                            <template v-if="user.activo == 1">
                                                <span>Activo</span>
                                            </template>
                                            <template v-else>
                                                <span>Inactivo</span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <div class="float-left">
                                        <template v-if="user.activo == 1">
                                            <button title="Desactivar usuario"
                                                    type="button" 
                                                    class="btn btn-outline-danger"
                                                    @click="emitToggleUserStatus(user, user.index)">
                                                <span>Desactivar</span>
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button title="Activar usuario"
                                                    type="button" 
                                                    class="btn btn-outline-success"
                                                    @click="emitToggleUserStatus(user, user.index)">
                                                <span>Activar</span>
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </template>
                                        <button class="btn btn-danger"
                                                type="button"
                                                title="Borrar usuario"
                                                @click="emitRemoveUser(user, user.index)">
                                            <span>Borrar</span>
                                        </button>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-secondary"
                                                @click="emitCloseModal">
                                            <span>Cerrar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</script>

<script src="/public/libs/js/fractal/users.js"></script>