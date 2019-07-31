<?php
    $CI = &get_instance();
    $data = isset($data) ? $data : NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="application-name" content="ERP">
        <meta name="author" content="Enger Jimenez">
        <meta name="description" content="A web application to manage your enterprise">
        <meta name="keywords" content="ERP, CRM, CodeIgniter, PHP, Javascript, JQuery, AJAX, Bootstrap, CSS">
        <link rel="icon" href="<?= base_url('public/icons/icon.ico'); ?>" type="image/x-icon">
        <link rel="author" href="https://github.com/EJGamer21/">

    <!-- Libraries -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="public/libs/js/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <!-- Font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css" integrity="sha384-QokYePQSOwpBDuhlHOsX0ymF6R/vLk/UQVz3WHa6wygxI5oGTmDTv8wahFOSspdm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/brands.css" integrity="sha384-n9+6/aSqa9lBidZMRCQHTHKJscPq6NW4pCQBiMmHdUCvPN8ZOg2zJJTkC7WIezWv" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/fontawesome.css" integrity="sha384-vd1e11sR28tEK9YANUtpIOdjGW14pS87bUBuOIoBILVWLFnS+MCX9T6MMf0VdPGq" crossorigin="anonymous">
       
        Select2
        <link href="/public/libs/css/select2/select2.min.css" rel="stylesheet" />
        <script src="/public/libs/js/select2/select2.min.js"></script>
        
        <!-- Datatables -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-print-1.5.6/fh-3.1.4/r-2.2.2/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-print-1.5.6/fh-3.1.4/r-2.2.2/datatables.min.js"></script> -->

        <!-- Toastr -->
        <link href="public/libs/css/toastr/toastr.min.css" rel="stylesheet" />
        <script src="public/libs/js/toastr/toastr.min.js"></script>
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
</head>
<body>
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