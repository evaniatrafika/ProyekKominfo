@extends('koordinator/sidebar')
@section('konten')
@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
                </div>
    @endif
    <div class="col-md-12 grid-margin">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Waiting For Confirmation</h3>
        </div>
</div>
    <div class="col-md-12 grid-margin">
                    <div class="table-responsive">
                        <table class="table" cellpadding="4">
                      <thead>
                        <tr>
                          <th>
                            No
                          </th>
                          <th>
                            Nama
                          </th>
                          <th>
                            Target
                          </th>
                          <th>
                            Tanggal Mulai
                          </th>
                          <th>
                            Tanggal Selesai
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Aksi
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $project->nama_project }}
                            </td>
                            <td>
                                {{ $project->target }}
                            </td>
                            <td>
                                {{ $project->mulai }}
                            </td>
                            <td>
                                 {{ $project->selesai }}
                            </td>
                             <td>
                              <h5><span class="badge badge-warning">Waiting</span></h5>
                            </td>
                            <td>
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modalconfirm{{$project->id}}">
                                <i class="fas fa-thumbs-up" style="color: black"></i></button>
                               
                                <!-- Modal -->
<div class="modal fade modal-lg" id="Modalconfirm{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header content-wrapper">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Project Selesai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body content-wrapper">
                    <div class="card ">
                      <div class="card-body">
                        <form class="forms-sample" action="{{url('/accproject')}}/{{$project->id}}" method="POST">
                          @csrf
                            <h6>Pastikan Semua Progres Terisi Dengan Benar, Laporan Yang Telah Dikonfirmasi selesai
                            <br>Tidak Dapat Diubah Kembali. Anda Yakin Untuk Lanjut Konfirmasi ?</h6>
                               
                          <div class="form-floating">
                            <input type="text" class="form-control" name="user" hidden value="{{auth()->user()->name}}">
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
                              <input hidden class="form-control" type="file" name="inputimg" id="inputimg">
                            </div>      
                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">Ya, Selesaikan Project</button>
                            <a href="" data-bs-dismiss="modal" type="button"class="btn btn-danger" data-bs-toggle="modal">
                              Batal</a>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
                                <a type="button" class="btn btn-info" href="{{url('/detailproject')}}/{{$project->id}}" ><i class="icon-eye menu-icon" style="color: black"></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12 grid-margin">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Project Finished</h3>
              </div>
      </div>
          <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                              <table class="table" cellpadding="4">
                            <thead>
                              <tr>
                                <th>
                                  No
                                </th>
                                <th>
                                  Nama
                                </th>
                                <th>
                                  Target
                                </th>
                                <th>
                                  Tanggal Mulai
                                </th>
                                <th>
                                  Tanggal Selesai
                                </th>
                                <th>
                                  Status
                                </th>
                                <th>
                                  Aksi
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($projects2 as $project)
                              <tr>
                                  <td>
                                      {{ $loop->iteration }}
                                  </td>
                                  <td>
                                      {{ $project->nama_project }}
                                  </td>
                                  <td>
                                      {{ $project->target }}
                                  </td>
                                  <td>
                                      {{ $project->mulai }}
                                  </td>
                                  <td>
                                       {{ $project->selesai }}
                                  </td>
                                   <td>
                                    <h5><span class="badge badge-success">Finish</span></h5>
                                  </td>
                                  <td>
                                      <a type="button" class="btn btn-info" href="{{url('/detailproject')}}/{{$project->id}}" ><i class="icon-eye menu-icon" style="color: black"></i></a>
                                  </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>        
              </div>

@endsection
