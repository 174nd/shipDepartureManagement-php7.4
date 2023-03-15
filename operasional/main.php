<?php
$backurl = '../';
require_once($backurl . 'operasional/config/settings.php');
$pset = array(
  'title' => 'Dashboard',
  'content' => 'Dashboard',
  'breadcrumb' => array(
    'Dashboard' => 'active',
  ),
);

if (isset($_POST['u-password'])) {
  $pass = md5($_POST['pass_lama']);
  $cek = mysqli_query($conn, "SELECT * FROM login WHERE username LIKE '$_SESSION[username]' AND password LIKE '$pass'");
  $ketemu = mysqli_num_rows($cek);
  if ($ketemu > 0) {
    if ($_POST['pass_baru1'] == $_POST["pass_baru2"]) {
      $set = array(
        'pass' => $_POST['pass_baru1'],
      );
      $val = array(
        'id_user' => $_SESSION['id_user'],
        'pass' => $_POST['pass_lama'],
      );
      $query = setUpdate($set, 'user', $val);
      if (!$query) {
        $_SESSION['notifikasi'] = 'NOT02';
      } else {
        $_SESSION["password"] = md5($_POST['pass_baru1']);
        $_SESSION['notifikasi'] = 'NOT04';
      }
    } else {
      $_SESSION['notifikasi'] = 'NOT08';
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT07';
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <?php include $backurl . 'config/site/head.php'; ?>
</head>

<body class="hold-transition layout-top-nav text-sm">
  <div class="wrapper">
    <?php include $backurl . 'operasional/config/header.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php include $backurl . 'operasional/config/content-header.php'; ?>

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co"));
                    echo $r['total']; ?>
                    <sup style="font-size: 20px">Kapal</sup>
                  </h3>
                  <p>Kapal Berangkat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-sign-out-alt"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE id_ci NOT IN (SELECT id_ci FROM co)"));
                    echo $r['total']; ?>
                    <sup style="font-size: 20px">Kapal</sup>
                  </h3>
                  <p>Kapal Singgah</p>
                </div>
                <div class="icon">
                  <i class="fa fa-sign-in-alt"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-light">
                <div class="inner">
                  <h3>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(kd_kapal) AS total FROM kapal"));
                    echo $r['total']; ?>
                    <sup style="font-size: 20px">Kapal</sup>
                  </h3>
                  <p>Kapal Perusahaan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-ship"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <section class="col-lg-8 connectedSortable">

              <div class="card card-primary card-outline collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Konfirmasi Data Keberangkatan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 mb-2">
                      <select id="column_fco" class="form-control custom-select">
                        <option value="1">Pelabuhan Tujuan</option>
                        <option value="2">Nama Kapal</option>
                        <option value="0">Clearance Out</option>
                        <option value="3">Tipe</option>
                      </select>
                    </div>
                    <div class="col-md-8 mb-2">
                      <input type="text" class="form-control" placeholder="Cari Data" id="field_fco">
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="table_fco" class="table table-bordered table-hover" style="min-width: 610px;width: 100%;">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Pelabuhan Tujuan</th>
                          <th>Nama Kapal</th>
                          <th>Tipe</th>
                          <th>Act</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card card-primary card-outline collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Konfirmasi Data Kedatangan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 mb-2">
                      <select id="column_fci" class="form-control custom-select">
                        <option value="1">Pelabuhan Asal</option>
                        <option value="2">Nama Kapal</option>
                        <option value="0">Clearance In</option>
                        <option value="3">Tipe</option>
                      </select>
                    </div>
                    <div class="col-md-8 mb-2">
                      <input type="text" class="form-control" placeholder="Cari Data" id="field_fci">
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="table_fci" class="table table-bordered table-hover" style="min-width: 610px;width: 100%;">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Pelabuhan Asal</th>
                          <th>Nama Kapal</th>
                          <th>Tipe</th>
                          <th>Act</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="text-center w-100 mb-0">Statistik Kedatangan Kapal Tahun <?= date('Y'); ?></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="statistik-ci" style="min-width: 650px;height:300px;"></div>
                  </div>
                </div>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="text-center w-100 mb-0">Statistik Keberangkatan Kapal Tahun <?= date('Y'); ?></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="statistik-co" style="min-width: 650px;height:300px;"></div>
                  </div>
                </div>
              </div>

              <div class="card card-primary collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Data Kedatangan <?= bulan_indo(date('m')) . ' ' . date('Y'); ?></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table_ci" class="table table-bordered table-hover" style="min-width: 400px;">
                      <thead>
                        <tr>
                          <th style="width: 140px;">Kedatangan</th>
                          <th>Nama Kapal</th>
                          <th style="width: 50px;">Act</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM ((ci JOIN kapal) JOIN pelabuhan) WHERE ci.kd_kapal=kapal.kd_kapal AND ci.kd_pelabuhan=pelabuhan.kd_pelabuhan AND MONTH(tgl_ci)=MONTH(CURDATE()) AND YEAR(tgl_ci)=YEAR(CURDATE()) ORDER BY tgl_ci DESC");
                        for ($i = 1; $Data = mysqli_fetch_assoc($sql); $i++) { ?>
                          <tr>
                            <td class="align-middle text-center"><?= tanggal_indo($Data['tgl_ci']); ?></td>
                            <td class="align-middle"><?= $Data['nm_kapal']; ?></td>
                            <td class="align-middle text-center">
                              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" id_ci="<?= $Data['id_ci']; ?>" data-target="#cek-ci"><i class="fa fa-edit"></i></button>
                            </td>
                          </tr>
                        <?php }
                        if ($i == 1) { ?>
                          <tr>
                            <td class="align-middle text-center" colspan="3">Tidak Ada Keberangkatan Pada Bulan Ini!</td>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card card-primary collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Data Keberangkatan <?= bulan_indo(date('m')) . ' ' . date('Y'); ?></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table_co" class="table table-bordered table-hover" style="min-width: 400px;">
                      <thead>
                        <tr>
                          <th style="width: 140px;">Keberangkatan</th>
                          <th>Nama Kapal</th>
                          <th style="width: 50px;">Act</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM (((co JOIN ci) JOIN kapal) JOIN pelabuhan) WHERE co.id_ci=ci.id_ci AND ci.kd_kapal=kapal.kd_kapal AND co.kd_pelabuhan=pelabuhan.kd_pelabuhan AND MONTH(tgl_co)=MONTH(CURDATE()) AND YEAR(tgl_co)=YEAR(CURDATE()) ORDER BY tgl_co DESC");
                        for ($i = 1; $Data = mysqli_fetch_assoc($sql); $i++) { ?>
                          <tr>
                            <td class="align-middle text-center"><?= tanggal_indo($Data['tgl_co']); ?></td>
                            <td class="align-middle"><?= $Data['nm_kapal']; ?></td>
                            <td class="align-middle text-center">
                              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" id_co="<?= $Data['id_co']; ?>" data-target="#cek-co"><i class="fa fa-edit"></i></button>
                            </td>
                          </tr>
                        <?php }
                        if ($i == 1) { ?>
                          <tr>
                            <td class="align-middle text-center" colspan="3">Tidak Ada Keberangkatan Pada Bulan Ini!</td>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

            </section>
            <section class="col-lg-4 connectedSortable">

              <form method="POST" action="<?= $df['home'] . 'export/' ?>" class="card card-primary" enctype="multipart/form-data" autocomplete="off">
                <div class="card-header">
                  <h3 class="card-title">Cetak Laporan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="input-group">
                    <input type="text" name="bt_laporan" id="bt_laporan" class="form-control mymonthpicker" placeholder="Tanggal Laporan" required>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-block btn-primary" id="cetak_laporan">Cetak Laporan</button>
                </div>
              </form>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Cek Data Kedatangan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="input-group">
                    <input type="text" name="bt_ci" id="bt_ci" class="form-control mymonthpicker" placeholder="Tanggal Laporan" required>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-block btn-primary" id="cari_ci">Cari</button>
                </div>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Cek Data Keberangkatan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="input-group">
                    <input type="text" name="bt_co" id="bt_co" class="form-control mymonthpicker" placeholder="Tanggal Laporan" required>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-block btn-primary" id="cari_co">Cari</button>
                </div>
              </div>


            </section>
          </div>
          <!-- /.row (main row) -->


        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <div class="modal fade" id="data-ci">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
          <div class="modal-header">
            <h4 class="modal-title">Data Kedatangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="data-co">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
          <div class="modal-header">
            <h4 class="modal-title">Data Keberangkatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="cek-ci">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
          <div class="modal-header">
            <h4 class="modal-title">Detail Kedatangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="cek-co">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
          <div class="modal-header">
            <h4 class="modal-title">Detail Keberangkatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="konfirmasi-status">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
          <div class="modal-header">
            <h4 class="modal-title">Konfimasi Status</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="send_id" id="send_id">
            <input type="hidden" name="k_status" id="k_status">
            <h4 class="modal-title">Anda yakin Ingin <span class="font-weight-bold"></span>?</h4>
            <input type="hidden" name="kd_pelabuhan" id="dkd_pelabuhan">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
              <button type="button" name="konfirmasi-status" class="btn btn-outline-primary">Konfirmasi</button>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php include $backurl . 'operasional/config/modal.php'; ?>
    <?php include $backurl . 'config/site/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php include $backurl . 'config/site/script.php'; ?>
  <!-- page script -->
  <script>
    $(function() {
      var host = "<?= $df['home'] ?>";

      var dataKedatangan = {
        data: [
          [1, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='1' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [2, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='2' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [3, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='3' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [4, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='4' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [5, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='5' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [6, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='6' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [7, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='7' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [8, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='8' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [9, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='9' AND YEAR(tgl_ci)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [10, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='10' AND YEAR(tgl_ci)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
          [11, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='11' AND YEAR(tgl_ci)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
          [12, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_ci) AS total FROM ci WHERE MONTH(tgl_ci)='12' AND YEAR(tgl_ci)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
        ],
        color: '<?= '#' . substr(md5(mt_rand()), 0, 6); ?>'
      }
      var barOptKedatangan = {
        grid: {
          hoverable: true,
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          shadowSize: 0,
          lines: {
            show: true
          },
          points: {
            show: true
          }
        },
        lines: {
          fill: false,
          color: '#3c8dbc'
        },
        yaxis: {
          show: true
        },
        xaxis: {
          show: true,
          ticks: [
            [1, "Januari"],
            [2, "Februari"],
            [3, "Maret"],
            [4, "April"],
            [5, "Mei"],
            [6, "Juni"],
            [7, "Juli"],
            [8, "Agustus"],
            [9, "September"],
            [10, "Oktober"],
            [11, "November"],
            [12, "Desember"]
          ]
        }
      };
      new ResizeSensor($("#statistik-ci").parent().parent(), function() {
        $.plot($("#statistik-ci"), [dataKedatangan], barOptKedatangan);
        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
          position: 'absolute',
          display: 'none',
          opacity: 0.8
        }).appendTo('body')
        $('#statistik-ci').bind('plothover', function(event, pos, item) {
          if (item) {
            var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2)
            bulan = {
              1: "Januari",
              2: "Februari",
              3: "Maret",
              4: "April",
              5: "Mei",
              6: "Juni",
              7: "Juli",
              8: "Agustus",
              9: "September",
              10: "Oktober",
              11: "November",
              12: "Desember"
            };
            $('#line-chart-tooltip').html('Kedatangan Bulan ' + bulan[Math.round(x)] + ' = ' + Math.round(y) + ' Kapal')
              .css({
                top: item.pageY + 5,
                left: item.pageX + 5
              })
              .fadeIn(200)
          } else {
            $('#line-chart-tooltip').hide()
          }

        })
      });

      var dataKeberangkatan = {
        data: [
          [1, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='1' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [2, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='2' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [3, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='3' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [4, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='4' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [5, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='5' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [6, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='6' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [7, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='7' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [8, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='8' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [9, <?php
              $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='9' AND YEAR(tgl_co)=YEAR(NOW())"));
              echo $r['total'];
              ?>],
          [10, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='10' AND YEAR(tgl_co)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
          [11, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='11' AND YEAR(tgl_co)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
          [12, <?php
                $r = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_co) AS total FROM co WHERE MONTH(tgl_co)='12' AND YEAR(tgl_co)=YEAR(NOW())"));
                echo $r['total'];
                ?>],
        ],
        color: '<?= '#' . substr(md5(mt_rand()), 0, 6); ?>'
      }
      var barOptKeberangkatan = {
        grid: {
          hoverable: true,
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          shadowSize: 0,
          lines: {
            show: true
          },
          points: {
            show: true
          }
        },
        lines: {
          fill: false,
          color: '#3c8dbc'
        },
        yaxis: {
          show: true
        },
        xaxis: {
          show: true,
          ticks: [
            [1, "Januari"],
            [2, "Februari"],
            [3, "Maret"],
            [4, "April"],
            [5, "Mei"],
            [6, "Juni"],
            [7, "Juli"],
            [8, "Agustus"],
            [9, "September"],
            [10, "Oktober"],
            [11, "November"],
            [12, "Desember"]
          ]
        }
      };
      new ResizeSensor($("#statistik-co").parent().parent(), function() {
        $.plot($("#statistik-co"), [dataKeberangkatan], barOptKeberangkatan);
        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
          position: 'absolute',
          display: 'none',
          opacity: 0.8
        }).appendTo('body');
        $('#statistik-co').bind('plothover', function(event, pos, item) {
          if (item) {
            var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2)
            bulan = {
              1: "Januari",
              2: "Februari",
              3: "Maret",
              4: "April",
              5: "Mei",
              6: "Juni",
              7: "Juli",
              8: "Agustus",
              9: "September",
              10: "Oktober",
              11: "November",
              12: "Desember"
            };
            $('#line-chart-tooltip').html('Kedatangan Bulan ' + bulan[Math.round(x)] + ' = ' + Math.round(y) + ' Kapal')
              .css({
                top: item.pageY + 5,
                left: item.pageX + 5
              })
              .fadeIn(200)
          } else {
            $('#line-chart-tooltip').hide()
          }
        });
      });

      $('#cari_ci').click(function() {
        if ($('#bt_ci').val() != '') {
          $('#data-ci').modal('show');
          $("#data-ci .modal-content .overlay").removeClass("invisible");
          $("#data-ci .modal-body").html('');
          var id_ci = $(this).attr('id_ci');
          $.ajax({
            type: "POST",
            url: host + "get-data",
            data: {
              'set': 'data_ci',
              'bt_ci': $('#bt_ci').val(),
            },
            success: function(data) {
              $("#data-ci .modal-body").html(data);
              $("#data-ci .modal-content .overlay").addClass("invisible");
            }
          });
        }
      });

      $('#cari_co').click(function() {
        if ($('#bt_co').val() != '') {
          $('#data-co').modal('show');
          $("#data-co .modal-content .overlay").removeClass("invisible");
          $("#data-co .modal-body").html('');
          var id_co = $(this).attr('id_co');
          $.ajax({
            type: "POST",
            url: host + "get-data",
            data: {
              'set': 'data_co',
              'bt_co': $('#bt_co').val(),
            },
            success: function(data) {
              $("#data-co .modal-body").html(data);
              $("#data-co .modal-content .overlay").addClass("invisible");
            }
          });
        }
      });

      $('body').on('click', 'button[data-target="#cek-ci"]', function() {
        $('#cek-ci').modal('show');
        $("#cek-ci .modal-content .overlay").removeClass("invisible");
        $("#cek-ci .modal-body").html('');
        var id_ci = $(this).attr('id_ci');
        $.ajax({
          type: "POST",
          url: host + "get-data",
          data: {
            'set': 'ci',
            'id_ci': id_ci,
          },
          success: function(data) {
            $("#cek-ci .modal-body").html(data);
            $("#cek-ci .modal-content .overlay").addClass("invisible");
          }
        });
      });

      $('body').on('click', 'button[data-target="#cek-co"]', function() {
        $('#cek-co').modal('show');
        $("#cek-co .modal-content .overlay").removeClass("invisible");
        $("#cek-co .modal-body").html('');
        var id_co = $(this).attr('id_co');
        $.ajax({
          type: "POST",
          url: host + "get-data",
          data: {
            'set': 'co',
            'id_co': id_co,
          },
          success: function(data) {
            $("#cek-co .modal-body").html(data);
            $("#cek-co .modal-content .overlay").addClass("invisible");
          }
        });
      });


      var table_fco = $('#table_fco').DataTable({
        'paging': true,
        'lengthChange': false,
        "pageLength": 10,
        'info': true,
        "order": [
          [0, "desc"]
        ],
        'searching': true,
        'ordering': true,
        "language": {
          "paginate": {
            "previous": "<",
            "next": ">"
          }
        },

        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": host + "../config/get-tables.php",
          "data": {
            "set_tables": "SELECT tgl_co, nm_kapal, nm_pelabuhan, co.tipe_muatan, id_co FROM (((co JOIN ci) JOIN kapal) JOIN pelabuhan) WHERE co.id_ci=ci.id_ci AND ci.kd_kapal=kapal.kd_kapal AND co.kd_pelabuhan=pelabuhan.kd_pelabuhan AND (co.k_muatan!='Y' OR co.k_co!='Y')",
            "query": true
          },
          "type": "POST"
        },
        "columns": [{
            'className': "align-middle text-center",
            "data": "tgl_co",
            "width": "50px",
          },
          {
            'className': "align-middle",
            "data": "nm_kapal",
          }, {
            'className': "align-middle text-center",
            "data": "nm_pelabuhan",
          }, {
            'className': "align-middle text-center",
            "data": "tipe_muatan",
            "width": "10px",
          }, {
            'className': "align-middle text-center",
            "data": "id_co",
            "width": "10px",
            "render": function(data, type, row, meta) {
              return '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" id_co="' + data + '" data-target="#cek-co"><i class="fa fa-edit"></i></button>';
            }
          }
        ]
      });
      $('#table_fco_filter').hide();
      $('#field_fco').keyup(function() {
        table_fco.columns($('#column_fco').val()).search(this.value).draw();
      });


      var table_fci = $('#table_fci').DataTable({
        'paging': true,
        'lengthChange': false,
        "pageLength": 10,
        'info': true,
        "order": [
          [0, "desc"]
        ],
        'searching': true,
        'ordering': true,
        "language": {
          "paginate": {
            "previous": "<",
            "next": ">"
          }
        },





        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": host + "../config/get-tables.php",
          "data": {
            "set_tables": "SELECT tgl_ci, nm_kapal, nm_pelabuhan, tipe_muatan, id_ci FROM ((ci JOIN kapal) JOIN pelabuhan) WHERE ci.kd_kapal=kapal.kd_kapal AND ci.kd_pelabuhan=pelabuhan.kd_pelabuhan AND (ci.k_muatan!='Y' OR ci.k_ci!='Y')",
            "query": true
          },
          "type": "POST"
        },
        "columns": [{
            'className': "align-middle text-center",
            "data": "tgl_ci",
            "width": "50px",
          },
          {
            'className': "align-middle",
            "data": "nm_kapal",
          }, {
            'className': "align-middle text-center",
            "data": "nm_pelabuhan",
          }, {
            'className': "align-middle text-center",
            "data": "tipe_muatan",
            "width": "10px",
          }, {
            'className': "align-middle text-center",
            "data": "id_ci",
            "width": "10px",
            "render": function(data, type, row, meta) {
              return '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" id_ci="' + data + '" data-target="#cek-ci"><i class="fa fa-edit"></i></button>';
            }
          }
        ]
      });
      $('#table_fci_filter').hide();
      $('#field_fci').keyup(function() {
        table_fci.columns($('#column_fci').val()).search(this.value).draw();
      });



      $('.modal#cek-co, .modal#cek-ci').on('click', 'button[data-target="#konfirmasi-status"]', function() {
        $("#konfirmasi-status .modal-content .overlay").removeClass("invisible");
        $("#konfirmasi-status .modal-body #send_id").val($(this).attr('send_id'));
        $("#konfirmasi-status .modal-body #k_status").val($(this).attr('k_status'));
        $("#konfirmasi-status .modal-body .font-weight-bold").html($(this).attr('send_text'));
        $("#konfirmasi-status .modal-content .overlay").addClass("invisible");
      });


      $('.modal#konfirmasi-status').on('click', 'button[name="konfirmasi-status"]', function() {
        $("#konfirmasi-status .modal-content .overlay").removeClass("invisible");
        $.ajax({
          type: "POST",
          url: host + "get-data",
          dataType: "JSON",
          data: {
            'set': 'set_status',
            'send_id': $("#konfirmasi-status .modal-body #send_id").val(),
            'k_status': $("#konfirmasi-status .modal-body #k_status").val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              (data['type'] == 'success') ? toastr.success(data['set']): toastr.warning(data['set']);
              $("#cek-co").modal("hide");
              $("#cek-ci").modal("hide");
              table_fco.draw();
              table_fci.draw();
              $("#konfirmasi-status").modal("hide");
            } else {
              toastr.warning('Ada kesalahan pada query, Silahkan cek lagi!!')
            }
          },
          error: function(request, status, error) {
            toastr.error(request.responseText);
          }
        });
        $("#konfirmasi-status .modal-content .overlay").addClass("invisible");
      });

    });
  </script>
</body>

</html>