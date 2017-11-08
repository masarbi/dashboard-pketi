<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('d0kterkredit/dashboard') ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Service Log</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Log</div>
        <div class="card-body">
          <label for="servicer-input">Petugas</label>
          <select class="form-control" id="servicer-input" onchange="setServices(this.value)" style="max-width:215px;">
            <?php
              $sql = "(SELECT * FROM servicer WHERE level <> 0 ORDER BY level ASC, id ASC) UNION (SELECT * FROM servicer WHERE level = 0 ORDER BY id ASC)";

              $query = $this->db->query($sql);
                            
              foreach ($query->result() as $row)
              {
                $available = $row->available;
                if($available == "Yes")
                {
                  echo "<option value='".$row->level.$row->id."' title='".$row->name." - ".$row->branch."'>".$row->id." - ".$row->name."</option>";
                }
                else
                {
                  echo "<option value='".$row->level.$row->id."' title='".$row->name." - ".$row->branch."' disabled>".$row->id." - ".$row->name."</option>";
                }
              }
            ?>
          </select>
          <br>
          <div class="row table-responsive">
            <table class="table table-responsive table-bordered dt-responsive" id="data-table" cellspacing="0" width="100%">
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
                  <th class="text-center">Status</th>
                  <th class="text-center">Tindakan</th>
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
                  <th class="text-center">Status</th>
                  <th class="text-center">Tindakan</th>
                </tr>
              </tfoot>
              <tbody id="ajax-table">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-plan" tabindex="-1" role="dialog" aria-labelledby="modal-plan-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open(base_url('dashboard/plan')); ?>
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Plan Service</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="id-input">
              <label for="priority-input">Prioritas</label>
              <select name="priority" class="form-control" id="priority-input" onchange="setPriority()" style="max-width:165px;" required>
                <option value="Low">Low</option>
                <option value="Medium" selected>Medium</option>
                <option value="High">High</option>
                <option value="Critical">Critical</option>
              </select>
              <br>
              <label for="target-input">Target Tanggal</label>
              <input type="date" name="target" class="form-control" id="target-input" onchange="setTarget()" style="min-width:165px;max-width:165px;" value="<?php echo date('Y-m-d'); ?>" required>
              <br>
              <label for="note-input">Catatan</label>
              <textarea name="note" class="form-control" id="note-input" rows="5" style="min-width:400px;max-width:400px;" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="submit" class="btn btn-primary">Plan</button>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var target = <?php echo date('Y-m-d'); ?>;
      var priority = "medium";
      var id = 0;
      var servicer = '';

      function setID(i)
      {
        id = i;
        document.getElementById('id-input').value = i;
      }

      function setTarget()
      {
        target = document.getElementById('target-input').value;
      }

      function setPriority()
      {
        priority = document.getElementById('priority-input').value;
      }

      function setServicer(s)
      {
        servicer = s;
      }

      function ongoing(id)
      {
        var txt;
        var r = confirm("Apakah anda yakin untuk menjadikan service berstatus ONGOING?");
        if (r == true) {
          setID(id);
          window.location = "<?php echo base_url('dashboard/ongoing/') ?>" + servicer + "/" + id;
        }
      }

      function reject(id)
      {
        var txt;
        var r = confirm("Apakah anda yakin untuk REJECT insiden?");
        if (r == true) {
          setID(id);
          window.location = "<?php echo base_url('dashboard/reject/') ?>" + id;
        }
      }

      function complete(id)
      {
        var txt;
        var r = confirm("Apakah anda yakin untuk menjadikan service berstatus COMPLETE?");
        if (r == true) {
          setID(id);
          window.location = "<?php echo base_url('dashboard/complete/') ?>" + id;
        }
      }

      function setServices(servicer)
      {
        var s = servicer.substring(1);
        setServicer(s);
        var cat = document.getElementById("servicer-input").value;
        if(cat != '')
        {
          $.ajax({
            url: "<?php echo base_url('dashboard/get_services'); ?>",
            type: "POST",
            data: {'cat' : cat},
            dataType: 'json',
            success: function(data){
              //$('#ajax-table').html(data);
              $('#data-table').DataTable().destroy();
              $('#data-table').DataTable( {
                  "ajax": '<?php echo base_url('assets/json/services.json') ?>'
              } );
            },
            error: function(xhr, status, error){
              alert(xhr.responseText);
            }
          });
        }
      }

      window.onload = function()
      {
        s = document.getElementById('servicer-input').value;
        setServices(s);
      }

      // $(document).ready(function() {
      //   $('#dataTable').DataTable( {
      //     "ajax": '<?php //echo base_url('assets/json/services.txt') ?>'
      //   } );
      // } );
    </script>