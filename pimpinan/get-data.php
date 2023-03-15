<?php
$backurl = '../';
require_once($backurl . 'pimpinan/config/settings.php');

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
}
