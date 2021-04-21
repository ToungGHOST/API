<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo site_url(); ?>assets/img/crm-icon.png?<?php echo uniqid(); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
    <title>Eportfolio</title>

    <?php echo view('template/components/style'); ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- CONTENT -->

                <?php
                try {
                    echo view($view);
                } catch (Exception $e) {
                    echo "<div class='error-container'>";
                    echo "<pre><code>$e</code></pre>";
                    echo "</div>";
                }
                ?> 

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo site_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo site_url(); ?>assets/plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo site_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>