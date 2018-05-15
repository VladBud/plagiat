<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                        <span>
                            <img alt="image" height="80px" class="img-circle" src="/template/img/icon.png" />
                        </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="<?= path('adminpage') ?>">
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
                <a href="<?= path('adminpage') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Добавити файл</span></a>

            </li>
            <li>
                <a href="<?= path('files') ?>"><i class="fa fa-diamond"></i> <span class="nav-label">Файли БД</span></a>
            </li>
            <li>
                <a href="<?= path('logs') ?>"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Логи</span></a>
            </li>
        </ul>

    </div>
</nav>