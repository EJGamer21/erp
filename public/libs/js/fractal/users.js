Vue.component('UserForm', {
    template: '#user-form',
    data() {
        return {
            user: {
                id: '',
                index: '',
                username: '',
                firstname: '',
                lastname: '',
                email: '',
                email_id: '',
                password: '',
                retypedPassword: '',
                sex: '',
                image: '',
                direction_id: '',
                direction: {
                    province: '',
                    city: '',
                },
                fecha_creacion: '',
                fecha_modificado: '',
            },
            directions: {
                provinces: [],
                cities: [],
            }
        }
    },
    mounted() {
        axios.get('/users/getDirections')
        .then((response) => {
            let direcciones = response.data;
            Object.keys(direcciones).forEach((key) => {
                this.directions[key] = direcciones[key].sort((a, b) => {
                    if (a.nombre > b.nombre) {
                        return 1;
                    }
                    if (a.nombre < b.nombre) {
                        return -1
                    }
                    return 0;
                });
            });
        })
        .catch((error) => {
            console.log(error, error.response);
        });
        EventBus.$on('edit-user', (user) => {
            this.user = user;
            this.user.password = '';
            this.user.retypedPassword = '';
            this.user.direction = {
                province: '',
                city: '',
            }
        });
    },
    methods: {
        clearInputs() {
            Object.keys(this.user).forEach(key => this.user[key] = '');
            this.user.direction = {
                province: '',
                city: '',
            }
        },

        saveUser() {
            if (
                this.user.username === '' 
                || this.user.password === ''
                || this.user.retypedPassword === ''
                || this.user.firstname === ''
                || this.user.lastname === ''
                || this.user.sex === ''
            ) {
                this.$toastr.error('Campos no opcionales son requeridos.', 'Error', toastrConfigs);
                return;
            } 
            
            if (this.user.password !== this.user.retypedPassword){
                this.$toastr.error('Las constrase&ntilde;as deben coincidir.', 'Error', toastrConfigs);
                return;
            } 

            let userData = new FormData();
            userData.append('id', this.user.id);
            userData.append('firstname', this.user.firstname);
            userData.append('lastname', this.user.lastname);
            userData.append('username', this.user.username);
            userData.append('email', this.user.email);
            userData.append('password', this.user.password);
            userData.append('sex', this.user.sex);
            userData.append('fecha_creacion', this.user.fecha_creacion);

            swal({
                title: 'Confirmar registro',
                icon: 'warning',
                buttons: ['Cancelar', 'Confirmo'],
            })
            .then((condition) => {
                if (condition) {
                    axios({
                        url: '/users/register',
                        method: 'post',
                        data: userData,
                        responseType: 'json',
                    })
                    .then((response) => {
                        if (response.data.status === 'success') {
                            this.clearInputs();
        
                            showAlert('Notificación', response.data.message, 'success', 2000);
                            this.users.splice(0, 0, response.data.user);
        
                        } else if (response.data.status === 'info') {
                            this.clearInputs();
        
                            let updatedUser = response.data.user;
                            let existingUser = this.users.find((user) => user.id == updatedUser.id);
                            let index = this.users.indexOf(existingUser);
                            
                            this.users.splice(index, 1, updatedUser);
                            showAlert('Información', response.data.message, 'info', 2000);
                        }
                    })
                    .catch((error) => {
                        if (error.response) {
                            this.user.password = '';
                            this.user.retypedPassword = '';
        
                            this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                        }
                    });
                }
            })

        },
    }
});

Vue.component('UsersTable', {
    template: '#users-table',
    data() {
        return {
            users: [],
        }
    },
    beforeMount() {
        axios.get('/users/get')
        .then((response) => {
            let usuarios = response.data.response;
            this.users = usuarios.sort((a, b) => {
                if (a.fecha_creacion < b.fecha_creacion) {
                    return 1;
                }
                if (a.fecha_creacion > b.fecha_creacion) {
                    return -1
                }
                return 0;
            });
        })
        .catch((error) => {
            console.log(error, error.response);
        });
    },
    mounted() {

        EventBus.$on('remove-user', (user, index) => {
            this.removeUser(user, index);
        });

        EventBus.$on('toggle-user-status', (user, index) => {
            this.toggleUserStatus(user, index);
        });
    },
    methods: {
        emitEditUser(user) {
            EventBus.$emit('edit-user', user);
        },

        emitShowModal(user, index) {
            this.$emit('show-modal', user, index);
        },
        
        toggleUserStatus(user, index) {
            let message = (user.activo == '1') ? 'desactivar' : 'activar';
            swal({
                title: 'Confirmación',
                text: `¿Seguro que desea ${message} al usuario '` + user.username + `'?`,
                icon: 'warning',
                buttons: ['Cancelar', true],
            })
            .then((condition) => {
                if (condition) {
                    axios({
                        url: '/users/toggleStatus/' + user.id,
                        method: 'post',
                        data: user.id,
                        responseType: 'json'
                    })
                    .then((response) => {
                        if (this.users[index].activo == '1') {
                            this.users[index].activo = '0'
                        } else {
                            this.users[index].activo = '1'
                        }
                        this.$emit('close-modal');
                        showAlert('Información', response.data.message, 'success', 2000);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                    });
                }
            });
        },

        removeUser(user, index) {
            swal({
                title: 'Confirmación',
                text: `¿Seguro que desea borrar al usuario '` + user.username + `'?`,
                icon: 'warning',
                buttons: ['Cancelar', true],
                dangerMode: true,
            })
            .then((condition) => {
                if (condition) {
                    axios({
                        url: '/users/removeUser/' + user.id,
                        method: 'post',
                        data: user.id,
                        responseType: 'json'
                    })
                    .then((response) => {
                        console.log(response);
                        if (response.data.status === 'success') {
                            this.$emit('close-modal');
                            showAlert('Notificación', response.data.message, 'success', 2000);

                            setTimeout(() => {
                                this.users.splice(index, 1);
                            }, 300);
                        }
                    })
                    .catch((error) => {
                        if (error.response) {
                            console.log(error.response);
                            this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                        }
                    });
                }
            });
        }
    }
});

Vue.component('UserModal', {
    template: '#user-modal',
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    mounted() {
        axios.get('/users/get/' + this.user.id)
        .then((response) => {
            const user = response.data.response;
            EventBus.$emit('edit-user', user);
            // this.user.index = index;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    methods: {
        emitCloseModal() {
            this.$emit('close-modal');
        },

        emitToggleUserStatus(user, index) {
            EventBus.$emit('toggle-user-status', user, index);
        },

        emitRemoveUser(user, index) {
            EventBus.$emit('remove-user', user, index);
        },
    }
});

const EventBus = new Vue();

new Vue({
    el: '#vueapp',
    data() {
        return {
            modalIsVisible: false,
            user: {}
        }
    },
    methods: {
        showModal(user, index) {
            this.modalIsVisible = true;
            this.user = user;
            this.user.index = index;
            this.user.direction = {
                province: '',
                city: ''
            }
        },

        closeModal() {
            this.modalIsVisible = false;
        },
    }
});