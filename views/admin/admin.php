<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome to AdminPage</title>
    <link rel="shortcut icon" type="image/x-icon" href="/template/img/favicon.ico"/>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/template/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="/template/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"> <strong class="font-bold">Admin</strong></span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        AD
                    </div>
                </li>
                <li>
                    <a href="/admin"><i class="fa fa-th-large"></i> <span class="nav-label">V1</span></a>

                </li>
                <li>
                    <a href="/admin"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
                </li>
                <li>
                    <a href="/admin"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span></a>
                </li>
                <li>
                    <a href="/admin"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span> </a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to AdminPage</span>
                    </li>
                    <li>
                        <a href="<?= path('logoutpage') ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>File upload</h2>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <form enctype="multipart/form-data" method="post" action="/admin">
                                <strong>Загрузіть файл або папку в базу данних:</strong><br /><br>
                                    <input type="file" name="fileToUpload" class="form-control" id="fileToUpload"><br>
                                <input type="submit" value="Записати файл в базу" name="submit" class="btn btn-primary">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="pull-right">
                <strong>All rights reserved</strong>
            </div>
            <div>
                <strong>Designed and developed by </strong>Vladislav Bud &copy; 2018
            </div>
        </div>

    </div>
</div>



<!-- Mainly scripts -->
<script src="/template/js/jquery-2.1.1.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/template/js/inspinia.js"></script>
<script src="/template/js/plugins/pace/pace.min.js"></script>
<script src="/template/js/plugins/toastr/toastr.min.js"></script>

<!-- DROPZONE -->
<script src="/template/js/plugins/dropzone/dropzone.js"></script>


<script>
    $(document).ready(function(){
        <?php if (isset($answer)): ?>
        <?php foreach ( $answer as $answers ): ?>
        <?php if($answers['type'] === 'error'): ?>
            toastr.info("<?= $answers['msg']; ?>");
        <?php elseif ($answers['type'] === 'ok'): ?>
            toastr.success("<?= $answers['msg']; ?>");
        <?php endif; ?>
        <?php endforeach; ?>

<?php endif; ?>

    });
</script>

</body>

</html>
