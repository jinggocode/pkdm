@layout('_layout/admin/index')

@section('title')Data Penilaian@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hasil Penilaian Prodi {{ $prodi->nama }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border"> 
          <div class="row">
            <div class="col-md-6">
              <a href="{{site_url('admin/laporan/penilaian/prodi/1/'.$periode->id)}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> 
            </div>
            <div class="col-md-6" align="right">
                <a target="_BLANK" href="{{ site_url('admin/laporan/penilaian/cetak/'.$periode->id.'/'.$prodi->id )}}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak PDF</a> 
            </div>
          </div>
        
          <h4><b>Tahun Ajaran {{ $periode->tahun.' Semester' }} {{ ($periode->semester == 1)?'Ganjil':'Genap' }}</b></h4>
        </div>
        <div class="box-body">  
          <table class="table table-striped table-hover">
            <thead>
              <th style="width: 10%">Peringkat</th>
              <th>Nama Dosen</th>
              <th>Rata - rata Nilai Teori</th>
              <th>Rata - rata Nilai Praktikum</th>
              <th>Nilai Rata - rata Keseluruhan</th>
              <th>Aksi</th>
            </thead>
            <tbody>
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr> 
            <?php else: ?>
                <?php $no = 1 ?>
                @foreach($data as $row)  
                  <tr>
                    <td align="center">{{$no++}}.</td>
                    <td>{{$row->nama}}</td>
                    <td>{{ ceil($this->kuesioner_isi_model->getRatarata($row->id_dosen, $periode->id, '0')); }}</td>
                    <td>{{ ceil($this->kuesioner_isi_model->getRatarata($row->id_dosen, $periode->id, '1')); }}</td>
                    <td>
                      {{ceil($row->nilai)}} 
                    </td> 
                    <td> 
                        <a href="{{site_url('admin/laporan/penilaian/detail/'.$row->id_dosen)}}" class="btn btn-success"><i class="fa fa-eye"></i> Detail</a>
                    </td>
                  </tr>
                @endforeach
            <?php endif ?>
            </tbody>
          </table>
        </div> 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection