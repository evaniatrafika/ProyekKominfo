@extends('programmer/sidebar')
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
            <link rel="stylesheet" href="#">
            @foreach ($fiturs as $fitur_modul)
            <?php if($fitur_modul->nama_file == null){

            }else{
            ?> <a href="#" class="link-decoration"><i class="fas fa-file"></i>  {{ $fitur_modul->nama_fitur }}</a> <br> 
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
                        <td align="center">
                            <a href="" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal{{$fiturs->id}}">
                            Lihat / Edit</a>
                          </td>
                          <!-- Modal -->
<div class="modal fade modal-lg" id="Modal{{$fiturs->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header content-wrapper">
        <h5 class="modal-title" id="staticBackdropLabel">Update Progres</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body content-wrapper">
                    <div class="card ">
                      <div class="card-body">
                        <form class="forms-sample" action="{{url('/updateprogres')}}/{{$fiturs->id}}" method="POST">
                          @csrf
                          <div class="form-group">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="user" hidden value="{{auth()->user()->name}}">
                            <input type="text" class="form-control" name="name" id="namefitur" placeholder="Name" disabled value="{{$fiturs->nama_fitur}}">
                            <label for="floatingInput" class="modal-title">Nama Fitur</label>
                          </div>
                          </div>
                          <div class="form-group">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="ket" id="ket" placeholder="text" value="{{$fiturs->keterangan}}" required>
                            <label for="floatingInput">Keterangan</label>
                          </div>
                          </div>
                          <div class="form-group">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="linkgit" id="linkgit" placeholder="Password" value="{{$fiturs->link_git}}" required>
                            <label for="floatingInput">Link Github</label>
                          </div>
                          </div>

                            <div class="mb-3">
                              <input hidden class="form-control" type="file" name="inputimg" id="inputimg" value="{{$fiturs->gambar}}">
                            </div>

                          <div class="form-group">
                                <input type="hidden" class="form-control" name="jumlah_kinerja" id="jumlah_kinerja" value="0">
                          </div>
                          <div class="form-group">
                              <input type="hidden" class="form-control" name="role" id="role" value="BPA">
                        </div>
                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button type="submit" class="btn btn-primary me-md-2">Submit</button>
                          <a href="" data-bs-dismiss="modal" type="button"class="btn btn-danger" data-bs-toggle="modal">
                            Batal</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
  </div>
  </div>
</div>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
  </div>

    <a href="" type="button" class="btn btn-primary btn-lg position-flex" data-bs-toggle="modal" data-bs-target="#Modalconfirm">
      Konfirmasi Project Telah Selesai</a>

  </div>
   <!-- Modal -->
<div class="modal fade modal-lg" id="Modalconfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header content-wrapper">
        <h5 class="modal-title" id="staticBackdropLabel">Update Progres</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body content-wrapper">
                    <div class="card ">
                      <div class="card-body">
                        <form class="forms-sample" action="{{url('/projectdone')}}/{{$fiturs->id}}" method="POST">
                          @csrf
                          <div class="form-group">
                            <label for="floatingInput" class="modal-title">Pastikan Semua Progres Terisi Dengan Benar,
                               Laporan Yang Telah Dikonfirmasi Selesai Tidak Dapat Diubah Kembali. Anda Yakin Untuk Lanjut Konfirmasi ?</label>
                          <div class="form-floating">
                            <input type="text" class="form-control" name="user" hidden value="{{auth()->user()->name}}">
                          </div>
                          </div>
                          <div class="form-group">
                          <div class="form-floating">
                          </div>
                          </div>
                          <div class="form-group">
                          <div class="form-floating">
                          </div>
                          </div>
                            <div class="mb-3">
                              <input hidden class="form-control" type="file" name="inputimg" id="inputimg" onchange="displayfile()">
                            </div>      
                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">Ya, Selesaikan Project</button>
                            <a href="" data-bs-dismiss="modal" type="button"class="btn btn-danger" data-bs-toggle="modal">
                              Batal</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
  </div>
  </div>
</div>
</div>

@endsection