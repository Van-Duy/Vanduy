<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Store | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
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
    <!-- CONTENT -->

        <!-- button -->
        <div class="card-body"  style="text-align: center;">
            <a class="btn btn-app"><i class="fas fa-save"></i> Save</a>
            <a class="btn btn-app"><i class="fas fa-plus-circle"></i> Add</a>
            <a class="btn btn-app"><i class="fas fa-check-circle"></i> Pulish</a>
            <a class="btn btn-app"><i class="fas fa-circle-notch"></i> Unpublish</a>
            <a class="btn btn-app"><i class="fas fa-trash"></i> Delete</a>
            <a class="btn btn-app">
                <span class="badge bg-warning">3</span>
                <i class="fas fa-bullhorn"></i> Notifications
            </a>
        </div>
        <!-- notice -->
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Success alert preview. This alert is dismissable.
        </div>
         <!-- body -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                <div class="card">
                <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <a href="#" type="button" class="btn btn-info active">All</a>
                                <a href="#" type="button" class="btn btn-info">Public</a>
                                <a href="#" type="button" class="btn btn-info">Unpublic</a>
                            </div></div></div></div>
                    </div>

                    <div class="card">

               




                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                 <!-- search -->
                                <div class="dataTables_length" id="example1_length">
                                <label class="filter-search-lbl" for="filter_search">Filter:</label>
                                    <input type="text" class="btn btn-xs btn-default" name="filter_search" id="filter_search" value="">
                                    <a type="button" class="btn btn-xs btn-default" name="search-keyword">Search</a>
                                    <a type="button" class="btn btn-xs btn-default" name="clear-keyword">Clear</a>
                                </label>
                                </div>
                            </div>
                             <!-- select -->
                            <div class="col-sm-12 col-md-6">
                                <div id="example1_filter" class="dataTables_filter">
                                    <select name="filter_status" class="btn btn-xs btn-default">
                                        <option value="default">-Select Status-</option>
                                        <option value="pulish">Pulish</option>
                                        <option value="unpulish">Unpulish</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                         <!-- list -->
                        <div class="row">
                            <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped table-hover dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc text-center" style="width: 1%"><input type="checkbox" class="btn btn-default btn-sm checkbox-toggle"></input></th>
                                            <th class="sorting_asc text-center" style="width: 1%">Id</th>
                                            <th class="sorting_asc text-center" style="width: 20%">UserName</th>
                                            <th class="sorting text-center" style="width: 15%">Status</th>
                                            <th class="sorting text-center" style="width: 5%">Group-Acp</th>
                                            <th class="sorting text-center" style="width: 5%">Ordering</th>
                                            <th class="sorting text-center" style="width: 20%">Created</th>
                                            <th class="sorting text-center" style="width: 20%">Modified</th>
                                            <th style="width: 20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="even">
                                            <td tabindex="0" class="sorting_1">
                                                <input type="checkbox">
                                            </td>
                                            <td class="text-center" tabindex="0" class="sorting_1">1</td>
                                            <td tabindex="0" class="sorting_1 text-center">Gecko</td>
                                            <td class="text-center"><a type="button" class="btn btn-xs btn-success"><i class="fas fa-circle-notch"></i></a></td>
                                            <td class="text-center"><a type="button" class="btn btn-xs btn-success"><i class="fas fa-circle-notch"></i></a></td>
                                            <td class="text-center"><input type="text" name="" class="btn-xs" style="max-width: 60px;"></td>
                                            <td class="text-center"><a><i class="fas fa-user"></i> Admin</a><br><small> 01.01.2019</small></td>
                                            <td class="text-center"><a><i class="fas fa-user"></i> Admin</a><br><small> 01.01.2019</small></td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr role="row" class="even">
                                            <td tabindex="0" class="sorting_1">
                                                <input type="checkbox">
                                            </td>
                                            <td class="text-center" tabindex="0" class="sorting_1">1</td>
                                            <td tabindex="0" class="sorting_1 text-center">Gecko</td>
                                            <td class="text-center"><a type="button" class="btn btn-xs btn-warning"><i class="fas fa-circle-notch"></i></a></td>
                                            <td class="text-center"><a type="button" class="btn btn-xs btn-warning"><i class="fas fa-circle-notch"></i></a></td>
                                            <td class="text-center"><input type="text" name="" class="btn-xs" style="max-width: 60px;"></td>
                                            <td class="text-center"><a><i class="fas fa-user"></i> Admin</a><br><small> 01.01.2019</small></td>
                                            <td class="text-center"><a><i class="fas fa-user"></i> Admin</a><br><small> 01.01.2019</small></td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                           <!-- phân trang -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                            </div><div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination">
                                    <li class=""><a href="#" class="page-link">Start</a></li>
                                    <li class="disabled"><a href="#" class="page-link">&laquo;</a></li>
                                    <li class="active"><a href="#" class="page-link">1</a></li>
                                    <li class=""><a href="#" class="page-link">2</a></li>
                                    <li class=""><a href="#" class="page-link">3</a></li>
                                    <li><a href="#" class="page-link">&raquo;</a></li>
                                    <li><a href="#" class="page-link">End</a></li>
                                </ul>
                            </div></div></div></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>




















    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/dataTables.responsive.min.js"></script>
    <script src="js/responsive.bootstrap4.min.js"></script>

    <script src="js/sparkline.js"></script>
    <script src="js/jquery.knob.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/jquery.overlayScrollbars.min.js"></script>
    <script src="js/adminlte.js"></script>
    <!-- Page Script -->
    <script>
    $(function () {
        //Enable check and uncheck all functionality
        $('.checkbox-toggle').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
        })
    })
    </script>
    <script src="js/demo.js"></script>
</body>
</html>