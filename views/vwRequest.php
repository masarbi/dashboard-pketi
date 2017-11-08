<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('d0kterkredit/dashboard') ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Incident Service Request</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-info-circle"></i> Form Request</div>
        <div class="card-body">
          <div class="row" style="margin-left:8px;">
            <?php echo form_open_multipart('dashboard/submit','class="form-horizontal" onsubmit="return confirm(\'Apakah data anda sudah benar?\');"'); ?>
              <div class="form-group">
                <label for="date-input">Tanggal</label>
                <input name="date" type="date" class="form-control" id="date-input" style="min-width:165px;max-width:165px;" value="<?php echo date('Y-m-d'); ?>" required>
              </div>
              <div class="form-group">
                <label for="branch-input">Cabang</label>
                <select name="branch" class="form-control" id="branch-input" onchange="setItems()" style="min-width:200px;max-width:200px;" required>
                  <?php
                    $sql = "SELECT * FROM branch ORDER BY location, name";

                    $query = $this->db->query($sql);
                                  
                    foreach ($query->result() as $row)
                    {
                      echo "<option value='".$row->name."' title='".$row->location."'>".$row->name."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="item-input">Barang</label>
                <select name="item" class="form-control" id="item-input" style="min-width:200px;max-width:200px;" required>
                </select>
              </div>
              <div class="form-group">
                <label for="problem-input">Masalah & Urgensitas</label>
                <small id="problem-help" class="form-text text-muted">Sebutkan masalah dan seberapa penting masalah tersebut harus segera dituntaskan.</small>
                <textarea name="problem" class="form-control" id="problem-input" rows="5" style="min-width:500px;max-width:500px;" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      <br>
    </div>

    <?php
      // if($status == "Aktif")
      // { 
      //   echo "<button class='btn btn-danger act-button' role='button' data-toggle='tooltip' title='Tutup' id='".$id."' onclick='itemClose(this.id)'>&#10007;</button>";
      // }
      // else
      // { 
      //   echo "<button class='btn btn-success act-button' role='button' data-toggle='tooltip' title='Buka' id='".$id."' onclick='itemOpen(this.id)'>+</button>";
      // }
      // echo "<span style='margin-left:4px;margin-right:4px;'></span>"
      // ."<button class='btn btn-info act-button' role='button' data-toggle='tooltip' title='Konfirmasi' id='".$id."' onclick='itemConfirm(this.id)'>&#10003;</button>"
      // ."</td></tr>";
    ?>

    <script type="text/javascript">
      function setItems()
      {
        var cat = document.getElementById("branch-input").value;
        if(cat != '')
        {
          $.ajax({
            url: "<?php echo base_url('dashboard/get_items'); ?>",
            type: "POST",
            data: {'cat' : cat},
            dataType: 'json',
            success: function(data){
              //document.getElementById("third-cat").innerHTML = xmlhttp.responseText;
              $('#item-input').html(data);
            },
            error: function(){
              alert('Error');
            }
          });
        }
      }

      window.onload = function()
      {
        setItems();
      }
    </script>