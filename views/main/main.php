<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Empty Page</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/template/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">
</head>

<body>

<div id="wrapper">


    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>This is main title</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">This is</a>
                    </li>
                    <li class="active">
                        <strong>Breadcrumb</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="middle-box text-center animated fadeInRightBig">
                        <h3 class="font-bold">This is page content</h3>

                        <div class="error-desc">
                            You can create here any grid layout you want. And any variation layout you imagine:) Check out main dashboard and other site. It use many different layout.
                            <br/>
                        </div>
                        <form enctype="multipart/form-data" method="post" action="/">
                            <strong></strong><br />
                            <input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
                            <br />
                            <input type="submit" name="submit" class="btn btn-primary" value="Перевірити" style="display: block; margin: 0 auto; font-weight: bold; width: 50%;" />
                        </form>
                        <p>
                            <h2><?= isset($finish) ? $finish:'' ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">

            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
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
<script>
    <?php foreach ( $answer as $answers  ): ?>
        toastr.success("<?= $answers ?>");
    <?php endforeach; ?>
</script>

</body>

</html>


