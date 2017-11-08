<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Service Selesai</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Completed</div>
        <div class="card-body">
          <div class="row table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Barang</th>
                  <th class="text-center">Level Petugas</th>
                  <th class="text-center">Petugas</th>
                  <th class="text-center">Masalah</th>
                  <th class="text-center">Prioritas</th>
                  <th class="text-center">Waktu Inisial</th>
                  <th class="text-center">Waktu Target</th>
                  <th class="text-center">Waktu Selesai</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Barang</th>
                  <th class="text-center">Level Petugas</th>
                  <th class="text-center">Petugas</th>
                  <th class="text-center">Masalah</th>
                  <th class="text-center">Prioritas</th>
                  <th class="text-center">Waktu Inisial</th>
                  <th class="text-center">Waktu Target</th>
                  <th class="text-center">Waktu Selesai</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $id = 0; $judul = ""; $judul2 = ""; $waktu = ""; $alamat = ""; $kategori = ""; $tanggal = "";
                  $sql = "SELECT a.id, a.item, a.escalate, a.servicer, a.problem, a.priority, DATE(b.time) AS initial, a.target , DATE(c.time) AS finish FROM service a JOIN service_log b ON a.id = b.service JOIN service_log c ON a.id = c.service WHERE b.status = 'Request' AND c.status = 'Complete'";
                  $query = $this->db->query($sql);
                  
                  foreach ($query->result() as $row)
                  {
                    $id = $row->id;
                    $barang = $row->item;
                    $level = $row->escalate;
                    $petugas = $row->servicer;
                    $masalah = $row->problem;
                    $prioritas = $row->priority;
                    $inisial = date('d-m-Y',strtotime($row->initial));
                    $target = date('d-m-Y',strtotime($row->target));
                    $selesai= date('d-m-Y',strtotime($row->finish));

                    echo "<tr><td class='text-center'>".$id
                    ."</td><td class='text-center'>".$barang
                    ."</td><td class='text-center'>".$level
                    ."</td><td class='text-center'>".$petugas
                    ."</td><td class='text-center'>".$masalah
                    ."</td><td class='text-center'>".$prioritas
                    ."</td><td class='text-center'>".$inisial
                    ."</td><td class='text-center'>".$target
                    ."</td><td class='text-center'>".$selesai
                    ."</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>