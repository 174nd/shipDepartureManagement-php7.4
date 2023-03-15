<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'Clearance Out',
  'content' => 'Clearance Out',
  'breadcrumb' => array(
    'Clearance Out' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'Clearance Out');

if (isset($_POST['delete-co'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM co WHERE id_co = '$_POST[id_co]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('co', array('id_co' => $_POST['id_co']));
    if ($query) {
      $_SESSION['notifikasi'] = 'NOT05';
      header("location:" . $df['home'] . "co/");
      exit();
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "co/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "co/");
    exit();
  }
} else if (isset($_GET['id_co'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM co WHERE id_co = '$_GET[id_co]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'tgl_co' => $ada['tgl_co'],
      'kd_kapal' => $ada['kd_kapal'],
      'kd_pelabuhan' => $ada['kd_pelabuhan'],
      'tipe_muatan' => $ada['tipe_muatan'],
      'jns_muatan' => $ada['jns_muatan'],
      'muatan' => $ada['muatan'],
    );
    $pset = array(
      'title' => 'Update Clearance Out',
      'content' => 'Update Clearance Out',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'Clearance Out' => $df['home'] . 'co/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $_POST = setData($_POST);
      $set = array(
        'tgl_co' => $_POST['tgl_co'],
        'kd_kapal' => $_POST['kd_kapal'],
        'kd_pelabuhan' => $_POST['kd_pelabuhan'],
        'tipe_muatan' => $_POST['tipe_muatan'],
        'jns_muatan' => $_POST['jns_muatan'],
        'muatan' => $_POST['muatan'],
      );

      $query = setUpdate($set, 'co', array('id_co' => $_GET['id_co']));
      if (!$query) {
        $_SESSION['notifikasi'] = 'NOT02';
      } else {
        $_SESSION['notifikasi'] = 'NOT04';
        header("location:" . $df['home'] . "co/");
        exit();
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "co/");
    exit();
  }
} else {
  $isiVal = array(
    'tgl_co' => '',
    'kd_kapal' => '',
    'kd_pelabuhan' => '',
    'tipe_muatan' => '',
    'jns_muatan' => '',
    'muatan' => '',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $set = array(
      'tgl_co' => $_POST['tgl_co'],
      'kd_kapal' => $_POST['kd_kapal'],
      'kd_pelabuhan' => $_POST['kd_pelabuhan'],
      'tipe_muatan' => $_POST['tipe_muatan'],
      'jns_muatan' => $_POST['jns_muatan'],
      'muatan' => $_POST['muatan'],
      'k_muatan' => 'N',
      'k_co' => 'N',
    );
    $query = setInsert($set, 'co');
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
                      <li class="list-group-item pt-0" style="border-top: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="tgl_co">Tanggal Clearance Out</label>
                              <div class="input-group">
                                <input type="text" name="tgl_co" id="tgl_co" class="form-control mydatepicker" placeholder="Tanggal Clearance Out" value="<?= $isiVal['tgl_co']; ?>" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 mb-2">
                              <div class="row">
                                <div class="col-12">
                                  <label class="float-right" for="kd_kapal">Kapal</label>
                                </div>
                                <div class="col-12">
                                  <select name="kd_kapal" id="kd_kapal" class="form-control custom-select select2" required>
                                    <?php $cekdata = mysqli_query($conn, "SELECT * FROM kapal WHERE kd_kapal IN (SELECT kd_kapal FROM ci WHERE id_ci NOT IN (SELECT id_ci FROM co)) ORDER BY nm_kapal ASC");
                                    while ($Data = mysqli_fetch_assoc($cekdata)) { ?>
                                      <option value="<?= $Data['kd_kapal']; ?>" <?= cekSama($isiVal['kd_kapal'], $Data['kd_kapal']); ?>><?= $Data['nm_kapal'] . ' (' . $Data['gt_kapal'] . ' / ' . $Data['stt_kapal'] . ')'; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-8 mb-2">
                              <div class="row">
                                <div class="col-12">
                                  <label class="float-right" for="kd_pelabuhan">Pelabuhan Tujuan</label>
                                </div>
                                <div class="col-12">
                                  <select name="kd_pelabuhan" id="kd_pelabuhan" class="form-control custom-select select2">
                                    <?php $cekdata = mysqli_query($conn, "SELECT * FROM pelabuhan ORDER BY nm_pelabuhan ASC");
                                    while ($Data = mysqli_fetch_assoc($cekdata)) { ?>
                                      <option value="<?= $Data['kd_pelabuhan']; ?>" <?= cekSama($isiVal['kd_pelabuhan'], $Data['kd_pelabuhan']); ?>><?= $Data['nm_pelabuhan'] . ' (' . $Data['stt_pelabuhan'] . ')'; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 mb-2">
                              <label class="float-right" for="tipe_muatan">Tipe Muatan</label>
                              <select name="tipe_muatan" id="tipe_muatan" class="form-control custom-select">
                                <option <?= cekSama($isiVal['tipe_muatan'], 'N'); ?>>N</option>
                                <option <?= cekSama($isiVal['tipe_muatan'], 'G'); ?>>G</option>
                                <option <?= cekSama($isiVal['tipe_muatan'], 'T'); ?>>T</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12 mb-2">
                              <label class="float-right" for="jns_muatan">Jenis Muatan</label>
                              <input type="<?= ($isiVal['tipe_muatan'] == 'T') ? 'number' : 'text'; ?>" name="jns_muatan" class="form-control" id="jns_muatan" placeholder="Jenis Muatan" value="<?= $isiVal['jns_muatan']; ?>" <?php if ($isiVal['tipe_muatan'] == 'N' || $isiVal['tipe_muatan'] == '') echo 'disabled'; ?>>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item pb-0" style="border-bottom: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12">
                              <label class="float-right" for="muatan">Muatan</label>
                              <textarea name="muatan" id="muatan" class="form-control" placeholder="Muatan"><?= $isiVal['muatan']; ?></textarea>
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
                      <div class="col-md-4 mb-2">
                        <select id="column_co" class="form-control custom-select">
                          <option value="1">Pelabuhan Tujuan</option>
                          <option value="2">Nama Kapal</option>
                          <option value="0">Clearance Out</option>
                          <option value="3">Tipe</option>
                        </select>
                      </div>
                      <div class="col-md-8 mb-2">
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_co">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_co" class="table table-bordered table-hover" style="min-width: 610px;width: 100%;">
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





    <div class="modal fade" id="delete-co">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus co</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus co ini?</h4>
            <input type="hidden" name="id_co" id="did_co">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-co" class="btn btn-outline-danger">Hapus</button>
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
      var table_co = $('#table_co').DataTable({
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
            "set_tables": "SELECT tgl_co, nm_kapal, nm_pelabuhan, co.tipe_muatan, id_co FROM (((co JOIN ci) JOIN kapal) JOIN pelabuhan) WHERE co.id_ci=ci.id_ci AND ci.kd_kapal=kapal.kd_kapal AND co.kd_pelabuhan=pelabuhan.kd_pelabuhan",
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
            'className': "align-middle",
            "data": "id_co",
            "width": "10px",
            "render": function(data, type, row, meta) {
              return '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$(\'#did_co\').val(\'' + data + '\')" data-target="#delete-co"><i class="fa fa-trash-alt"></i></button><a href="' + host + 'co/' + data + '" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>';
            }
          }
        ]
      });
      $('#table_co_filter').hide();
      $('#field_co').keyup(function() {
        table_co.columns($('#column_co').val()).search(this.value).draw();
      });
      $('#tipe_muatan').change(function() {
        if (this.value == 'N') {
          $('#jns_muatan').attr('type', 'text');
          $('#jns_muatan').attr('disabled', true);
        } else if (this.value == 'G') {
          $('#jns_muatan').attr('type', 'text');
          $('#jns_muatan').attr('disabled', false);
        } else {
          $('#jns_muatan').attr('type', 'number');
          $('#jns_muatan').attr('disabled', false);
        }
      });
    });
  </script>
</body>

</html>