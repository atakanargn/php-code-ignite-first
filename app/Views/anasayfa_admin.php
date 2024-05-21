<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPanel</title>

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
            <h2>Demirbaş Listesi</h2>
            <hr>
            <section class="content">
                <form action="/anasayfa" method="POST">
                    <div class="row">
                        <?php if (isset($_SESSION['danger'])) { ?>
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['danger'];
                                    unset($_SESSION['danger']);
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="col-sm-12">
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Demirbaş Adı" name="name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="-1" disabled selected>Seçiniz</option>
                                    <option value="Yeni">Yeni</option>
                                    <option value="Onarım Görmüş">Onarım Görmüş</option>
                                    <option value="Eski">Eski</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="description" placeholder="Açıklama" id="description"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label for="price" class="form-label">
                                    Değer [ <span id="price_value">1000 ₺</span> ]
                                </label>
                                <br>
                                <input type="range" class="form-range" id="price" name="price" min="50" max="100000" value="1000" style="width:100%;" onchange="changeValue(this);" onmousemove="changeValue(this);" />
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Ekle</button>
                        </div>
                    </div>
                </form>
                <hr>
                <p>Aşağıdaki arama girişi demirbaş listesi ad, açıklama, durum, fiyat içerisinde arama yapar.</p>
                <div class="row">
                    <div class="col-sm-2">
                        <h4>Arama</h4>
                    </div>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Demirbaş Adı" name="name" onkeyup="search(this);">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="demirbaslar">
                    <div class="col-sm-1 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        ID
                    </div>
                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        Ad
                    </div>
                    <div class="col-sm-3 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        Açıklama
                    </div>
                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        Durum
                    </div>
                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        Fiyat
                    </div>
                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-bold bg-dark">
                        İşlem
                    </div>
                </div>
                <div id="demirbas_liste">
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <form action="/anasayfa" method="POST">
                                <div class="row">

                                    <div class="col-sm-1 border header ml-0 mr-0 mt-1 mb-0 text-center">
                                        <?= $row->id ?>
                                        <input type="hidden" name="id" value="<?= $row->id ?>" />
                                    </div>
                                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0">
                                        <?= $row->name ?>
                                    </div>
                                    <div class="col-sm-3 border header ml-0 mr-0 mt-1 mb-0">
                                        <input type="text" class="form-control" name="description" id="description" value="<?= $row->description ?>">
                                    </div>
                                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Yeni" <?php if ($row->status == "Yeni") {
                                                echo 'selected';
                                            }
                                            ; ?>>Yeni</option>
                                            <option value="Onarım Görmüş" <?php if ($row->status == "Onarım Görmüş") {
                                                echo 'selected';
                                            }
                                            ; ?>>Onarım Görmüş</option>
                                            <option value="Eski" <?php if ($row->status == "Eski") {
                                                echo 'selected';
                                            }
                                            ; ?>>Eski</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-center" style="font-size:18px;">
                                        <?= $row->price ?> ₺
                                    </div>
                                    <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-center">
                                        <button type="submit" class="btn btn-success" name="action" value="update">Güncelle</button>
                                        -
                                        <button type="submit" class="btn btn-danger" name="action" value="delete">Sil</button>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-sm-12">
                                Kayıt bulunamadı!
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

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
        function changeValue(elem) {
            $('#price_value').html(`${elem.value} ₺`);
        }

        function search(elem) {
            var q = elem.value;
            $.ajax({
                url: '/ajax_demirbas',
                type: 'GET',
                data: { q: q },
                success: function (response) {
                    let demirbasListe = $('#demirbas_liste');
                    demirbasListe.empty();

                    if (response.length > 0) {
                        response.forEach(function (row) {
                            let form = `
                        <form action="/anasayfa" method="POST">
                            <div class="row">
                                <div class="col-sm-1 border header ml-0 mr-0 mt-1 mb-0 text-center">
                                    ${row.id}
                                    <input type="hidden" name="id" value="${row.id}" />
                                </div>
                                <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0">
                                    ${row.name}
                                </div>
                                <div class="col-sm-3 border header ml-0 mr-0 mt-1 mb-0">
                                    <input type="text" class="form-control" name="description" id="description" value="${row.description}">
                                </div>
                                <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Yeni" ${row.status == "Yeni" ? 'selected' : ''}>Yeni</option>
                                        <option value="Onarım Görmüş" ${row.status == "Onarım Görmüş" ? 'selected' : ''}>Onarım Görmüş</option>
                                        <option value="Eski" ${row.status == "Eski" ? 'selected' : ''}>Eski</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-center" style="font-size:18px;">
                                    ${row.price} ₺
                                </div>
                                <div class="col-sm-2 border header ml-0 mr-0 mt-1 mb-0 text-center">
                                    <button type="submit" class="btn btn-success" name="action" value="update">Güncelle</button>
                                    -
                                    <button type="submit" class="btn btn-danger" name="action" value="delete">Sil</button>
                                </div>
                            </div>
                        </form>
                    `;
                            demirbasListe.append(form);
                        });
                    } else {
                        let noRecord = `
                            <div class="row">
                                <div class="col-sm-12">
                                    Kayıt bulunamadı!
                                </div>
                            </div>
                        `;
                        demirbasListe.append(noRecord);
                    }
                },
                error: function () {
                    alert('Veri alınırken bir hata oluştu.');
                }
            });
        }


    </script>
</body>

</html>