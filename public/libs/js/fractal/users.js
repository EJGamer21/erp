const app = new Vue({
    el: '#vueapp',
    data() {
        return {
            user: {
                id: '',
                username: '',
                firstname: '',
                lastname: '',
                email: '',
                email_id: '',
                password: '',
                retypedPassword: '',
                sex: '',
                direction_id: '',
                direction: {
                    province: '',
                    city: '',
                    sector: ''
                },
                fecha_creacion: ''
            },
            users: [],
            directions: {
                provinces: [],
                cities: [],
                sectors: []
            }
        }
    },
    mounted() {
        this.users = usuarios.sort((a, b) => {
            if (a.fecha_creacion < b.fecha_creacion) {
                return 1;
            }
            if (a.fecha_creacion > b.fecha_creacion) {
                return -1
            }
            return 0;
        });
        this.directions = direcciones;
    },
    methods: {
        editUser(user) {
            this.user.id = user.id;
            this.user.firstname = user.firstname;
            this.user.lastname = user.lastname;
            this.user.username = user.username;
            this.user.email = (user.email === null) ? '' : user.email;
            this.user.email_id = user.email_id;
            this.user.sex = user.sexo;
            this.user.fecha_creacion = user.fecha_creacion;
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
                this.$toastr.error('Campos no opcionales son requeridos', 'Error', toastrConfigs);
                return;
            } 
            
            if (this.user.password !== this.user.retypedPassword){
                this.$toastr.error('Las constrase&ntilde;as deben coincidir', 'Error', toastrConfigs);
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

                    let newUser = response.data.user;
                    let existingUser = this.users.find((user) => user.id == newUser.id);
                    let index = this.users.indexOf(existingUser);
                    
                    this.users.splice(index, 1, newUser);
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
        },

        clearInputs() {
            Object.keys(this.user).forEach((key) => {
                if ((typeof this.user[key]) === 'object' && this.user[key] !== null) {
                    Object.keys(this.user[key]).forEach((key2) => {
                        this.user[key][key2] = '';
                        this.user[key] = '';
                    });
                }
            });
        //   for ((attr in this.user) {
        //       if ((typeof this.user[attr]) === 'object' && this.user[attr] !== null) {
        //           for (attr2 in this.user[attr]) {
        //               this.user[attr][attr2] = ''
        //           }
        //           continue;
        //       }
        //       this.user[attr] = ''
        //   }
        },

        toggleUserStatus(user, index) {
            let message = (user.activo == '1') ? 'desactivar' : 'activar';
            swal({
                title: 'Confirmación',
                text: `¿Seguro que desea ${message} al usuario '` + user.username + `'?`,
                icon: 'warning',
                buttons: true,
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
                        showAlert('Información', response.data.message, 'success', 2000);
                    })
                    .catch((error) => {
                        this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                        console.log(error.response);
                    });
                }
            });
        },
        
        removeUser(user, index) {
            swal({
                title: 'Confirmación',
                text: `¿Seguro que desea borrar al usuario '` + user.username + `'?`,
                icon: 'warning',
                buttons: true,
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

function showAlert(title, text, icon, time = null) {
    swal({
        title: title,
        text: text,
        icon: icon,
        timer: time,
    });
}

// Move to top
let toastrConfigs = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar":  true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "600",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}