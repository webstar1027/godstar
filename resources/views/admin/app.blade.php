<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HipRez | Admin </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <style>
        .delete_user_icon{
            margin-left: 25px;
            cursor: pointer;
        }
        .current_user_info{
            cursor: pointer;
        }

        .p_upload_class_download span{
            font-size: 23px;
        }
        .p_upload_class_download i{
            margin-left: 10px;
            cursor: pointer;
            font-size: 35px;
            color: #0b93d5;
        }
        .a_tn_hover_n:hover{
            background: darkred!important;
        }
        .archive_user_icon{
            cursor: pointer;
            margin-left: 2px;
        }
        .status_chackbox_in_u{
            font-size: 19px;
            margin-left: 25px;
        }
        input[type=checkbox]{
            width: 20px;
            height:20px;
        }
        .status_div_content{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .a_dowload_exel{
            font-size: 17px;
        }
        .a_dowload_exel a{
            color: green!important;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('admin/bower_components/sweetalert/dist/sweetalert.css') }}">
    <script src="{{ asset('admin/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Hip</b>R</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>Rez</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="{{ url('/administrate/logout') }}" class="btn btn-danger a_tn_hover_n">Sign out</a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div style="height: 65px; margin-left: -50px;" class="user-panel">
                <div class="pull-left info">
                    <p>{{ $admin->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="{{ url('/administrate/admin') }}"><i class="fa fa-book"></i> <span>Users</span></a></li>
                <li><a href="{{ url('/administrate/prospects') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>Prospects</span></a></li>
                <li><a href="{{ url('/administrate/archive') }}"> <i class="fa fa-archive" aria-hidden="true"></i> <span>Archive</span></a></li>
            </ul>
        </section>

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Admin Panel Dashboard Layout.</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
                <li class="a_dowload_exel"><a href="{{ url('/administrate/excel') }}"><i class="fa fa-dashboard"></i> Export to Excel</a></li>
            </ol>
        </section>

                @yield('content')


    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; 2017.</strong> All rights
        reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js')}}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#example2').DataTable({
            "order": [[ 0, "asc" ]],
        });
        $('#example3').DataTable({
            "order": [[ 0, "asc" ]],
        });
        $('#example4').DataTable({
            "order": [[ 0, "asc" ]],
        });
//        $('#example2_filter').children().css('display','none');
        $('#example2').on('click', '.delete_user_icon', function() {
            var data = $(this).data('id');
            thisItem = $(this);
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            },function () {
                $.ajax({
                    type: "POST",
                    url:'actionDelete',
                    data: {id: data},
                    success: function( msg ) {
                        swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        thisItem.parent().parent().hide();
                    }
                });
            });
        });
        $('#example3').on('click', '.delete_fromProspects', function() {
            var data = $(this).data('id');
            thisItem = $(this);
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            },function () {
                $.ajax({
                    type: "POST",
                    url:'actionProspectDelete',
                    data: {id: data},
                    success: function( msg ) {
                        swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        thisItem.parent().parent().hide();
                    }
                });
            });
        });

        $('#example2').on('click', '.archive_user_icon', function() {
            var data = $(this).data('id');
            thisItemArchive = $(this);
            swal({
                title: 'Are you sure?',
                text: "You won't be able to Archived this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Archived It!'
            },function () {
                $.ajax({
                    type: "POST",
                    url:'actionArchive',
                    data: {id: data},

                    success: function( msg ) {
                        swal(
                            'Archived!',
                            'Your file has been archived.',
                            'success'
                        );
                        thisItemArchive.parent().parent().hide();
                    }
                });
            });
        });

        $('.download_file_resume').click(function(){
            $('.aasdd').click();
        });

        $('.save_status_b').click(function(){
            var status = $('input[name=status]:checked', '.checkbox').val();
            var user_id = $(this).data('id');
            var text='New';
            if(status == 1){
                text = 'In Progress';
            }else if(status == 2){
                text = 'Active';
            }else if(status == 3){
                text = 'Archive';
            }

            $.ajax({
                type: "POST",
                url:'actionStatus',
                data: {'id': status,'user_id':user_id},
                success: function( msg ) {
                    $('.status_name_in_user_page').text(text);
                }
            });
        });
    });
</script>
</body>
</html>
