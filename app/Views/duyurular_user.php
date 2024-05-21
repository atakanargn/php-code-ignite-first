<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPanel - Duyurular</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Anasayfa</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/index3.html" class="brand-link">
                <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminPanel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION['fullname'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Demirbaş Listesi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Genel
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/duyurular" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Duyurular</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/mesajlar" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mesajlar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="/kullanicilar" class="nav-link">
                                    <i class="nav-icon fas fa-user-alt"></i>
                                    <p>
                                        Kullanıcılar
                                    </p>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Duyurular
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/demirbas" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Demirbaş Listesi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/mesajlar" class="nav-link">
                                    <i class="nav-icon fas fa-comments"></i>
                                    <p>
                                        Mesajlar
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/sifre" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Şifre Değiştir
                                    </p>
                                </a>
                            </li>

                        <?php } ?>

                        <li class="nav-item">
                            <a href="/cikis" class="nav-link">
                                <i class="nav-icon fas fa-logout"></i>
                                <p>
                                    Çıkış
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-2">
            <!-- Main content -->
            <h2>Duyurular</h2>
            <hr>
            <section class="content">
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $row): ?>
                        <form action="/duyurular" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-<?= $row->status ?>" role="alert">
                                        <?= $row->content ?> <br>
                                        <?= $row->created_by ?> | <?= $row->created_at ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="row">
                        <div class="col-sm-12">
                            Kayıt bulunamadı!
                        </div>
                    </div>
                <?php endif; ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2024 Tüm hakları saklıdır.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>

    <script>
        function changeColor(elem) {
            try {
                $(elem).removeClass(['bg-success', 'bg-danger', 'bg-info', 'bg-warning']).addClass($("#status option:selected").attr("data-color"));
            } catch (err) {

            }
        }
    </script>
</body>

</html>