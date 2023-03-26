@extends('pimpinan/sidebar')
@section('konten')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
</div>
@endif


<div class="detail-project">
<table class="table-detailproject">
<tr>
<td>
<div class="title-margin">
<h3 class="font-weight-bold">Detail project</h3>
</div>
</td>
<td rowspan="2">
  @foreach ($projects as $project)
  <?php
if($project->status == "on going"){
  ?> <div class="card bg-info mb-3 float-right status-panel"> <?php
}elseif($project->status == "waiting"){
  ?> <div class="card bg-warning mb-3 float-right status-panel"> <?php
}elseif($project->status == "finish"){
  ?> <div class="card bg-info mb-3 float-right status-panel"> <?php
}else{
  ?> <div class="card bg-secondary mb-3 float-right status-panel"> <?php
}
?>
<div class="card-header">
<b>Status</b>
</div>
<ul class="list-group list-group-flush">
<?php
if($project->status == "on going"){
  ?><li class="list-group-item color-text"><div class="color-blue"><b>On Going</b></div></li> <?php
}elseif($project->status == "waiting"){
  ?><li class="list-group-item color-text"><div class="text-warning"><b>Waiting</b></div></li> <?php
}elseif($project->status == "finish"){
  ?><li class="list-group-item color-text"><div class="color-green"><b>Selesai</b></div></li> <?php
}else{
  ?><li class="list-group-item color-text"><div class="text-secondary"><b>Proses Verifikasi</b></div></li> <?php
}

?>

</ul>
</div>
</td>
</tr>
<tr>
<td>
<div class="subtitle-space">
<h5> Nama Aplikasi </h5>
<div> {{ $project->nama_project }}</div>
</div>
</td>
</tr>
<tr>
<td>
<div class="subtitle-space">
<h5> Deskripsi </h5>
<div class="description-text">{{ $project->deskripsi }} </div>
</div>
</td>
@endforeach
<td rowspan="2">
<div class="float-right right-page-text">
<h5>Tim Programmer</h5>
<ul>
@foreach ($programmer as $programmer)
<li><div class="ul-text">{{ $programmer->user->name }}</div></li>
@endforeach
</ul>
</div>
</td>
</tr>
<tr>
<td>
<div class="subtitle-space">
<h5> Fitur - Fitur </h5>
<ul>
@foreach ($fiturs as $fitur_name)
<li><div class="ul-text">{{ $fitur_name->nama_fitur }}</div></li>
@endforeach
</ul>
</div>
</td>
</tr>
<tr>
<td>
<div class="subtitle-space">
<h5> Modul </h5>
@foreach ($fiturs as $fitur_modul)
<?php if($fitur_modul->nama_file == null){

}else{
?>   <a href="/post-dokumen/{{$fitur_modul->nama_file}}" class="link-decoration"><i class="fas fa-file"></i>  {{ $fitur_modul->nama_fitur }}</a> <br>
<?php
}
?>

@endforeach
</div>
</td>
</tr>

</table>

</div>

<div class="subtitle-space">
<h5>Update Progres</h5>
<div class="col-md-12 grid-margin">
<div class="table-responsive">
    <table class="projectdetail-table" cellpadding="4">
  <thead>
    <tr>
      <th>
        Nama Fitur
      </th>
      <th>
        Nama Pengunggah
      </th>
      <th>
        Tanggal Update
      </th>
      <th>
        Progres
      </th>
      <th>
        {{-- Kolom Untuk Button Update --}}
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($fiturs as $fiturs)
    <tr>
        <td>
          {{ $fiturs->nama_fitur }}
        </td>
        <td>
          <?php if($fiturs->uploader == null){ ?>
            -
            <?php
            }else{ ?>
              {{ $fiturs->uploader }} <?php
            }
          ?>
        </td>
        <td>
          <?php if($fiturs->tgl_update == null){ ?>
            -
            <?php
            }else{
              ?>
              {{ $fiturs->updated_at->format('d M Y h:i:s') }} <?php
            }
          ?>
        </td>
        <td>
          <?php
          if($fiturs->status == "1"){
            echo("Sudah Diupdate");
          }else{
            echo("Belum Diupdate");
            ?>
          </td>
          <?php
          }
          ?>
        </td>
        <td align="center">
          <?php
          if($fiturs->status == "1"){?>
            <a href="{{url('/fiturdetail')}}/{{$fiturs->id}}" type="button" class="btn btn-info">
            Detail</a><?php
          }else{?>
          </td>
          <?php
          }
          ?>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>

</div>
</div>

@endsection
