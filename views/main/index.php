<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Перевірка на плагіат</title>
    <link rel="shortcut icon" type="image/x-icon" href="/template/img/favicon.ico"/>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/template/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div id="wrapper">

    <div >
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
                <h1 class="text-center" style="font-weight: 500">Перевірка на плагіат</h1>
        </div>
    </div>
</div>

<div class="text-center" style="margin-top: 100px;">
    <?php if (isset($finish) && $finish < 50) : ?>
        <h1 style="font-weight: 600; color: red; font-size: 64px; "><?= isset($finish) ? 'Унікальність ' . $finish . '%' : ''  ?></h1>
    <?php else: ?>
        <h1 style="font-weight: 600; color: green; font-size: 64px; "><?= isset($finish) ? 'Унікальність ' . $finish . '%'  : ''  ?></h1>
    <?php endif; ?>
</div>
<br><br><br><br>
<div class="middle-box text-center animated fadeInDown">
    <div style="margin-top: 100px;">
        <div style="font-size: 20px;">Ласкаво просимо</div>

        <br>
        <p class="text-center">
            Для того щоб перевірити Ваш файл, завантажте його і натисніть "Перевірити".
            Дозволяється завантажувати DOCX або PDF-файли
        </p>

        <form class="m-t" role="form" enctype="multipart/form-data" method="post" action="/">
            <div class="form-group">
                <input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Перевірити" style="display: block; margin: 0 auto; font-weight: bold; width: 50%;" />
        </form>
    </div>
</div>

<div class="footer">
    <div>
        <strong>Designed and developed by </strong>Vladislav Bud &copy; 2017-2018
    </div>
</div>

<!-- Mainly scripts -->
<script src="/template/js/jquery-2.1.1.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/plugins/toastr/toastr.min.js"></script>
<script>
    <?php foreach ( $answer as $answers  ): ?>
    toastr.info("<?= $answers ?>");
    <?php endforeach; ?>
</script>

</body>

</html>