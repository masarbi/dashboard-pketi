<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['gauge']});
  google.charts.setOnLoadCallback(drawRequestChart);
  google.charts.setOnLoadCallback(drawPlanChart);
  google.charts.setOnLoadCallback(drawOngoingChart);
  google.charts.setOnLoadCallback(drawCompleteChart);

  function drawRequestChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Request', <?php echo $perrequest; ?>]
    ]);

    var options = {
      width: 180, height: 180,
      greenFrom: 0, greenTo: 5,
      yellowFrom:20, yellowTo: 30,
      redFrom: 30, redTo: 100,
      minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('gaugeRequest_div'));

    chart.draw(data, options);
  }

  function drawPlanChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Plan', <?php echo $perplan; ?>]
    ]);

    var options = {
      width: 180, height: 180,
      greenFrom: 0, greenTo: 5,
      yellowFrom:25, yellowTo: 40,
      redFrom: 40, redTo: 100,
      minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('gaugePlan_div'));

    chart.draw(data, options);
  }

  function drawOngoingChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Ongoing', <?php echo $perongoing; ?>]
    ]);

    var options = {
      width: 180, height: 180,
      greenFrom: 0, greenTo: 20,
      yellowFrom:30, yellowTo: 40,
      redFrom: 40, redTo: 100,
      minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('gaugeOngoing_div'));

    chart.draw(data, options);
  }

  function drawCompleteChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Complete', <?php echo $percomplete; ?>]
    ]);

    var options = {
      width: 180, height: 180,
      greenFrom: 80, greenTo: 100,
      yellowFrom:30, yellowTo: 60,
      redFrom: 0, redTo: 30,
      minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('gaugeComplete_div'));

    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawStatusChart);
  google.charts.setOnLoadCallback(drawPriorityChart);

  function drawStatusChart() {
    var data = google.visualization.arrayToDataTable([
      ['Status', 'Jumlah'],
      ['Request', <?php echo $request; ?>],
      ['Plan', <?php echo $plan; ?>],
      ['Ongoing', <?php echo $ongoing; ?>],
      ['Complete', <?php echo $complete; ?>]
    ]);

    var options = {
      title: 'Status Service',
      pieHole: 0.4,
      sliceVisibilityThreshold:0,
      slices: {
        0: { color: '#F44336' },
        1: { color: '#FF9800' },
        2: { color: '#FFEB3B' },
        3: { color: '#4CAF50' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutStatusChart'));
    chart.draw(data, options);
  }

  function drawPriorityChart() {
    var data = google.visualization.arrayToDataTable([
      ['Prioritas', 'Jumlah'],
      ['Unassigned', <?php echo $unassigned; ?>],
      ['Low', <?php echo $low; ?>],
      ['Medium', <?php echo $medium; ?>],
      ['High', <?php echo $high; ?>],
      ['Critical', <?php echo $critical; ?>]
    ]);

    var options = {
      title: 'Prioritas Service',
      pieHole: 0.4,
      sliceVisibilityThreshold:0,
      slices: {
        0: { color: '#2196F3' },
        1: { color: '#4CAF50' },
        2: { color: '#FFEB3B' },
        3: { color: '#FF9800' },
        4: { color: '#F44336' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutPriorityChart'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'line']});
  google.charts.setOnLoadCallback(drawLineColors);

  function drawLineColors() {
    var jsonData = '<?php echo $tpd; ?>';

    var data = new google.visualization.DataTable(jsonData);

    var options = {
      hAxis: {
        title: 'Tanggal'
      },
      vAxis: {
        title: 'Jummlah',
        format: 'decimal',
        minValue: 0,
        viewWindow: {
          min: 0
        }
      },
      legend: 'bottom',
      colors: ['#2196F3', '#4CAF50', '#FFEB3B', '#FF9800', '#F44336']
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  function dashboard(date)
  {
    window.location = "<?php echo base_url('dashboard/dashboard/') ?>" + date;
  }
</script>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row" style="margin:0px;">
      <div class="card" style="width:100%;">
        <div class="card-header">
          <div class="row" style="margin-left:0px;margin-right:0px;">
            <div style="width:50%;">
              Bulan: <input type="month" value="<?php echo $my; ?>" onchange="dashboard(this.value)">
            </div>
            <div class="text-right" style="width:50%">Jumlah Insiden (<?php echo $mname; ?>/Total): <?php echo $monthly."/".$total; ?></div>
          </div>
        </div>
        <div class="row" style="margin:8px;">
          <div style="width:100%;">Persentase Service</div>
          <div id="gaugeRequest_div" style="width:25%;padding-left:40px;"></div>
          <div id="gaugePlan_div" style="width:25%;padding-left:40px;"></div>
          <div id="gaugeOngoing_div" style="width:25%;padding-left:40px;"></div>
          <div id="gaugeComplete_div" style="width:25%;padding-left:40px;"></div>
        </div>
        <div class="row" style="margin:8px;">
          <div style="width:100%;">Jumlah Service</div>
          <div id="donutStatusChart" style="width:50%"></div>
          <div id="donutPriorityChart" style="width:50%;"></div>
          <div id="chart_div" style="width:100%;height:300px;"></div>
        </div>
      </div>
    </div>
    <br>