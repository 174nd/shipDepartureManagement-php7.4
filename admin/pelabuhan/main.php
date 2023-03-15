<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'Pelabuhan',
  'content' => 'Pelabuhan',
  'breadcrumb' => array(
    'Pelabuhan' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'Pelabuhan');

if (isset($_POST['delete-pelabuhan'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM pelabuhan WHERE kd_pelabuhan = '$_POST[kd_pelabuhan]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('pelabuhan', array('kd_pelabuhan' => $_POST['kd_pelabuhan']));
    if ($query) {
      $_SESSION['notifikasi'] = 'NOT05';
      header("location:" . $df['home'] . "pelabuhan/");
      exit();
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "pelabuhan/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "pelabuhan/");
    exit();
  }
} else if (isset($_GET['kd_pelabuhan'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM pelabuhan WHERE kd_pelabuhan = '$_GET[kd_pelabuhan]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'nm_pelabuhan' =>  $ada['nm_pelabuhan'],
      'stt_pelabuhan' =>  $ada['stt_pelabuhan'],
    );
    $pset = array(
      'title' => 'Update pelabuhan',
      'content' => 'Update pelabuhan',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'pelabuhan' => $df['home'] . 'pelabuhan/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $_POST = setData($_POST);
      $set = array(
        'nm_pelabuhan' =>  $_POST['nm_pelabuhan'],
        'stt_pelabuhan' =>  $_POST['stt_pelabuhan'],
      );

      $query = setUpdate($set, 'pelabuhan', array('kd_pelabuhan' => $_GET['kd_pelabuhan']));
      if (!$query) {
        $_SESSION['notifikasi'] = 'NOT02';
      } else {
        $_SESSION['notifikasi'] = 'NOT04';
        header("location:" . $df['home'] . "pelabuhan/");
        exit();
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "pelabuhan/");
    exit();
  }
} else {
  $isiVal = array(
    'nm_pelabuhan' => '',
    'stt_pelabuhan' => '',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $set = array(
      'kd_pelabuhan' =>  setKode('P', 10, 'pelabuhan', 'kd_pelabuhan'),
      'nm_pelabuhan' =>  $_POST['nm_pelabuhan'],
      'stt_pelabuhan' =>  $_POST['stt_pelabuhan'],
    );
    $query = setInsert($set, 'pelabuhan');
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
                      <li class="list-group-item pelabuhan-0" style="border-top: 0; border-bottom: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-10">
                              <label class="float-right" for="nm_pelabuhan">Nama Pelabuhan</label>
                              <input type="text" name="nm_pelabuhan" class="form-control" id="nm_pelabuhan" placeholder="Nama Pelabuhan" value="<?= $isiVal['nm_pelabuhan']; ?>" required>
                            </div>
                            <div class="col-md-2">
                              <label class="float-right" for="stt_pelabuhan">Status</label>
                              <select name="stt_pelabuhan" id="stt_pelabuhan" class="form-control custom-select">
                                <option <?= cekSama($isiVal['stt_pelabuhan'], 'T'); ?>>T</option>
                                <option <?= cekSama($isiVal['stt_pelabuhan'], 'L'); ?>>L</option>
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
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_pelabuhan">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_pelabuhan" class="table table-bordered table-hover" style="min-width: 300px; width:100%;">
                        <thead>
                          <tr>
                            <th>Nama Pelabuhan</th>
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





    <div class="modal fade" id="delete-pelabuhan">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus pelabuhan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus pelabuhan ini?</h4>
            <input type="hidden" name="kd_pelabuhan" id="dkd_pelabuhan">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-pelabuhan" class="btn btn-outline-danger">Hapus</button>
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
      var table_pelabuhan = $('#table_pelabuhan').DataTable({
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
            "set_tables": "pelabuhan"
          },
          "type": "POST"
        },
        "columns": [{
            'className': "align-middle",
            "data": "nm_pelabuhan",
          },
          {
            'className': "align-middle text-center",
            "data": "stt_pelabuhan",
            "width": "30px",
          }, {
            'className': "align-middle",
            "data": "kd_pelabuhan",
            "width": "30px",
            "render": function(data, type, row, meta) {
              return '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$(\'#dkd_pelabuhan\').val(\'' + data + '\')" data-target="#delete-pelabuhan"><i class="fa fa-trash-alt"></i></button><a href="' + host + 'pelabuhan/' + data + '" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>';
            }
          }
        ]
      });
      $('#table_pelabuhan_filter').hide();
      $('#field_pelabuhan').keyup(function() {
        table_pelabuhan.columns(0).search(this.value).draw();
      });
    });
  </script>
</body>

</html>