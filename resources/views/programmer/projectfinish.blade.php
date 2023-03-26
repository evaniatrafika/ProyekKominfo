@extends('programmer/sidebar')
@section('konten')

@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
                  {{session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
                </div>
    @endif
    
    <div class="col-md-12 grid-margin">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Project Finish</h3>
        </div>
</div>
    <div class="col-md-12 grid-margin">
                    <div class="table-responsive">
                        <table class="table col-lg-8">
                          <thead>
                            <tr>
                              <th>
                                Nama Project
                              </th>
                              <th>
                                Nama Pengaju
                              </th>
                              <th>
                                Tanggal Mulai
                              </th>
                              <th>
                                Tanggal Selesai
                              </th>
                              <th>
                                Jenis Project
                              </th>
                              <th>
                                Status
                              </th>
                              <th align="center">
                                Aksi
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <td>
                                    {{ $project->nama_project }} 
                                </td>
                                <td>
                                  {{ $project->pengaju }} 
                              </td>
                                <td>
                                  {{ $project->mulai }}
                                </td>
                                <td>
                                  {{ $project->selesai }}
                                </td>
                                <td>
                                  <?php
                              if( $project->jenis == "sim"){
                               ?> Sistem Informasi Manajemen <?php
                              }elseif( $project->jenis == "perizinan"){
                                ?> Layanan Perizinan <?php
                              }else{
                                ?> Lainnya <?php
                              }
                                ?>
                                </td>
                                <td>
                                  <?php if($project->status == "waiting"){
                                    ?> <h5><span class="badge badge-warning">Waiting</span></h5> <?php
                                  }else{
                                    ?> <h5><span class="badge badge-success">Finish</span></h5> <?php
                                  } ?>
                              </td>
                                <td>
                                    {{-- <a href="{{url('/edit')}}/{{$user->id}}" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit"> --}}
                                      <a href="{{url('/progresdetail')}}/{{$project->id}}" type="button" class="btn btn-primary">
                                        Detail</a>
                                </td>
                            </tr>
                            @endforeach
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
        </div>


@endsection
