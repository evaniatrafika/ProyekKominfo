@extends('programmer/sidebar')
@section('konten')

@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
                </div>
    @endif
    <div class="col-md-12 grid-margin">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">On Going</h3>
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
                                Deadline
                              </th>
                              <th>
                                Jenis Project
                              </th>
                              <th align="center">
                                Persentase
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
                                  {{ $project->target }}
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
                                  <h5><span class="badge badge-info">{{ $project->persentase }}</span></h5>
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
                <div class="col-md-12 grid-margin">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Waiting For Confirmation</h3>
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
                          Deadline
                        </th>
                        <th>
                          Jenis Project
                        </th>
                        <th align="center">
                          Persentase
                        </th>
                        <th align="center">
                          Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($project_finish as $project_finish)
                      <tr>
                          <td>
                              {{ $project_finish->nama_project }} 
                          </td>
                          <td>
                            {{ $project_finish->pengaju }} 
                        </td>
                          <td>
                            {{ $project_finish->target }}
                          </td>
                          <td>
                            <?php
                              if( $project_finish->jenis == "sim"){
                               ?> Sistem Informasi Manajemen <?php
                              }elseif( $project_finish->jenis == "perizinan"){
                                ?> Layanan Perizinan <?php
                              }else{
                                ?> Lainnya <?php
                              }
                                ?>
                          </td>
                          <td>
                            <h5><span class="badge badge-info">{{ $project->persentase }}</span></h5>
                        </td>
                          <td>
                              {{-- <a href="{{url('/edit')}}/{{$user->id}}" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit"> --}}
                                <a href="{{url('/progresconfirm')}}/{{$project_finish->id}}" type="button" class="btn btn-primary">
                                  Detail</a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="text-secondary mt-5">*Note : Project Yang Ada Di "Waiting For Confirmation" Tidak Dapat Diverifikasi Selesai Oleh Koordinator / BPA Bila Tidak Di Konfirmasi Oleh Programmer</div>
              </div>
              </div>
            </div>


@endsection
