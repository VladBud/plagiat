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
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">AP+</h1>
        </div>
        <h3>Форма зміни Вашого паролю</h3>
        <p>
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Введіть старий та новий пароль</p>
        <form class="m-t" method="post" role="form" action="/admin/changepass">
            <div class="form-group">
                <input type="password" name="old_pass" class="form-control" placeholder="Old pass" required="">
            </div>
            <div class="form-group">
                <input type="password" name="new_pass" class="form-control" placeholder="New pass" required="">
            </div>
            <div class="form-group">
                <input type="password" name="confirm_new_pass" class="form-control" placeholder="Confirm" required="">
            </div>
            <button type="submit" name="change_submit" class="btn btn-primary block full-width m-b">Змінити</button>
        </form>
    </div>
</div>
<div id="wrapper">
    <?php include 'layouts/menu.php';?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include 'layouts/header.php'?>
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