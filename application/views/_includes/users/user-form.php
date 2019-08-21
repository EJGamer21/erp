<template id="user-form">
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">{{ formTitle }}</div>
        <div class="card-body bg-light">
            <form method="POST" action="/users/register" @submit.prevent class="form">
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
                                    autocomplete 
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
                                    autocomplete
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
                                    autocomplete 
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
                                    autocomplete 
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
                                <v-selectpage
                                    :data="directions.provinces"
                                    :pagination="false"
                                    show-field="nombre"
                                    key-field="provincia_id"
                                    v-model="user.direction.province"
                                    title="Provincias"
                                    placeholder="Provincia..."
                                ></v-selectpage>
                            </div>
                            <div class="mb-2 col d-sm-block d-lg-inline">
                                <v-selectpage
                                    :data="directions.cities"
                                    :pagination="false"
                                    show-field="nombre"
                                    key-field="ciudad_id"
                                    v-model="user.direction.city"
                                    title="Ciudades"
                                    placeholder="Ciudad..."
                                ></v-selectpage>
                            </div>
                            <div class="mb-2 col d-sm-block d-lg-inline">
                                <v-selectpage
                                    :data="directions.sectors"
                                    :pagination="false"
                                    show-field="nombre"
                                    key-field="sector_id"
                                    v-model="user.direction.sector"
                                    title="Sectores"
                                    placeholder="Sector..."
                                ></v-selectpage>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 offset-8">
                        <div class="float-right">
                            <button id="clear-btn"
                                    type = "button"
                                    title="Limpiar campos"
                                    class="btn btn-link"
                                    @click="clearInputs()"
                            >
                                <span>Limpiar</span>
                            </button>
                            <button id="submit-btn"
                                    type = "submit"
                                    title="Registrar usuario"
                                    class="btn btn-success"
                                    @click="saveUser()"
                            >
                                <span>{{ buttonText }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>