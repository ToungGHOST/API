    <!-- Custom fonts for this template-->
    <link href="<?php echo site_url(); ?>assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        * {
            font-family: 'Kanit', sans-serif;
        }

        .table-responsive {
            display: table;
        }


        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Style all input fields */
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
        }

        /* Style the submit button */
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
        }

        /* Style the container for inputs */
        .container {
            /* background-color: #f1f1f1; */
            padding: 10px;
        }

        /* The message box is shown when the user clicks on the password field */
        #message {
            display: none;
            /* background: #f1f1f1; */
            color: #000;
            position: relative;
            padding: 5px;
            margin-top: 5px;
        }

        #message p {
            padding: 10px 20px;
            font-size: 16px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -20px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -20px;
            content: "✖";
        }
    </style>

    <!-- Custom styles for this template-->
    <link href="<?php echo site_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">