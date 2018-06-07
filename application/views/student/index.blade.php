@layout('layout/index')

@section('title')
	List Mahasiswa
@endsection

@section('style')
	<link rel="stylesheet" href="{{ base_url('assets/css/style.css') }}">
@endsection

@section('content')
	<h1>Students List</h1>

	<a href="{{ site_url('student/add') }}" class="btn btn-primary">Tambah Data</a>

	<table class="table">
		<thead>
			<td>NIM</td>
			<td>Nama</td>
			<td>Username</td>
			<td>Gender</td>
			<td>Alamat</td>
			<td>Golongan</td>
			<td>Aksi</td>
		</thead>
		<tbody> 
			<?php $no = 1; ?>
			@foreach($students as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama }}</td>
				<td>{{ $data->username }}</td>
				<td>{{ $data->gender }}</td>
				<td>{{ $data->address }}</td>
				<td>{{ $data->golongan->golongan }}</td>
				<td>
					<a href="{{ site_url('student/detail/'.$data->id) }}" class="btn btn-primary">Detail</a>
					<a href="{{ site_url('student/edit/'.$data->id) }}" class="btn btn-success">Edit</a>
					<a href="{{ site_url('student/arsip/'.$data->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Arsipkan</a>
				</td>
			</tr>
			@endforeach 

		</tbody>
	</table>
@endsection