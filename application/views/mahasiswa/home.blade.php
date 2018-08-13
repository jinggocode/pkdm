@layout('_layout/mahasiswa/index')

@section('title')Beranda@endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password kamu!</h4>

  <a style="text-decoration: none;" href="{{site_url('mahasiswa/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif

@if ($cek_isi == 0)
  <div class="callout callout-warning">
    <h4>Selamat Datang <b>{{$user->first_name}}</b></h4>

    <p style="font-size: 15px">Kamu belum mengisi semua kuisioner, Silahkan lakukan pengisian dibawah ini</p>
  </div>
@else
  <div class="callout callout-success">  
    <p style="font-size: 17px">Kamu telah menyelesaikan pengisian kuesioner, Segera melakukan submit</p>
 
    <form action="{{site_url('mahasiswa/homepage/submit_kuesioner')}}" method="post">
      {{$csrf}}
      {{form_hidden('id_mahasiswa', $id_mahasiswa)}}
      {{form_hidden('id_periode', $id_periode)}} 

      <div class="form-group">
        <label for="pernyataan">Salin dan tulis kembali pernyataan "Saya menyatakan bahwa penilaian yang saya isikan dalam form ini adalah benar adanya"</label>
        <textarea name="pernyataan" id="pernyataan" class="form-control" required placeholder="Salin disini"></textarea>
      </div>
      <button class="btn btn-primary" type="submit">Submit</button>
    </form>
  </div>
@endif

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Pilih Mata Kuliah lalu lakukan pengisian kuisioner</h3>
  </div>
  <div class="box-body">
    <table class="table table-striped" style="margin-top: 20px">
      <thead>
        <th>Nama Mata Kuliah / Nama Dosen</th>
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
            <?php $kuesioner_isi = $this->kuesioner_isi_model->where('id_pengampu', $row->id_pengampu)->where('id_mahasiswa', $id_mahasiswa)->count_rows();?>

            <tr>
              <td class="up">{{($row->jenis_makul == '0')?'':'PRAKIKUM'}} {{$row->nama_makul}} - {{$row->nama_dosen}}</td>
              <td>
                @if ($kuesioner_isi == '0')
                  <a href="{{site_url('mahasiswa/kuesioner/isi/'.$row->id_pengampu)}}" class="btn btn-info"><i class="fa fa-send"></i> Isi</a>
                @else
                  <label class="label label-primary">Sudah di Isi</label>
                @endif
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
