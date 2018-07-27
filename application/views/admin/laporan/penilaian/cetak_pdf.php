<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Laporan Penilaian Dosen</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 22px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
 text-align: center;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}
table,th,td { border:1px solid black; border-collapse:collapse; } th,td { padding:5px; }

</style>
</head>
<body>

<h1>Laporan Penilaian Kinerja Dosen </h1>
<h3>Program Studi <b><?php echo $prodi->nama ?></b></h3>
<p>Tahun Ajaran <b><?php echo $periode->tahun ?></b>, Semester <b><?php echo ($periode->semester == 1)?'Ganjil':'Genap' ?></b></p>
  
<table width="100%">
	<tr align="center" style="font-size: 19px; font-weight: 900; ">
		<td style="width: 5%">Peringkat</td>
		<td style="width: 80%">Nama Dosen</td>
		<td>Nilai Teori</td>
		<td>Nilai Praktikum</td>
        <td>Nilai Keseluruhan</td>
	</tr>

	<?php $no = 1; foreach($data as $value) {  ?>
	<tr>
		<td align="center"><?php echo $no++; ?></td>
		<td><?php echo $value->nama; ?></td> 
		<td align="center"><?php echo ceil($this->kuesioner_isi_model->getRatarata($value->id_dosen, $periode->id, '0')); ?></td>
		<td align="center"><?php echo ceil($this->kuesioner_isi_model->getRatarata($value->id_dosen, $periode->id, '1')); ?></td>
        <td align="center"><?php echo ceil($value->nilai) ?></td> 
	</tr>
	<?php } ?>
 
</table> 
</body>
</html>