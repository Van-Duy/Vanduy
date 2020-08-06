<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Store | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
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
    <!-- CONTENT -->

      
        <!-- Notice -->
        <!-- <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Success alert preview. This alert is dismissable.
        </div> -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                    <!-- form start -->
                                        <form role="form">
                                            <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Username<span class="star">&nbsp;*</span></label>
                                                <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ordering</label>
                                                <div class="col-sm-6">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Ordering">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-4">
                                                        <select class="custom-select">
                                                        <option>--Select one --</option>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Group Acp</label>
                                                    <div class="col-sm-4">
                                                        <select class="custom-select">
                                                        <option>--Select one --</option>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </form>
                                    </div></div></div></div>
                        <!-- button -->
                        <div class="card-body"  style="text-align: center;">
                            <a class="btn btn-info" style="color: white;"><i class="fas fa-save"></i> Save</a>
                            <a class="btn btn-info" style="color: white;"><i class="fas fa-plus-circle"></i> Save-New</a>
                            <a class="btn btn-info" style="color: white;"><i class="fas fa-closed-captioning"></i> Save-Close</a>
                            <a class="btn btn-danger" style="color: white;"><i class="fas fa-undo"></i> Back</a>
                        </div>
                    </div></div></div>
        </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
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