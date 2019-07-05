<?php
    $CI = &get_instance();
    $data = $data ?? NULL;
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
        <meta name="keywords" content="ERP, CRM, CodeIgniter, PHP, Javascript, JQuery, AJAX, Materialize, CSS">
        <link rel="icon" href="<?= base_url('public/icons/icon.ico'); ?>" type="image/x-icon">
        <link rel="author" href="https://github.com/EJGamer21/">

    <!-- Libraries -->
        <!-- Jquery -->
        <script src="<?= base_url('public/libs/js/jquery-3.4.0.min.js'); ?>"></script>
        <!-- Materialize -->
        <link rel="stylesheet" href="<?= base_url('public/libs/css/materialize.css'); ?>">
        <script src="<?= base_url('public/libs/js/materialize.js') ?>"></script>
        <!-- Font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css" integrity="sha384-QokYePQSOwpBDuhlHOsX0ymF6R/vLk/UQVz3WHa6wygxI5oGTmDTv8wahFOSspdm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/brands.css" integrity="sha384-n9+6/aSqa9lBidZMRCQHTHKJscPq6NW4pCQBiMmHdUCvPN8ZOg2zJJTkC7WIezWv" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/fontawesome.css" integrity="sha384-vd1e11sR28tEK9YANUtpIOdjGW14pS87bUBuOIoBILVWLFnS+MCX9T6MMf0VdPGq" crossorigin="anonymous">
    <title><?= $title ?> | Fractal</title>
</head>
<body>
    <div class="row">
            <div class="col s12 m2 l2">
                <?php $this->load->view('_layout/_sidebar', $data); ?>
            </div>
            <div class="col s12 m10 l10">
                <?php $this->load->view($view_name, $data); ?>
            </div>
    </div>
</body>
</html>