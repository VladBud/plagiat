<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>АдмінПанель</title>
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
    <?php include 'layouts/menu.php';?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include 'layouts/header.php'?>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Завантаження файлу</h2>
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
                                <strong>Загрузіть файл або zip-архів в базу данних:</strong><br /><br>
                                    <input type="file" name="fileToUpload" class="form-control" id="fileToUpload"><br>
                                    <input type="submit" value="Зберегти в базу" name="submit" class="btn btn-primary">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include 'layouts/footer.php'?>
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
