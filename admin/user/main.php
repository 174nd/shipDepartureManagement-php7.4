<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'User',
  'content' => 'User',
  'breadcrumb' => array(
    'User' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'User');
if (isset($_POST['delete-user'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$_POST[id_user]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('user', array('id_user' => $_POST['id_user']));
    if ($query) {
      $_SESSION['notifikasi'] = 'NOT05';
      header("location:" . $df['home'] . "user/");
      exit();
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "user/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "user/");
    exit();
  }
} else if (isset($_GET['id_user'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$_GET[id_user]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'uss' => $ada['uss'],
      'pass' => $ada['pass'],
      'nm_user' => $ada['nm_user'],
      'jabatan_user' => $ada['jabatan_user'],
      'foto_user' => ($ada['foto_user'] == null) ? "Choose file" : substr($ada['foto_user'], strlen($ada['uss'] . ' - ')),
      'asal_foto_user' =>  $ada['foto_user'],
    );
    $pset = array(
      'title' => 'Update user',
      'content' => 'Update user',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'user' => $df['home'] . 'user/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $cekdata = mysqli_query($conn, "SELECT * FROM login WHERE username = '$_POST[uss]' AND  username NOT LIKE '$ada[uss]'");
      if (mysqli_num_rows($cekdata) == 0) {
        $upFile = uploadFile($_FILES['foto_user'], array('jpg', 'jpeg', 'png'), $backurl . "uploads/user", $_POST['id_user'] . ' - ', $isiVal['asal_foto_user']);
        if ($upFile != 'Wrong Extension') {
          $upFile = ($upFile == $isiVal['asal_foto_user']) ? renameFile($backurl . "uploads/user", $_POST['uss'] . ' - ', $isiVal['asal_foto_user'], " - ") : $upFile;
          $_POST = setData($_POST);
          $set = array(
            'uss' => $_POST['uss'],
            'pass' => $_POST['pass'],
            'nm_user' => $_POST['nm_user'],
            'jabatan_user' => $_POST['jabatan_user'],
            'foto_user' => $upFile,
          );

          $query = setUpdate($set, 'user', array('id_user' => $_GET['id_user']));
          if (!$query) {
            $_SESSION['notifikasi'] = 'NOT02';
          } else {
            $_SESSION['notifikasi'] = 'NOT04';
            header("location:" . $df['home'] . "user/");
            exit();
          }
        } else {
          $_SESSION['notifikasi'] = 'NOT07';
          $isiVal = array(
            'uss' => $_POST['uss'],
            'pass' => $_POST['pass'],
            'nm_user' => $_POST['nm_user'],
            'jabatan_user' => $_POST['jabatan_user'],
            'foto_user' => ($ada['foto_user'] == null) ? "Choose file" : substr($ada['foto_user'], strlen($ada['uss'] . ' - ')),
          );
        }
      } else {
        $_SESSION['notifikasi'] = 'NOT11';
        $isiVal = array(
          'uss' => $_POST['uss'],
          'pass' => $_POST['pass'],
          'nm_user' => $_POST['nm_user'],
          'jabatan_user' => $_POST['jabatan_user'],
          'foto_user' => ($ada['foto_user'] == null) ? "Choose file" : substr($ada['foto_user'], strlen($ada['uss'] . ' - ')),
        );
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "user/");
    exit();
  }
} else {
  $isiVal = array(
    'uss' => '',
    'pass' => '',
    'nm_user' => '',
    'jabatan_user' => '',
    'foto_user' => 'Choose file',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $cekdata = mysqli_query($conn, "SELECT * FROM login WHERE username = '$_POST[uss]'");
    $upFile = uploadFile($_FILES['foto_user'], array('jpg', 'jpeg', 'png'), $backurl . "uploads/user", $_POST['uss'] . ' - ');
    if (mysqli_num_rows($cekdata) == 0) {
      if ($upFile != 'Wrong Extension') {
        $set = array(
          'uss' => $_POST['uss'],
          'pass' => $_POST['pass'],
          'nm_user' => $_POST['nm_user'],
          'jabatan_user' => $_POST['jabatan_user'],
          'foto_user' => $upFile,
        );
        $query = setInsert($set, 'user');
        if (!$query) {
          $_SESSION['notifikasi'] = 'NOT02';
        } else {
          $_SESSION['notifikasi'] = 'NOT03';
        }
      } else {
        $_SESSION['notifikasi'] = 'NOT07';
        $isiVal = array(
          'uss' => $_POST['uss'],
          'pass' => $_POST['pass'],
          'nm_user' => $_POST['nm_user'],
          'jabatan_user' => $_POST['jabatan_user'],
          'foto_user' => $upFile,
        );
      }
    } else {
      $_SESSION['notifikasi'] = 'NOT11';
      $isiVal = array(
        'uss' => $_POST['uss'],
        'pass' => $_POST['pass'],
        'nm_user' => $_POST['nm_user'],
        'jabatan_user' => $_POST['jabatan_user'],
        'foto_user' => $upFile,
      );
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
                              <label class="float-right" for="uss">Username</label>
                              <input type="text" name="uss" class="form-control" id="uss" placeholder="Username" value="<?= $isiVal['uss']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="pass">Password</label>
                              <input type="text" name="pass" class="form-control" id="pass" placeholder="Password" value="<?= $isiVal['pass']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12 mb-2">
                              <label class="float-right" for="nm_user">Nama User</label>
                              <input type="text" name="nm_user" class="form-control" id="nm_user" placeholder="Nama User" value="<?= $isiVal['nm_user']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12 mb-2">
                              <label class="float-right" for="jabatan_user">Jabatan User</label>
                              <input type="text" name="jabatan_user" class="form-control" id="jabatan_user" placeholder="Jabatan User" value="<?= $isiVal['jabatan_user']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item pb-0" style="border-bottom: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12">
                              <label class="float-right" for="foto_user">Foto User</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="foto_user" class="custom-file-input" id="foto_user">
                                  <label class="custom-file-label" for="foto_user"><?= $isiVal['foto_user']; ?></label>
                                </div>
                              </div>
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
                        <select id="column_user" class="form-control custom-select">
                          <option value="0">Username</option>
                          <option value="1">Nama User</option>
                        </select>
                      </div>
                      <div class="col-md-8 mb-2">
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_user">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_user" class="table table-bordered table-hover" style="min-width: 400px;">
                        <thead>
                          <tr>
                            <th>Username</th>
                            <th>Nama User</th>
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





    <div class="modal fade" id="delete-user">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus user</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus user ini?</h4>
            <input type="hidden" name="id_user" id="did_user">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-user" class="btn btn-outline-danger">Hapus</button>
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
      var table_user = $('#table_user').DataTable({
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
            "set_tables": "user"
          },
          "type": "POST"
        },
        "columns": [{
            'className': "align-middle text-center",
            "data": "uss",
            "width": "100px",
          },
          {
            'className': "align-middle",
            "data": "nm_user",
          }, {
            'className': "align-middle",
            "data": "id_user",
            "width": "50px",
            "render": function(data, type, row, meta) {
              return '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$(\'#did_user\').val(\'' + data + '\')" data-target="#delete-user"><i class="fa fa-trash-alt"></i></button><a href="' + host + 'user/' + data + '" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>';
            }
          }
        ]
      });
      $('#table_user_filter').hide();
      $('#field_user').keyup(function() {
        table_user.columns($('#column_user').val()).search(this.value).draw();
      });
    });
  </script>
</body>

</html>