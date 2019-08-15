let app = new Vue({
    el: '#vueapp',
    data() {
        return {
            user: {
                id: null,
                username: '',
                firstname: '',
                lastname: '',
                email: '',
                password: '',
                retypedPassword: '',
                sex: '',
                direction: {
                    province: '',
                    city: '',
                    sector: ''
                },
            },
            users: [],
            directions: {
                provinces: [],
                cities: [],
                sectors: []
            }
        }
    },

    mounted: function() {
        this.users = usuarios;
        this.directions = direcciones;
    },

    methods: {
        getUser() {
            
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
            userData.append('firstname', this.user.firstname);
            userData.append('lastname', this.user.lastname);
            userData.append('username', this.user.username);
            userData.append('email', this.user.email);
            userData.append('password', this.user.password);
            userData.append('sex', this.user.sex);

            let newUser = {};
            userData.forEach((value, key) => { newUser[key] = value });

            axios({
                url: '/users/register',
                method: 'post',
                data: userData,
                responseType: 'json',
            })
            .then((response) => {
                console.log(response);
                
                if (response.data.status == 'success') {
                    this.$toastr.success(response.data.message, 'Notificaci&oacute;n', toastrConfigs);
                    this.users.push(response.data.user);
                } else {
                    this.$toastr.error(response.data.message, 'Error', toastrConfigs);
                    this.user.password = '';
                    this.user.retypedPassword = '';
                }                
            })
            .catch((error) => {
                this.$toastr.error('Error 500: Error interno del servidor', 'Error', toastrConfigs);
                console.log(error);            
            });
        },

        toggleUserState(user) {

        },
        
        removeRow(user) {
            if (confirm('¿Seguro que desea borrar al usuario?')) {
                this.users.splice(user, 1);
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