<?php
    $data = isset($data) ? $data : NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="application-name" content="ERP">
        <meta name="author" content="Enger Jimenez">
        <meta name="description" content="A web application to manage your enterprise">
        <meta name="keywords" content="ERP, CRM, CodeIgniter, PHP, Javascript, AJAX, Axios, Bootstrap, CSS, VueJS">
        <link rel="icon" href="/public/icons/icon.ico" type="image/x-icon">
        <link rel="author" href="https://github.com/EJGamer21/">

    <!-- Libraries -->
        <!-- VueJS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
        
        <!-- Axios -->
        <script src="/public/libs/js/axios/axios.min.js"></script>

        <!-- Vue Tables 2 -->
        <script src="https://cdn.jsdelivr.net/npm/vue-tables-2@1.4.70/dist/vue-tables-2.min.js"></script>
        
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="/public/libs/css/bootstrap/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="/public/libs/css/bootstrap/bootstrap-vue.min.css"/>
        <script src="/public/libs/js/bootstrap/bootstrap-vue.min.js"></script>
        
        <!-- Font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css" integrity="sha384-QokYePQSOwpBDuhlHOsX0ymF6R/vLk/UQVz3WHa6wygxI5oGTmDTv8wahFOSspdm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/brands.css" integrity="sha384-n9+6/aSqa9lBidZMRCQHTHKJscPq6NW4pCQBiMmHdUCvPN8ZOg2zJJTkC7WIezWv" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/fontawesome.css" integrity="sha384-vd1e11sR28tEK9YANUtpIOdjGW14pS87bUBuOIoBILVWLFnS+MCX9T6MMf0VdPGq" crossorigin="anonymous">
        
        <!-- Toastr -->
        <script src="/public/libs/js/toastr/toastr.min.js"></script>
        <link rel="stylesheet" href="/public/libs/css/toastr/toastr.min.css"/>

        <!-- Selectpage -->
        <script src="/public/libs/js/selectpage/v-selectpage.js"></script>

        <!-- Sweetalert -->
        <script src="/public/libs/js/sweetalert/sweetalert.min.js"></script>        
    <title><?= $title ?> | Fractal</title>

    <style>
        header, main, footer {
           padding-left: 300px;
        }

        @media only screen and (max-width : 992px) {
            header, main, footer {
                padding-left: 0;
            }
        }
    </style>
    <!-- <script src="/public/libs/js/vuejs/vue-router.min.js"></script> -->
</head>
<body>
    <!-- Container -->
    <div class="container-fluid">
        <div class="row">
            <?php $this->load->view('_layout/_sidebar', $data); ?>
            <main class="col col-sm-12 col-md-10 col-lg-10">
            <?php $this->load->view($view_name, $data); ?>
            </main>
        </div>
    </div>
</body>
</html>