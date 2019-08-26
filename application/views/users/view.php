<div id="vueapp" v-cloak>
    <div class="card bg-light my-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <template v-if="user.image !== null">
                    <img :src="user.image" class="card-img" alt="No image">
                </template>
                <template v-else>
                    <img src="/public/images/users/no_picture.png" class="card-img"  alt="">
                </template>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">
                        <span>{{ user.firstname + ' ' + user.lastname}}</span>
                        <span class="badge badge-secondary">{{ user.rol }}</span>
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
                            <span>{{ user.direction }}</span>
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
    </div>
</div>



<script>
    const userId = <?= $userId ?>;
    const app = new Vue({
        el: '#vueapp',
        data() {
            return {
                user: {},
            }
        },
        mounted() {
            axios.get('/users/get/' + userId, {
                responseType: 'json'
            })
            .then((response) => {
                const user = response.data.response;
                this.user = user;
            })
            .catch((error) => {
                console.log(error);
            });
        },        
    });
</script>