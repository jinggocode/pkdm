@layout('_layout/dosen/index')

@section('title')Beranda@endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password anda!</h4>

  <a style="text-decoration: none;" href="{{site_url('dosen/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif
  
<div class="box box-default">
  <div class="box-header with-border"> 
    <center>
        <a href="{{site_url('dosen/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
    </center>
  
    <h2><strong>{{$periode->periode->tahun}} - SEMESTER {{($periode->periode->semester == '1')?'GANJIL':'GENAP'}}</strong></h2>

    
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </div>
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">
      <thead>
        <th>Angkatan - Kelas</th>
        <th>Mata Kuliah</th>
        <th>Aksi</th>
      </thead>
      <tbody>
      <?php if(empty($makul)): ?>
          <tr>
              <td colspan="6" align="center">Tidak ada Data</td>
          </tr>
      <?php else: ?>
          <?php $no = 1 ?>
          @foreach($makul as $row)  
            <tr>
              <td>ANGKATAN {{$row->mahasiswa->angkatan->nama}} - KELAS {{$row->mahasiswa->kelas->nama}} </td>
              <td>{{($row->pengampu->makul->jenis == '0')?'TEORI':'PRAKIKUM'}} {{$row->pengampu->makul->nama}}</td>
              <td> 
                  <a href="{{site_url('dosen/statistik/grafik/'.$row->id_pengampu.'/'.$row->id_periode)}}" class="btn btn-info"><i class="fa fa-send"></i> Lihat</a>
               </td>
            </tr>
          @endforeach
      <?php endif ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection

@section('script') 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/hub/1-3-0/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script type="text/javascript">
  // Load the Visualization API and the line package.
  google.charts.load('current', {'packages':['bar']});
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  $.ajaxSetup({
      data: {
          csrf_test_name: $.cookie('csrf_cookie_name')
      }
  }); 
  function drawChart() {

      $.ajax({
      type: 'POST',
      url: 'http://localhost/pkdm/dosen/statistik/makul/1/get_list',
        
      success: function (data1) {
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Judul');
      data.addColumn('number', 'Sangat Baik');
      data.addColumn('number', 'Baik');
      data.addColumn('number', 'Cukup');
      data.addColumn('number', 'Kurang');
        
      var jsonData = $.parseJSON(data1);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].judul, parseInt(jsonData[i].sangat_baik), parseInt(jsonData[i].baik), parseInt(jsonData[i].cukup), parseInt(jsonData[i].kurang)]);
      }
      var options = {
        chart: {
          title: 'Statistik Seluruh Matakuliah yang diampu',
        },
        bars: 'horizontal',
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        },
        colors: ['green', 'blue', 'yellow', 'red']
        
      };
      var chart = new google.charts.Bar(document.getElementById('barchart_material'));
      chart.draw(data, options);
      }
    });
  }
</script>
@endsection
