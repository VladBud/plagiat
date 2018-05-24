<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">AP+</h1>

        </div>
        <h3>Ласкаво просимо у адмін-панель</h3>
        <p>
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Увійдіть щоб побачити більше</p>
        <form class="m-t" method="post" role="form" action="/login">
            <div class="form-group">
                <input type="text" name="l_login" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
                <input type="password" name="l_pass" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" name="l_submit" class="btn btn-primary block full-width m-b">Увійти</button>
        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="/template/js/jquery-2.1.1.js"></script>
<script src="/template/js/bootstrap.min.js"></script>

</body>

</html>
