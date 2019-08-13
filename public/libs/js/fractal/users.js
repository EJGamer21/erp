let userForm = document.getElementById('user-form');
let username = document.getElementById('username');
let passwd = document.getElementById('password');
let repasswd = document.getElementById('retyped-password');
let submitBtn = document.getElementById('submit-btn');

let app = new Vue({
    el: '#vueapp',
    data() {
        return {
            id: null,
            username: '',
            firstname: '',
            lastname: '',
            email: '',
            password: '',
            sex: '',
            direction: {
                province: '',
                city: '',
                sector: ''
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
        this.getUsers()
    },

    methods: {
        getUsers() {
            this.users = usuarios;
            this.directions = direcciones;
        },

        verifyFields() {
            if (username.value == '' && passwd.value == '') {
                this.$toastr.error('Campos no opcionales son requeridos', 'Error', toastrConfigs);
                return;
            }
        },
        showToastr() {
        },
        
        saveUser() {
            let userData = new FormData(userForm);
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


// userForm.submit((event) => {
//     event.preventDefault();

//     submitBtn.attr('disabled', 'disabled');
//     let formData = userForm.serialize();

//     axios({
//         url: '/users/register',
//         baseURL: 'fractal/',
//         method: 'POST',
//         data: formData,
//         responseType: 'json',
//         responseEncoding: 'utf8'
//     })
//     .then((response) => {
//         console.log(response);
//         toastr[response.status](response.message, 'Notificaci&oacute;n');
        
//         if (response.status == 'success') {
//             userForm.trigger('reset');
//             submitBtn.removeAttr('disabled');
//             addRow(response.user);
//         } else {
//             passwd.val('');
//             repasswd.val('');
//             submitBtn.removeAttr('disabled');
//         }                
//     })
//     .catch((error) => {
//         toastr['error']('Error 500: Error interno del servidor', 'Error');

//         submitBtn.removeAttr('disabled');
//     });
// });

function addRow(userData) {

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