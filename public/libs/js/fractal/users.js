let user_form = $('form#user-form');
let username = $('#username');
let passwd = $('#password');
let repasswd = $('#retyped-password');
let submit_btn = $('#submit-btn');

$(document).ready(function() {
    $('#province').select2({
        placeholder: 'Provincia...',
        allowClear: true,
        sorter: function(data) {
            return data.sort(function (a, b) {
                if (a.text > b.text) {
                    return 1;
                }
                if (a.text < b.text) {
                    return -1;
                }
                return 0;
            });
        }
    }),
    $('#city').select2({
        placeholder: 'Ciudad...',
        allowClear: true,
        sorter: function(data) {
            return data.sort(function (a, b) {
                if (a.text > b.text) {
                    return 1;
                }
                if (a.text < b.text) {
                    return -1;
                }
                return 0;
            });
        }
    }),
    $('#sector').select2({
        placeholder: 'Sector...',
        allowClear: true,
        sorter: function(data) {
            return data.sort(function (a, b) {
                if (a.text > b.text) {
                    return 1;
                }
                if (a.text < b.text) {
                    return -1;
                }
                return 0;
            });
        }
    })        
});


let app = new Vue({
    el: '#vueapp',
    data: {
        id: 0,
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

        users: []
    },

    mounted: () => {
        console.log('Vue mounted');
        this.getUsers();
    },

    methods: {
        getUsers: function(){
            app.users = usuarios;
        },
       
    }

});


console.log(app)



submit_btn.on('click', () => {
    if (username.val() == "" && passwd.val() == "") {
        toastr["error"]('Campos no opcionales son requeridos', "Error");
        return;
    }
});

user_form.submit((event) => {
    event.preventDefault();

    submit_btn.attr('disabled', 'disabled');
    let formData = user_form.serialize();

    $.ajax({
        url: "/users/register",
        type: "POST",
        data: formData,
        dataType: 'json'
    })
    .done((response) => {
        console.log(response);
        toastr[response.status](response.message, "Notificaci&oacute;n");
        
        if (response.status == 'success') {
            user_form.trigger('reset');
            submit_btn.removeAttr('disabled');
            addRow(response.user);
        } else {
            passwd.val('');
            repasswd.val('');
            submit_btn.removeAttr('disabled');
        }                
    })
    .fail((jqXHR, textStatus, error) => {
        toastr["error"]("Error 500: Error interno del servidor", "Error");

        submit_btn.removeAttr('disabled');
    });
});

function addRow(user_data) {
    console.log(user_data);
    let new_user = [{
        usuario: user_data.username,
        nombre: user_data.firstname + ' ' + user_data.lastname,
        email: user_data.email,
        fecha_creacion: user_data.fecha_creacion,
    }];
    // user_table.row.add(new_user).draw();
}

function removeRow(button) {
    let row_id = $(button).parents('tr');
    if (confirm('Seguro que desea borrar al usuario?')) {
        console.log(row_id);
        // user_table.row(row_id).remove().draw();
    }
}

toastr.options = {
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