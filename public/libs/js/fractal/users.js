let user_form = $('form#user-form');
let username = $('#username');
let passwd = $('#password');
let repasswd = $('#retyped-password');
let submit_btn = $('#submit-btn');
/*  */
// let user_table = $('#users-table').DataTable({
//     // 'data': users,
//     'columnDefs': [
//         {
//             'data': users.username,
//             'render': (data, type, row, meta) => {
//                 console.log(data);
//                 return data;
//             }
//         }
//     ],
//     'language': {
//         "sProcessing":     "Procesando...",
//         "sLengthMenu":     "Mostrar _MENU_ registros",
//         "sZeroRecords":    "No se encontraron resultados",
//         "sEmptyTable":     "Ningún dato disponible en esta tabla",
//         "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//         "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//         "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//         "sInfoPostFix":    "",
//         "sSearch":         "Buscar:",
//         "sUrl":            "",
//         "sInfoThousands":  ",",
//         "sLoadingRecords": "Cargando...",
//         "oPaginate": {
//             "sFirst":    "Primero",
//             "sLast":     "Último",
//             "sNext":     "Siguiente",
//             "sPrevious": "Anterior"
//         },
//         "oAria": {
//             "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//         }
//     }
// });

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

submit_btn.on('click', () => {
    if (username.val() == "" && passwd.val() == "") {
        toastr["error"]('Campos no opcionales son requeridos', "Error");
        return;
    }
});

// user_form.submit((event) => {
//     event.preventDefault();

//     submit_btn.attr('disabled', 'disabled');
//     let formData = user_form.serialize();

//     $.ajax({
//         url: "/users/register",
//         type: "POST",
//         data: formData,
//         dataType: 'json'
//     })
//     .done((response) => {
//         console.log(response);
//         toastr[response.status](response.message, "Notificaci&oacute;n");
        
//         if (response.status == 'success') {
//             user_form.trigger('reset');
//             submit_btn.removeAttr('disabled');
//             addRow(response.user);
//         } else {
//             passwd.val('');
//             repasswd.val('');
//             submit_btn.removeAttr('disabled');
//         }                
//     })
//     .fail((jqXHR, textStatus, error) => {
//         toastr["error"]("Error 500: Error interno del servidor", "Error");

//         submit_btn.removeAttr('disabled');
//     });
// });

function addRow(user_data) {
    user_table.row.add({
        'usuario': user_data.username,
        'nombre': user_data.firstname + ' ' + user_data.lastname,
        'email': user_data.email,
        'fecha_creacion': user_data.fecha_creacion
    }).draw();
}

function removeRow(row) {
    let row_id = $(row).data('id');
    console.log(row_id);

    if (confirm('Desea remover el usuario?')) {
        user_table.row(row_id).remove().draw();
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