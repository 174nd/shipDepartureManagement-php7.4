<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
$pset = array(
  'title' => 'Karyawan',
  'content' => 'Karyawan',
  'breadcrumb' => array(
    'Karyawan' => 'active',
  ),
);

$setSidebar = activedSidebar($setSidebar, 'Karyawan');
if (isset($_POST['delete-karyawan'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM karyawan WHERE nup = '$_POST[nup]'");
  if (mysqli_num_rows($cekdata) > 0) {
    $query = setDelete('karyawan', array('nup' => $_POST['nup']));
    if ($query) {
      $set = true;
      $query = mysqli_query($conn, "SELECT * FROM kontrak WHERE nup = '$_POST[nup]'");
      while ($kontrak = mysqli_fetch_assoc($query)) {
        if (!setDelete('jabatan', array('id_kontrak' => $kontrak['id_kontrak']))) $set = false;
      }
      if ($set) {
        $query = setDelete('kontrak', array('nup' => $_POST['nup']));
        if ($query) {
          $_SESSION['notifikasi'] = 'NOT05';
          header("location:" . $df['home'] . "karyawan/");
          exit();
        } else {
          $_SESSION['notifikasi'] = 'NOT02';
          header("location:" . $df['home'] . "karyawan/");
          exit();
        }
      }
    } else {
      $_SESSION['notifikasi'] = 'NOT02';
      header("location:" . $df['home'] . "karyawan/");
      exit();
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "karyawan/");
    exit();
  }
} else if (isset($_GET['nup'])) {
  $cekdata = mysqli_query($conn, "SELECT * FROM karyawan WHERE nup = '$_GET[nup]'");
  $ada = mysqli_fetch_assoc($cekdata);
  if (mysqli_num_rows($cekdata) > 0) {
    $isiVal = array(
      'nup' => $ada['nup'],
      'pass' => $ada['pass'],
      'nm_karyawan' => $ada['nm_karyawan'],
      'tgl_lahir' => $ada['tgl_lahir'],
      'tmpt_lahir' => $ada['tmpt_lahir'],
      'jk_karyawan' => $ada['jk_karyawan'],
      'agama' => $ada['agama'],
      'pendidikan' => $ada['pendidikan'],
      'status_pernikahan' => $ada['status_pernikahan'],
      'goldar' => $ada['goldar'],
      'no_telp' => $ada['no_telp'],
      'email' => $ada['email'],
      'nik' => $ada['nik'],
      'almt_karyawan' => $ada['almt_karyawan'],
      'foto_karyawan' => ($ada['foto_karyawan'] == null) ? "Choose file" : substr($ada['foto_karyawan'], strlen($ada['nup'] . ' - ')),
      'asal_foto_karyawan' =>  $ada['foto_karyawan'],
    );
    $pset = array(
      'title' => 'Update karyawan',
      'content' => 'Update karyawan',
      'breadcrumb' => array(
        'Dashboard' => $df['home'],
        'karyawan' => $df['home'] . 'karyawan/',
        'Update' => 'active',
      ),
    );

    if (isset($_POST["Simpan"])) {
      $cekdata = mysqli_query($conn, "SELECT * FROM karyawan WHERE nup = '$_POST[nup]' AND  nup NOT LIKE '$_GET[nup]'");
      if (mysqli_num_rows($cekdata) == 0) {
        $upFile = uploadFile($_FILES['foto_karyawan'], array('jpg', 'jpeg', 'png'), $backurl . "uploads/karyawan", $_POST['nup'] . ' - ', $isiVal['asal_foto_karyawan']);
        if ($upFile != 'Wrong Extension') {
          $upFile = ($upFile == $isiVal['asal_foto_karyawan']) ? renameFile($backurl . "uploads/karyawan", $_POST['nup'] . ' - ', $isiVal['asal_foto_karyawan'], " - ") : $upFile;
          $_POST = setData($_POST);
          $set = array(
            'nup' => $_POST['nup'],
            'pass' => $_POST['pass'],
            'nm_karyawan' => $_POST['nm_karyawan'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'tmpt_lahir' => $_POST['tmpt_lahir'],
            'jk_karyawan' => $_POST['jk_karyawan'],
            'agama' => $_POST['agama'],
            'pendidikan' => $_POST['pendidikan'],
            'status_pernikahan' => $_POST['status_pernikahan'],
            'goldar' => $_POST['goldar'],
            'no_telp' => $_POST['no_telp'],
            'email' => $_POST['email'],
            'nik' => $_POST['nik'],
            'almt_karyawan' => $_POST['almt_karyawan'],
            'foto_karyawan' => $upFile,
          );

          $query = setUpdate($set, 'karyawan', array('nup' => $_GET['nup'])) && setUpdate(array('nup' => $_POST['nup']), 'kontrak', array('nup' => $_GET['nup']));
          if (!$query) {
            $_SESSION['notifikasi'] = 'NOT02';
          } else {
            $_SESSION['notifikasi'] = 'NOT04';
            header("location:" . $df['home'] . "karyawan/");
            exit();
          }
        } else {
          $_SESSION['notifikasi'] = 'NOT07';
          $isiVal = array(
            'nup' => $_POST['nup'],
            'pass' => $_POST['pass'],
            'nm_karyawan' => $_POST['nm_karyawan'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'tmpt_lahir' => $_POST['tmpt_lahir'],
            'jk_karyawan' => $_POST['jk_karyawan'],
            'agama' => $_POST['agama'],
            'pendidikan' => $_POST['pendidikan'],
            'status_pernikahan' => $_POST['status_pernikahan'],
            'goldar' => $_POST['goldar'],
            'no_telp' => $_POST['no_telp'],
            'email' => $_POST['email'],
            'nik' => $_POST['nik'],
            'almt_karyawan' => $_POST['almt_karyawan'],
            'foto_karyawan' => ($ada['foto_karyawan'] == null) ? "Choose file" : substr($ada['foto_karyawan'], strlen($ada['nup'] . ' - ')),
          );
        }
      } else {
        $_SESSION['notifikasi'] = 'NOT10';
        $isiVal = array(
          'nup' => $_POST['nup'],
          'pass' => $_POST['pass'],
          'nm_karyawan' => $_POST['nm_karyawan'],
          'tgl_lahir' => $_POST['tgl_lahir'],
          'tmpt_lahir' => $_POST['tmpt_lahir'],
          'jk_karyawan' => $_POST['jk_karyawan'],
          'agama' => $_POST['agama'],
          'pendidikan' => $_POST['pendidikan'],
          'status_pernikahan' => $_POST['status_pernikahan'],
          'goldar' => $_POST['goldar'],
          'no_telp' => $_POST['no_telp'],
          'email' => $_POST['email'],
          'nik' => $_POST['nik'],
          'almt_karyawan' => $_POST['almt_karyawan'],
          'foto_karyawan' => ($ada['foto_karyawan'] == null) ? "Choose file" : substr($ada['foto_karyawan'], strlen($ada['nup'] . ' - ')),
        );
      }
    }
  } else {
    $_SESSION['notifikasi'] = 'NOT02';
    header("location:" . $df['home'] . "karyawan/");
    exit();
  }
} else {
  $isiVal = array(
    'nup' => '',
    'pass' => '',
    'nm_karyawan' => '',
    'tgl_lahir' => '',
    'tmpt_lahir' => '',
    'jk_karyawan' => '',
    'agama' => '',
    'pendidikan' => '',
    'status_pernikahan' => '',
    'goldar' => '',
    'no_telp' => '',
    'email' => '',
    'nik' => '',
    'almt_karyawan' => '',
    'foto_karyawan' => 'Choose file',
  );
  if (isset($_POST["Simpan"])) {
    $_POST = setData($_POST);
    $cekdata = mysqli_query($conn, "SELECT * FROM karyawan WHERE nup = '$_POST[nup]'");
    $upFile = uploadFile($_FILES['foto_karyawan'], array('jpg', 'jpeg', 'png'), $backurl . "uploads/karyawan", $_POST['nup'] . ' - ');
    if (mysqli_num_rows($cekdata) == 0) {
      if ($upFile != 'Wrong Extension') {
        $set = array(
          'nup' => $_POST['nup'],
          'pass' => $_POST['pass'],
          'nm_karyawan' => $_POST['nm_karyawan'],
          'tgl_lahir' => $_POST['tgl_lahir'],
          'tmpt_lahir' => $_POST['tmpt_lahir'],
          'jk_karyawan' => $_POST['jk_karyawan'],
          'agama' => $_POST['agama'],
          'pendidikan' => $_POST['pendidikan'],
          'status_pernikahan' => $_POST['status_pernikahan'],
          'goldar' => $_POST['goldar'],
          'no_telp' => $_POST['no_telp'],
          'email' => $_POST['email'],
          'nik' => $_POST['nik'],
          'almt_karyawan' => $_POST['almt_karyawan'],
          'foto_karyawan' => $upFile,
        );
        $set = array(
          'nup' => $_POST['nup'],
          'pass' => $_POST['pass'],
          'foto_karyawan' => $upFile,
          'nm_karyawan' => $_POST['nm_karyawan'],
          'jk_karyawan' => $_POST['jk_karyawan'],
          'tmpt_lahir' => $_POST['tmpt_lahir'],
          'tgl_lahir' => $_POST['tgl_lahir'],
          'pendidikan' => $_POST['pendidikan'],
          'goldar' => $_POST['goldar'],
          'agama' => $_POST['agama'],
          'status_pernikahan' => $_POST['status_pernikahan'],
          'no_telp' => $_POST['no_telp'],
          'email' => $_POST['email'],
          'almt_karyawan' => $_POST['almt_karyawan'],
          'nik' => $_POST['nik'],
        );
        $query = setInsert($set, 'karyawan');
        if (!$query) {
          $_SESSION['notifikasi'] = 'NOT02';
        } else {
          $_SESSION['notifikasi'] = 'NOT03';
        }
      } else {
        $_SESSION['notifikasi'] = 'NOT07';
        $isiVal = array(
          'nup' => $_POST['nup'],
          'pass' => $_POST['pass'],
          'nm_karyawan' => $_POST['nm_karyawan'],
          'tgl_lahir' => $_POST['tgl_lahir'],
          'tmpt_lahir' => $_POST['tmpt_lahir'],
          'jk_karyawan' => $_POST['jk_karyawan'],
          'agama' => $_POST['agama'],
          'pendidikan' => $_POST['pendidikan'],
          'status_pernikahan' => $_POST['status_pernikahan'],
          'goldar' => $_POST['goldar'],
          'no_telp' => $_POST['no_telp'],
          'email' => $_POST['email'],
          'nik' => $_POST['nik'],
          'almt_karyawan' => $_POST['almt_karyawan'],
          'foto_karyawan' => 'Choose file',
        );
      }
    } else {
      $_SESSION['notifikasi'] = 'NOT10';
      $isiVal = array(
        'nup' => $_POST['nup'],
        'pass' => $_POST['pass'],
        'nm_karyawan' => $_POST['nm_karyawan'],
        'tgl_lahir' => $_POST['tgl_lahir'],
        'tmpt_lahir' => $_POST['tmpt_lahir'],
        'jk_karyawan' => $_POST['jk_karyawan'],
        'agama' => $_POST['agama'],
        'pendidikan' => $_POST['pendidikan'],
        'status_pernikahan' => $_POST['status_pernikahan'],
        'goldar' => $_POST['goldar'],
        'no_telp' => $_POST['no_telp'],
        'email' => $_POST['email'],
        'nik' => $_POST['nik'],
        'almt_karyawan' => $_POST['almt_karyawan'],
        'foto_karyawan' => 'Choose file',
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
                              <label class="float-right" for="nup">NUP</label>
                              <input type="text" name="nup" class="form-control" id="nup" placeholder="NIK" value="<?= $isiVal['nup']; ?>" required>
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
                              <label class="float-right" for="nm_karyawan">Nama Karyawan</label>
                              <input type="text" name="nm_karyawan" class="form-control" id="nm_karyawan" placeholder="Nama Karyawan" value="<?= $isiVal['nm_karyawan']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="tgl_lahir">Tanggal Lahir</label>
                              <div class="input-group">
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control mydatepicker" placeholder="Tanggal Lahir" value="<?= $isiVal['tgl_lahir']; ?>" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="tmpt_lahir">Tempat Lahir</label>
                              <input type="text" name="tmpt_lahir" class="form-control" id="tmpt_lahir" placeholder="Tempat Lahir" value="<?= $isiVal['tmpt_lahir']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="jk_karyawan">Jenis Kelamin</label>
                              <select name="jk_karyawan" id="jk_karyawan" class="form-control custom-select">
                                <option <?= cekSama($isiVal['jk_karyawan'], 'Laki-Laki'); ?>>Laki-Laki</option>
                                <option <?= cekSama($isiVal['jk_karyawan'], 'Perempuan'); ?>>Perempuan</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="agama">Agama</label>
                              <select name="agama" id="agama" class="form-control custom-select">
                                <option <?= cekSama($isiVal['agama'], 'Islam'); ?>>Islam</option>
                                <option <?= cekSama($isiVal['agama'], 'Kristen Protestan'); ?>>Kristen Protestan</option>
                                <option <?= cekSama($isiVal['agama'], 'Kristen Katolik'); ?>>Kristen Katolik</option>
                                <option <?= cekSama($isiVal['agama'], 'Budha'); ?>>Budha</option>
                                <option <?= cekSama($isiVal['agama'], 'Hindu'); ?>>Hindu</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="pendidikan">Pendidikan Terakhir</label>
                              <select name="pendidikan" id="pendidikan" class="form-control custom-select">
                                <option <?= cekSama($isiVal['pendidikan'], 'SD'); ?>>SD</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'SMP'); ?>>SMP</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'SMA'); ?>>SMA</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'D1'); ?>>D1</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'D2'); ?>>D2</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'D3'); ?>>D3</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'D4'); ?>>D4</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'S1'); ?>>S1</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'S2'); ?>>S2</option>
                                <option <?= cekSama($isiVal['pendidikan'], 'S3'); ?>>S3</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="status_pernikahan">Status Pernikahan</label>
                              <select name="status_pernikahan" id="status_pernikahan" class="form-control custom-select">
                                <option <?= cekSama($isiVal['status_pernikahan'], 'Tidak Menikah'); ?>>Tidak Menikah</option>
                                <option <?= cekSama($isiVal['status_pernikahan'], 'Menikah'); ?>>Menikah</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="goldar">Golongan Darah</label>
                              <select name="goldar" id="goldar" class="form-control custom-select">
                                <option <?= cekSama($isiVal['goldar'], 'A+'); ?>>A+</option>
                                <option <?= cekSama($isiVal['goldar'], 'A-'); ?>>A-</option>
                                <option <?= cekSama($isiVal['goldar'], 'B+'); ?>>B+</option>
                                <option <?= cekSama($isiVal['goldar'], 'B-'); ?>>B-</option>
                                <option <?= cekSama($isiVal['goldar'], 'O+'); ?>>O+</option>
                                <option <?= cekSama($isiVal['goldar'], 'O-'); ?>>O-</option>
                                <option <?= cekSama($isiVal['goldar'], 'AB+'); ?>>AB+</option>
                                <option <?= cekSama($isiVal['goldar'], 'AB-'); ?>>AB-</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="no_telp">No. Telepon</label>
                              <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No. Telepon" value="<?= $isiVal['no_telp']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="email">Email</label>
                              <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?= $isiVal['email']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-2">
                              <label class="float-right" for="nik">NIK</label>
                              <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" value="<?= $isiVal['nik']; ?>" required>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12 mb-2">
                              <label class="float-right" for="almt_karyawan">Alamat</label>
                              <textarea name="almt_karyawan" id="almt_karyawan" class="form-control" placeholder="Alamat"><?= $isiVal['almt_karyawan']; ?></textarea>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item pb-0" style="border-bottom: 0;">
                        <div class="input-group">
                          <div class="row w-100 ml-0 mr-0">
                            <div class="col-md-12">
                              <label class="float-right" for="foto_karyawan">Foto Karyawan</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="foto_karyawan" class="custom-file-input" id="foto_karyawan">
                                  <label class="custom-file-label" for="foto_karyawan"><?= $isiVal['foto_karyawan']; ?></label>
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
                        <select id="column_karyawan" class="form-control custom-select">
                          <option value="0">NIK</option>
                          <option value="1">Nama Karyawan</option>
                        </select>
                      </div>
                      <div class="col-md-8 mb-2">
                        <input type="text" class="form-control" placeholder="Cari Data" id="field_karyawan">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="table_karyawan" class="table table-bordered table-hover" style="min-width: 400px;">
                        <thead>
                          <tr>
                            <th style="width: 100px;">NIK</th>
                            <th>Nama Karyawan</th>
                            <th style="width: 50px;">Act</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM karyawan");
                          for ($i = 1; $Data = mysqli_fetch_assoc($sql); $i++) { ?>
                            <tr>
                              <td class="align-middle text-center"><?= $Data['nup']; ?></td>
                              <td class="align-middle"><?= $Data['nm_karyawan']; ?></td>
                              <td class="align-middle text-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="$('#dnup').val('<?= $Data['nup']; ?>')" data-target="#delete-karyawan">
                                    <i class="fa fa-trash-alt"></i>
                                  </button>
                                  <a href="<?= $df['home'] . 'karyawan/' . $Data['nup']; ?>" class="btn btn-sm bg-info"><i class="fa fa-edit"></i></a>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>
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





    <div class="modal fade" id="delete-karyawan">
      <form method="POST" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus karyawan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="modal-title">Anda yakin Ingin Menghapus karyawan ini?</h4>
            <input type="hidden" name="nup" id="dnup">
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-block">
              <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
              <button type="submit" name="delete-karyawan" class="btn btn-outline-danger">Hapus</button>
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
      var table_karyawan = $('#table_karyawan').DataTable({
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
        }
      });
      $('#table_karyawan_filter').hide();
      $('#field_karyawan').keyup(function() {
        table_karyawan.columns($('#column_karyawan').val()).search(this.value).draw();
      });
    });
  </script>
</body>

</html>