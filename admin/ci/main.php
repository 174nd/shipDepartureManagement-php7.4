<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'Clearance In',
  'content' => 'Clearance In',
  'breadcrumb' => array(
    'Clearance In' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'Clearance In');

if (isset($_POST['delete-ci'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM ci WHERE id_ci = '$_POST[id_ci]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('ci', ['id_ci' => $_POST['id_ci']]) && setDelete('co', ['id_ci' => $_POST['id_ci']]);
    if ($query) {
      $_SESSION['notifikasi'] = 'NOT05';
      header("location:" . $df['home'] . "ci/");
      exit();
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "ci/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "ci/");
    exit();
  }
} else if (isset($_GET['id_ci'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM ci WHERE id_ci = '$_GET[id_ci]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'tgl_ci' => $ada['tgl_ci'],
      'kd_kapal' => $ada['kd_kapal'],
      'kd_pelabuhan' => $ada['kd_pelabuhan'],
      'tipe_muatan' => $ada['tipe_muatan'],
      'jns_muatan' => $ada['jns_muatan'],
      'muatan' => $ada['muatan'],
    );
    $pset = array(
      'title' => 'Update Clearance In',
      'content' => 'Update Clearance In',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'Clearance In' => $df['home'] . 'ci/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $_POST = setData($_POST);
      $set = array(
        'tgl_ci' => $_POST['tgl_ci'],
        'kd_kapal' => $_POST['kd_kapal'],
        'kd_pelabuhan' => $_POST['kd_pelabuhan'],
        'tipe_muatan' => $_POST['tipe_muatan'],
        'jns_muatan' => $_POST['jns_muatan'],
        'muatan' => $_POST['muatan'],
      );

      $query = setUpdate($set, 'ci', array('id_ci' => $_GET['id_ci']));
      if (!$query) {
        $_SESSION['notifikasi'] = 'NOT02';
      } else {
        $_SESSION['notifikasi'] = 'NOT04';
        header("location:" . $df['home'] . "ci/");
        exit();
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "ci/");
    exit();
  }
} else {
  $isiVal = array(
    'tgl_ci' => '',
    'kd_kapal' => '',
    'kd_pelabuhan' => '',
    'tipe_muatan' => '',
    'jns_muatan' => '',
    'muatan' => '',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $set = array(
      'tgl_ci' => $_POST['tgl_ci'],
      'kd_kapal' => $_POST['kd_kapal'],
      'kd_pelabuhan' => $_POST['kd_pelabuhan'],
      'tipe_muatan' => $_POST['tipe_muatan'],
      'jns_muatan' => $_POST['jns_muatan'],
      'muatan' => $_POST['muatan'],
      'k_muatan' => 'N',
      'k_ci' => 'N',
    );
    $query = setInsert($set, 'ci');
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
                              <label class="float-right" for="tgl_ci">Tanggal Clearance In</label>
                              <div class="input-group">
                                <input type="text" name="tgl_ci" id="tgl_ci" class="form-control mydatepicker" placeholder="Tanggal Clearance In" value="<?= $isiVal['tgl_ci']; ?>" required>
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
                                  <select name="kd_kapal" id="kd_kapal" class="form-control custom-select select2">
                                    <?php $cekdata = mysqli_query($conn, "SELECT * FROM kapal WHERE kd_kapal NOT IN (SELECT kd_kapal FROM ci WHERE id_ci NOT IN (SELECT id_ci FROM co) AND kd_kapal!='$isiVal[kd_kapal]') ORDER BY nm_kapal ASC");
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
                                  <label class="float-right" for="kd_pelabuhan">Pelabuhan Asal</label>
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
                        <select id="column_ci" class="form-control custom-select">
                          <option value="1">Pelabuhan Asal</option>
                          <option value="2">Nama Kapal</option>
                          <option value="0">Clearance In</option>
                          <option value="3">Tipe</option>
                        </select>
                      </div>
                      <div class="col-md-8 mb-2">
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_ci">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_ci" class="table table-bordered table-hover" style="min-width: 610px;width: 100%;">
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





    <div class="modal fade" id="delete-ci">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus ci</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus ci ini? Jika Anda Menghapus Clearance In ini maka akan menghapus Keberangkatan dari kapal ini juga</h4>
            <input type="hidden" name="id_ci" id="did_ci">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-ci" class="btn btn-outline-danger">Hapus</button>
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
      var table_ci = $('#table_ci').DataTable({
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
            "set_tables": "SELECT tgl_ci, nm_kapal, nm_pelabuhan, tipe_muatan, id_ci FROM ((ci JOIN kapal) JOIN pelabuhan) WHERE ci.kd_kapal=kapal.kd_kapal AND ci.kd_pelabuhan=pelabuhan.kd_pelabuhan",
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
            'className': "align-middle",
            "data": "id_ci",
            "width": "10px",
            "render": function(data, type, row, meta) {
              return '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$(\'#did_ci\').val(\'' + data + '\')" data-target="#delete-ci"><i class="fa fa-trash-alt"></i></button><a href="' + host + 'ci/' + data + '" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>';
            }
          }
        ]
      });
      $('#table_ci_filter').hide();
      $('#field_ci').keyup(function() {
        table_ci.columns($('#column_ci').val()).search(this.value).draw();
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