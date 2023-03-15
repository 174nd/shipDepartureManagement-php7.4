<?php
$backurl = '../';
require_once($backurl . 'admin/config/settings.php');

if ($_POST['set'] == 'ci') {
  $cek = mysqli_query($conn, "SELECT ci.id_ci, kapal.nm_kapal, ci.tgl_ci, ci.k_muatan, ci.k_ci, (SELECT nm_pelabuhan FROM pelabuhan WHERE ci.kd_pelabuhan=pelabuhan.kd_pelabuhan) AS nm_pelabuhan_ci, ci.jns_muatan AS jns_muatan_ci, ci.muatan AS muatan_ci, ci.tgl_ci FROM ci JOIN kapal WHERE ci.kd_kapal=kapal.kd_kapal AND ci.id_ci='$_POST[id_ci]'");
  if (mysqli_num_rows($cek) == 1) {
    $dataKontrak = mysqli_fetch_assoc($cek); ?>
    <h3 class="profile-username text-center"><?= $dataKontrak['nm_kapal']; ?></h3>
    <p class=""><b>Tanggal Kedatangan</b> <a class="float-right"><?= tanggal_indo($dataKontrak['tgl_ci']); ?></a> </p>
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Pelabuhan Asal</b> <a class="float-right"><?= $dataKontrak['nm_pelabuhan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Jenis Muatan</b> <a class="float-right"><?= $dataKontrak['jns_muatan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Muatan</b> <a class="float-right"><?= $dataKontrak['muatan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Status Muatan</b> <a class="float-right"><?= ($dataKontrak['k_muatan'] == 'Y') ? 'Konfirmasi' : 'Pending'; ?></a>
      </li>
      <li class="list-group-item">
        <b>Status Kedatangan</b> <a class="float-right"><?= ($dataKontrak['k_ci'] == 'Y') ? 'Konfirmasi' : 'Pending'; ?></a>
      </li>
      <li class="list-group-item">
        <div class="btn-group w-100">
          <?php if ($dataKontrak['k_muatan'] == 'N' && $dataKontrak['k_ci'] == 'N') { ?>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_ci']; ?>" k_status="km_ci" send_text="Konfirmasi Muatan Kedatangan">Konfirmasi Muatan</button>
          <?php } else if ($dataKontrak['k_muatan'] == 'Y' && $dataKontrak['k_ci'] == 'N') { ?>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_ci']; ?>" k_status="bkm_ci" send_text="Membatalkan Konfirmasi Muatan Kedatangan">Batal Konfirmasi Muatan</button>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_ci']; ?>" k_status="k_ci" send_text="Konfirmasi Kedatangan">Konfirmasi Kedatangan</button>
          <?php } else if ($dataKontrak['k_muatan'] == 'Y' && $dataKontrak['k_ci'] == 'Y') { ?>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_ci']; ?>" k_status="bk_ci" send_text="Membatalkan Konfirmasi Muatan Kedatangan">Batal Konfirmasi Kedatangan</button>
          <?php } ?>
        </div>
      </li>
    </ul>
  <?php } else { ?>
    <p class="text-center m-0">Error</p>
  <?php }
} else if ($_POST['set'] == 'co') {
  $cek = mysqli_query($conn, "SELECT co.id_co, kapal.nm_kapal, ci.tgl_ci, co.k_muatan, co.k_co, (SELECT nm_pelabuhan FROM pelabuhan WHERE ci.kd_pelabuhan=pelabuhan.kd_pelabuhan) AS nm_pelabuhan_ci, ci.jns_muatan AS jns_muatan_ci, ci.muatan AS muatan_ci, co.tgl_co, (SELECT nm_pelabuhan FROM pelabuhan WHERE co.kd_pelabuhan=pelabuhan.kd_pelabuhan) AS nm_pelabuhan_co, co.jns_muatan AS jns_muatan_co, co.muatan AS muatan_co FROM ((co JOIN ci) JOIN kapal) WHERE co.id_ci=ci.id_ci AND ci.kd_kapal=kapal.kd_kapal AND co.id_co='$_POST[id_co]'");
  if (mysqli_num_rows($cek) == 1) {
    $dataKontrak = mysqli_fetch_assoc($cek); ?>
    <h3 class="profile-username text-center"><?= $dataKontrak['nm_kapal']; ?></h3>
    <p class=""><b>Tanggal Kedatangan</b> <a class="float-right"><?= tanggal_indo($dataKontrak['tgl_ci']); ?></a> </p>
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Pelabuhan Asal</b> <a class="float-right"><?= $dataKontrak['nm_pelabuhan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Jenis Muatan</b> <a class="float-right"><?= $dataKontrak['jns_muatan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Muatan</b> <a class="float-right"><?= $dataKontrak['muatan_ci']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Tanggal Keberangkatan</b> <a class="float-right"><?= tanggal_indo($dataKontrak['tgl_co']); ?></a>
      </li>
      <li class="list-group-item">
        <b>Pelabuhan Tujuan</b> <a class="float-right"><?= $dataKontrak['nm_pelabuhan_co']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Jenis Muatan</b> <a class="float-right"><?= $dataKontrak['jns_muatan_co']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Muatan</b> <a class="float-right"><?= $dataKontrak['muatan_co']; ?></a>
      </li>
      <li class="list-group-item">
        <b>Status Muatan</b> <a class="float-right"><?= ($dataKontrak['k_muatan'] == 'Y') ? 'Konfirmasi' : 'Pending'; ?></a>
      </li>
      <li class="list-group-item">
        <b>Status Keberangkatan</b> <a class="float-right"><?= ($dataKontrak['k_co'] == 'Y') ? 'Konfirmasi' : 'Pending'; ?></a>
      </li>
      <li class="list-group-item">
        <div class="btn-group w-100">
          <?php if ($dataKontrak['k_muatan'] == 'N' && $dataKontrak['k_co'] == 'N') { ?>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_co']; ?>" k_status="km_co" send_text="Konfirmasi Muatan Keberangkatan">Konfirmasi Muatan</button>
          <?php } else if ($dataKontrak['k_muatan'] == 'Y' && $dataKontrak['k_co'] == 'N') { ?>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_co']; ?>" k_status="bkm_co" send_text="Membatalkan Konfirmasi Muatan Keberangkatan">Batal Konfirmasi Muatan</button>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_co']; ?>" k_status="k_co" send_text="Konfirmasi Keberangkatan">Konfirmasi Keberangkatan</button>
          <?php } else if ($dataKontrak['k_muatan'] == 'Y' && $dataKontrak['k_co'] == 'Y') { ?>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#konfirmasi-status" send_id="<?= $dataKontrak['id_co']; ?>" k_status="bk_co" send_text="Membatalkan Konfirmasi Muatan Keberangkatan">Batal Konfirmasi Keberangkatan</button>
          <?php } ?>
        </div>
      </li>
    </ul>
  <?php } else { ?>
    <p class="text-center m-0">Error</p>
  <?php }
} else if ($_POST['set'] == 'data_ci') { ?>
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
        $bulan = date('m', strtotime($_POST['bt_ci']));
        $tahun = date('Y', strtotime($_POST['bt_ci']));
        $sql = mysqli_query($conn, "SELECT * FROM ((ci JOIN kapal) JOIN pelabuhan) WHERE ci.kd_kapal=kapal.kd_kapal AND ci.kd_pelabuhan=pelabuhan.kd_pelabuhan AND MONTH(tgl_ci)='$bulan' AND YEAR(tgl_ci)='$tahun' ORDER BY ci.tgl_ci DESC");
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
<?php
} else if ($_POST['set'] == 'data_co') { ?>
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
        $bulan = date('m', strtotime($_POST['bt_co']));
        $tahun = date('Y', strtotime($_POST['bt_co']));
        $sql = mysqli_query($conn, "SELECT * FROM (((co JOIN ci) JOIN kapal) JOIN pelabuhan) WHERE co.id_ci=ci.id_ci AND ci.kd_kapal=kapal.kd_kapal AND co.kd_pelabuhan=pelabuhan.kd_pelabuhan AND MONTH(tgl_co)='$bulan' AND YEAR(tgl_co)='$tahun' ORDER BY co.tgl_co DESC");
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
<?php
} else if ($_POST['set'] == 'set_status') {

  if ($_POST['k_status'] == 'km_co') {
    $sql = mysqli_query($conn, "SELECT id_co FROM co WHERE id_co='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y'], 'co', ['id_co' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Muatan Keberangkatan Kapal Berhasil Dikonfirmasi!',
          'type' => 'success',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'bkm_co') {
    $sql = mysqli_query($conn, "SELECT id_co FROM co WHERE id_co='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'N'], 'co', ['id_co' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Konfirmasi Muatan Keberangkatan Kapal Berhasil Dibatalkan!',
          'type' => 'warning',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'k_co') {
    $sql = mysqli_query($conn, "SELECT id_co FROM co WHERE id_co='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y', 'k_co' => 'Y'], 'co', ['id_co' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Keberangkatan Kapal Berhasil Dikonfirmasi!',
          'type' => 'success',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'bk_co') {
    $sql = mysqli_query($conn, "SELECT id_co FROM co WHERE id_co='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y', 'k_co' => 'N'], 'co', ['id_co' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Konfirmasi Keberangkatan Kapal Berhasil Dibatalkan!',
          'type' => 'warning',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'km_ci') {
    $sql = mysqli_query($conn, "SELECT id_ci FROM ci WHERE id_ci='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y'], 'ci', ['id_ci' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Muatan Kedatangan Kapal Berhasil Dikonfirmasi!',
          'type' => 'success',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'bkm_ci') {
    $sql = mysqli_query($conn, "SELECT id_ci FROM ci WHERE id_ci='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'N'], 'ci', ['id_ci' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Konfirmasi Muatan Kedatangan Kapal Berhasil Dibatalkan!',
          'type' => 'warning',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'k_ci') {
    $sql = mysqli_query($conn, "SELECT id_ci FROM ci WHERE id_ci='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y', 'k_ci' => 'Y'], 'ci', ['id_ci' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Kedatangan Kapal Berhasil Dikonfirmasi!',
          'type' => 'success',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else if ($_POST['k_status'] == 'bk_ci') {
    $sql = mysqli_query($conn, "SELECT id_ci FROM ci WHERE id_ci='$_POST[send_id]' LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
      if (setUpdate(['k_muatan' => 'Y', 'k_ci' => 'N'], 'ci', ['id_ci' => $_POST['send_id']])) {
        $hasil = [
          'set' => 'Konfirmasi Kedatangan Kapal Berhasil Dibatalkan!',
          'type' => 'warning',
          'status' => 'done',
        ];
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
  } else {
    $hasil['status'] = 'none';
  }

  echo json_encode($hasil);
}
