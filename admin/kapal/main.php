<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'Kapal',
  'content' => 'Kapal',
  'breadcrumb' => array(
    'Kapal' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'Kapal');

if (isset($_POST['delete-kapal'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM kapal WHERE kd_kapal = '$_POST[kd_kapal]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('kapal', array('kd_kapal' => $_POST['kd_kapal']));
    if ($query) {
      $_SESSION['notifikasi'] = 'NOT05';
      header("location:" . $df['home'] . "kapal/");
      exit();
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "kapal/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "kapal/");
    exit();
  }
} else if (isset($_GET['kd_kapal'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM kapal WHERE kd_kapal = '$_GET[kd_kapal]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'nm_kapal' =>  $ada['nm_kapal'],
      'gt_kapal' =>  $ada['gt_kapal'],
      'stt_kapal' =>  $ada['stt_kapal'],
    );
    $pset = array(
      'title' => 'Update kapal',
      'content' => 'Update kapal',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'kapal' => $df['home'] . 'kapal/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $_POST = setData($_POST);
      $set = array(
        'nm_kapal' =>  $_POST['nm_kapal'],
        'gt_kapal' =>  $_POST['gt_kapal'],
        'stt_kapal' =>  $_POST['stt_kapal'],
      );

      $query = setUpdate($set, 'kapal', array('kd_kapal' => $_GET['kd_kapal']));
      if (!$query) {
        $_SESSION['notifikasi'] = 'NOT02';
      } else {
        $_SESSION['notifikasi'] = 'NOT04';
        header("location:" . $df['home'] . "kapal/");
        exit();
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "kapal/");
    exit();
  }
} else {
  $isiVal = array(
    'nm_kapal' => '',
    'gt_kapal' => '',
    'stt_kapal' => '',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $set = array(
      'kd_kapal' =>  setKode('K', 10, 'kapal', 'kd_kapal'),
      'nm_kapal' =>  $_POST['nm_kapal'],
      'gt_kapal' =>  $_POST['gt_kapal'],
      'stt_kapal' =>  $_POST['stt_kapal'],
    );
    $query = setInsert($set, 'kapal');
    if (!$query) {
      $_SESSION['notifikasi'] = 'NOT02';
    } else {
      $_SESSION['notifikasi'] = 'NOT03';
    }
  }
}


?>
<!DOCTYPE html>
<html>

<head>
  <?php include $backurl . 'config/site/head.php'; ?>
</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm">
  <div class="wrapper">
    <?php include $backurl . 'admin/config/header-sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php include $backurl . 'admin/config/content-header.php'; ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="card card-primary card-outline">
                  <div class="card-body">
                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item kapal-0" style="border-top: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12 mb-2">
                              <label class="float-right" for="nm_kapal">Nama Kapal</label>
                              <input type="text" name="nm_kapal" class="form-control" id="nm_kapal" placeholder="Nama Kapal" value="<?= $isiVal['nm_kapal']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item kapal-0" style="border-bottom: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-10">
                              <label class="float-right" for="gt_kapal">GT Kapal</label>
                              <input type="number" name="gt_kapal" class="form-control" id="gt_kapal" placeholder="GT Kapal" value="<?= $isiVal['gt_kapal']; ?>" required>
                            </div>
                            <div class="col-md-2">
                              <label class="float-right" for="stt_kapal">Status</label>
                              <select name="stt_kapal" id="stt_kapal" class="form-control custom-select">
                                <option <?= cekSama($isiVal['stt_kapal'], 'M'); ?>>M</option>
                                <option <?= cekSama($isiVal['stt_kapal'], 'C'); ?>>C</option>
                                <option <?= cekSama($isiVal['stt_kapal'], 'K'); ?>>K</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="Simpan" class="btn btn-block btn-primary">Simpan</button>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="card card-primary card-outline">
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-md-12 mb-2">
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_kapal">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_kapal" class="table table-bordered table-hover" style="min-width: 400px; width:100%;">
                        <thead>
                          <tr>
                            <th>Nama Kapal</th>
                            <th>GT</th>
                            <th>STT</th>
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
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





    <div class="modal fade" id="delete-kapal">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus kapal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus kapal ini?</h4>
            <input type="hidden" name="kd_kapal" id="dkd_kapal">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-kapal" class="btn btn-outline-danger">Hapus</button>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </form>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php include $backurl . 'admin/config/modal.php'; ?>
    <?php include $backurl . 'config/site/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php include $backurl . 'config/site/script.php'; ?>
  <!-- page script -->
  <script>
    $(function() {
      var host = "<?= $df['home'] ?>";
      var table_kapal = $('#table_kapal').DataTable({
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
            "set_tables": "kapal"
          },
          "type": "POST"
        },
        "columns": [{
            'className': "align-middle",
            "data": "nm_kapal",
          },
          {
            'className': "align-middle text-center",
            "data": "gt_kapal",
            "width": "30px",
          }, {
            'className': "align-middle text-center",
            "data": "stt_kapal",
            "width": "30px",
          }, {
            'className': "align-middle",
            "data": "kd_kapal",
            "width": "30px",
            "render": function(data, type, row, meta) {
              return '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$(\'#dkd_kapal\').val(\'' + data + '\')" data-target="#delete-kapal"><i class="fa fa-trash-alt"></i></button><a href="' + host + 'kapal/' + data + '" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>';
            }
          }
        ]
      });
      $('#table_kapal_filter').hide();
      $('#field_kapal').keyup(function() {
        table_kapal.columns(0).search(this.value).draw();
      });
    });
  </script>
</body>

</html>