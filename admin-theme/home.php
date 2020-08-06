<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Store | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/OverlayScrollbars.min.css">
    <link href="css/css.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- HEADER START -->
        <?php require_once 'html/navbar.php'; ?>
    <!-- MENU START -->
    <?php require_once 'html/menu.php'; ?>
    <div class="content-wrapper" style="min-height: 230px;">
        <?php require_once 'html/content-header.php'; ?>
        <?php require_once 'html/content.php'; ?>
    </div>

    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sparkline.js"></script>
    <script src="js/jquery.knob.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/jquery.overlayScrollbars.min.js"></script>
    <script src="js/adminlte.js"></script>
    <script src="js/demo.js"></script>
</body>
</html>