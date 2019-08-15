<div class="card mb-4">
    <div class="card-header bg-dark text-white">Registrar nuevo usuario</div>
    <div class="card-body bg-light">
        <form id="user-form" method="POST" @submit.prevent class="form">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="firstname" v-model="user.firstname" autofocus required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Apellido</label>
                        <input class="form-control" type="text" name="lastname" v-model="user.lastname" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label>Nombre de usuario</label>
                        <input class="form-control" type="text" id="username" name="username" v-model="user.username" autocomplete required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Correo electr&oacute;nico <small class="text-muted"><i>Opcional</i></small></label>
                        <input class="form-control" type="email" name="email" v-model="user.email" autocomplete>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label>Contrase&ntilde;a</label>
                        <input class="form-control" type="password" id="password" name="password" v-model="user.password" autocomplete required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Repetir Contrase&ntilde;a</label>
                        <input class="form-control" type="password" id="retyped-password" v-model="user.retypedPassword" autocomplete required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label class="d-block">Sexo</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="m-radio" type="radio" name="sex" class="custom-control-input" value="M" v-model="user.sex" required>
                            <label for="m-radio" class="custom-control-label">Masculino</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="f-radio" type="radio" name="sex" class="custom-control-input" value="F" v-model="user.sex" required>
                            <label for="f-radio" class="custom-control-label">Femenino</label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label class="d-block">Direcci&oacute;n <small class="text-muted"><i>Opcional</i></small></label>
                    <div class="form-row">
                        <div class="mb-2 col d-sm-block d-lg-inline">
                            <select class="custom-select" name="province" v-model="user.direction.province">
                                <option>Provincia...</option>
                                <option v-for="(province, index) in directions.provinces" 
                                        :value="province.provincia_id"
                                >{{ province.nombre }}</option>
                            </select>
                        </div>
                        <div class="mb-2 col d-sm-block d-lg-inline">
                            <select class="custom-select" name="city" v-model="user.direction.city">
                                <option selected>Ciudad...</option>
                                <option v-for="(city, index) in directions.cities" 
                                        :value="city.ciudad_id"
                                >{{ city.nombre }}</option>
                            </select>
                        </div>
                        <div class="mb-2 col d-sm-block d-lg-inline">
                            <select class="custom-select" name="sector" v-model="user.direction.sector">
                                <option selected disabled hidden>Sector...</option>
                                <option v-for="(sector, index) in directions.sectors"
                                        :value="sector.sector_id"
                                >{{ sector.nombre }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-2 offset-10 px-0">
                    <button id="submit-btn"
                            type = "submit"
                            class="btn btn-block btn-success"
                            @click="saveUser()"
                    >Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>