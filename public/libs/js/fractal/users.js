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
        this.users = usuarios;
        this.directions = direcciones;
    },
    methods: {
        editUser(user) {
            this.user.id = user.id;
            this.user.firstname = user.firstname;
            this.user.lastname = user.lastname;
            this.user.username = user.username;
            this.user.email = user.email;
            this.user.email_id = user.email_id;
            this.user.sex = user.sexo;
            this.user.fecha_creacion = user.fecha_creacion;
        },

        saveUser() {
            toastrConfigs.preventDuplicates = true;
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
                console.log(response);
                if (response.data.status === 'success') {
                    // TODO: Check when it is an update or an insert
                    // if (response.data.)
                    this.$toastr.success(response.data.message, 'Notificaci&oacute;n', toastrConfigs);
                    this.users.push(response.data.user);
                    this.clearInputs();
                }               
            })
            .catch((error) => {
                if (error.response) {
                    this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                    this.user.password = '';
                    this.user.retypedPassword = '';
                }          
            });
        },

        clearInputs() {
          for ((attr) in this.user) {
              if ((typeof this.user[attr]) === 'object' && this.user[attr] !== null) {
                  for (attr2 in this.user[attr]) {
                      this.user[attr][attr2] = ''
                  }
                  continue;
              }
              this.user[attr] = ''
          }
        },

        toggleUserStatus(user, index) {
            let message = (user.activo == '1') ? 'desactivar' : 'activar';
            if (confirm(`¿Seguro que desea ${message} al usuario ` + user.username + '?')) {
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
                    this.$toastr.info(response.data.message, 'Informaci&oacute;n', toastrConfigs);
                })
                .catch((error) => {
                    this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                    console.log(error.response);
                });
            }
        },
        
        removeUser(user, index) {
            toastrConfigs.preventDuplicates = false;
            if (confirm('¿Seguro que desea borrar al usuario ' + user.firstname + ' ' + user.lastname + '?')) {
                axios({
                    url: '/users/removeUser/' + user.id,
                    method: 'post',
                    data: user.id,
                    responseType: 'json'
                })
                .then((response) => {
                    console.log(response);
                    if (response.data.status === 'success') {
                        this.$toastr.success(response.data.message, 'Notificaci&oacute;n', toastrConfigs);
                        setTimeout(() => {
                            this.users.splice(index, 1);
                        }, 300);
                    }
                })
                .catch((error) => {
                    this.$toastr.error(error.response.data.message, 'Error', toastrConfigs);
                    console.log(error.response);
                });
            }
        }
    }
});

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