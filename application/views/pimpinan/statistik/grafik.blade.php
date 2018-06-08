@layout('_layout/dosen/index')

@section('title')Beranda @endsection

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
        <a href="{{site_url('dosen/statistik/makul/'.$makul->id_periode)}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
    </center>

    <h2><strong>SEMESTER {{$makul->pengampu->makul->semester}} - {{($makul->pengampu->makul->jenis == '0')?'TEORI':'PRAKIKUM'}} {{$makul->pengampu->makul->nama}}</strong></h2>
  </div> 

  <div id="bar_chart" style="padding: 40px"></div>

  <div style="padding-left: 50px">
      <p>
        <b>Keterangan</b> <br>
        <ul>
          <li>Klasifikasi ditentukan oleh jumlah total nilai</li> 
          <li>Nilai Teori : 12 - 12 = cukup, </li> 
        </ul>
      </p>
  </div>
  
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">

      @foreach ($kategori_pertanyaan as $value)
        <?php 
        $id_pengampu = $this->uri->segment(4);
        $id_periode = $this->uri->segment(5);
        
        $pertanyaan = $this->db->query('select id_kuesioner, kuesioner_kategori.id, kuesioner_kategori.nama, kuesioner.isi, avg(nilai) as nilai from kuesioner_isi_detail
        join kuesioner ON kuesioner.id = kuesioner_isi_detail.id_kuesioner 
        join kuesioner_kategori ON kuesioner.id_kategori = kuesioner_kategori.id
        where (id_pengampu = '.$id_pengampu.' and id_periode = '.$id_periode.' and kuesioner_kategori.id = '.$value->id.')
        group by id_kuesioner')->result();
        ?>

        <tr>
          <td colspan="2"><strong>{{$value->nama}}</strong></td>
        </tr>
        <tr>
          <td><i>Pertanyaan</i></td>
          <td><i>Rata - rata Nilai</i></td>
        </tr> 
        @foreach ($pertanyaan as $row) 
          <tr>
            <td>{{$row->isi}}</td>
            <td>{{ceil($row->nilai)}}</td>
          </tr> 
        @endforeach 
      @endforeach

    </table>

    <div style="padding-top: 10px">
        <p>
          <b>Keterangan</b> <br>
          <ul>
            <li>Nilai 1 = Kurang</li>
            <li>Nilai 2 = Cukup</li>
            <li>Nilai 3 = Baik</li>
            <li>Nilai 4 = Sangat Baik</li>
          </ul>
        </p>
    </div>

  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection 

@section('script') 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
  <script type="text/javascript">

    var kurang = <?php echo $jumlah_kurang ?>;
    var cukup = <?php echo $jumlah_cukup; ?>;
    var baik = <?php echo $jumlah_baik; ?>;
    var sangat_baik = <?php echo $jumlah_sangat_baik; ?>;

    // Load the Visualization API and the line package.
    google.charts.load('current', {'packages':['bar']});
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
          var data = new google.visualization.DataTable();
          // Add legends with data type
          data.addColumn('string', 'Klasifikasi Penilaian');
          data.addColumn('number', 'Jumlah Mahasiswa');

          data.addRow(['Kurang', parseInt(kurang)]);
          data.addRow(['Cukup', parseInt(cukup)]);
          data.addRow(['Baik', parseInt(baik)]);
          data.addRow(['Sangat Baik', parseInt(sangat_baik)]); 
              
          var options = {
                  chart: {
                    title: 'Grafik Klasifikasi Nilai Keseluruhan',
                    subtitle: 'Grafik Klasifikasi Nilai'
                },
                width: 800,
                height: 300,
                axes: {
                x: {
                0: {side: 'bottom'}
              }
            }
          };
    var chart = new google.charts.Bar(document.getElementById('bar_chart'));
    chart.draw(data, options);
              
      }

</script>
@endsection
