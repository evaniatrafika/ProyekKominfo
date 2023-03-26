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
    <h3 class="font-weight-bold">Project Verifikasi</h3>
        </div>
</div>
    <div class="col-md-12 grid-margin">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalNew">Project Baru</button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalAdd">Pengembangan</button><br><br>
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
                              <h5><span class="badge badge-warning">Proses Verifikasi</span></h5>
                            </td>
                            <td>
                                <a type="button" class="btn btn-warning" href="{{url('/detailverifikasi')}}/{{$project->id}}" ><i class="icon-plus menu-icon" style="color: black"></i></a>
                                <a type="button" class="btn btn-primary" href="{{url('/edit')}}/{{$project->id}}" data-bs-toggle="modal" data-bs-target="#modaledit{{$project->id}}" ><i class="fas fa-wrench" style="color: black"></i></a>
                                <!--Edit Modal-->
                                <div class="modal fade modal-lg" id="modaledit{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header content-wrapper">
                                        <h5 class="modal-title" id="staticBackdropLabel">Form Edit Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body content-wrapper">
                                                    <div class="card ">
                                                      <div class="card-body">
                                                          <form class="forms-sample" action="{{url('/update')}}/{{$project->id}}" method="POST">
                                                          @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="opsi" id="opsi" placeholder="Opsi" value="{{ $project->opsi }}" required>
                                                          </div>
                                                          <div class="form-group">
                                                            <input type="hidden" class="form-control" name="project" id="project" placeholder="Project" value="{{ $project->project }}" required>
                                                          </div>
                                                          <div class="form-group">
                                                          <div class="form-floating">
                                                            <input type="text" class="form-control" name="nama_project" id="nama_project" placeholder="Nama Project" value="{{ $project->nama_project }}" required>
                                                            <label for="floatingInput">Nama Project</label>
                                                          </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <select class="form-control" id="jenis" name="jenis" style="color: black" required>
                                                                <?php
                                                                if( $project->jenis == "sim"){
                                                                 ?> <option selected value="{{ $project->jenis }}">Sistem Informasi Manajemen</option>
                                                                    <option value="perizinan">Layanan Perizinan</option>
                                                                    <option value="lainnya">Lainnya</option> <?php
                                                                }elseif( $project->jenis == "perizinan"){
                                                                  ?> <option selected value="{{ $project->jenis }}">Layanan Perizinan</option>
                                                                      <option value="sim">Sistem Informasi Manajemen</option>
                                                                      <option value="lainnya">Lainnya</option> <?php
                                                                }else{
                                                                  ?> <option selected value="{{ $project->jenis }}">Lainnya</option>
                                                                      <option value="sim">Sistem Informasi Manajemen</option>
                                                                      <option value="perizinan">Layanan Perizinan</option> <?php
                                                                }
                                                                  ?>
                                                              </select>
                                                        </div>
                                                        <div class="form-group">
                                                      <div class="form-floating">
                                                          <textarea class="form-control" placeholder="Deskripsi Project" id="deskripsi" style="height: 100px" name="deskripsi">{{$project->deskripsi }}</textarea>
                                                          <label for="floatingTextarea2">Deskripsi</label>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <div class="form-floating">
                                                            <input type="text" class="form-control" name="pengaju" id="pengaju" placeholder="Pengaju" value="{{ $project->pengaju }}" required>
                                                            <label for="floatingInput">Pengaju</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="date" class="form-control col-md-5" name="mulai" id="mulai" placeholder="Tanggal Mulai" value="{{ $project->mulai}}" required>
                                                            <label for="floatingInput">Target Mulai</label>
                                                      </div>
                                                    </div>
                                                      <div class="form-group">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control col-md-5" name="target" id="target" placeholder="Target Selesai" value="{{ $project->target}}" required>
                                                          <label for="floatingInput">Target Selesai</label>
                                                    </div>
                                                    </div>
                                                          <div class="form-group">
                                                                <input type="hidden" class="form-control" name="selesai" id="selesai" placeholder="Tanggal Selesai" value="{{ $project->selesai }}" required>
                                                          </div>
                                                          <div class="form-group">
                                                              <div class="form-floating">
                                                                <input type="text" class="form-control" name="penginput" id="penginput" value="{{ $project->penginput }}" required readonly>
                                                                <label for="floatingInput">Pembuat</label>
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="{{ $project->status }}" required>
                                                        </div>
                                                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                          <button class="btn btn-danger" type="reset">Reset</button>
                                                          <button class="btn btn-primary" type="submit">Submit</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                    </div>
                                  </div>
                                </div>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDel{{$project->id}}"><i class="icon-trash menu-icon" style="color: black"></i></button>
                                  <!--Modal Delete-->
                                  <div class="modal fade modal-lg" id="ModalDel{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header content-wrapper">
                                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body content-wrapper">
                                    <div class="card ">
                                    <div class="card-body">
                                    Apakah Anda Yakin Untuk Menghapus?

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{url('/deleteproject')}}/{{$project->id}}" type="button" class="btn btn-danger">
                                      <i class="icon-trash menu-icon" style="color: black"></i></a>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="text-muted mt-5">*Note : Project yang ada disini tidak dapat dikerjakan oleh programmer jika belum diverifikasi</div>
                </div>
            </div>
          </div>
        </div>

<!-- Modal Baru-->
<div class="modal fade modal-lg" id="ModalNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header content-wrapper">
          <h5 class="modal-title" id="staticBackdropLabel">Form Project Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body content-wrapper">
                      <div class="card ">
                        <div class="card-body">
                            <form class="forms-sample" action="/create" method="POST">
                            @csrf
                          <div class="form-group">
                              <input type="hidden" class="form-control" name="opsi" id="opsi" placeholder="Opsi" value="baru" required>
                              <input type="hidden" class="form-control" name="persentase" id="persentase" placeholder="" value="0 %" required>
                            </div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="project" id="project" placeholder="Project" required>
                            </div>
                            <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="nama_project" id="nama_project" placeholder="Nama Project" required>
                              <label for="floatingInput">Nama Project</label>
                            </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="jenis" name="jenis" style="color: black" required>
                                  <option selected disabled value="">Pilih Jenis Project</option>
                                  <option value="sim">Sistem Informasi Manajemen</option>
                                  <option value="perizinan">Layanan Perizinan</option>
                                  <option value="lainnya">Lainnya</option>
                                </select>
                          </div>
                          <div class="form-group">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Deskripsi Project" id="deskripsi" style="height: 100px" name="deskripsi"></textarea>
                            <label for="floatingTextarea2">Deskripsi</label>
                          </div>
                          </div>
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="pengaju" id="pengaju" placeholder="Pengaju" required>
                              <label for="floatingInput">Pengaju</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating">
                                <input type="date" class="form-control col-md-5" name="mulai" id="mulai" placeholder="Tanggal Mulai" required>
                                <label for="floatingInput">Target Mulai</label>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="date" class="form-control col-md-5" name="target" id="target" placeholder="Target Selesai" required>
                              <label for="floatingInput">Target Selesai</label>
                        </div>
                        </div>
                            <div class="form-group">
                                  <input type="hidden" class="form-control" name="selesai" id="selesai" placeholder="Tanggal Selesai" value="" required>
                            </div>
                            <div class="form-group">
                                <div class="form-floating">
                                  <input type="text" class="form-control" name="penginput" id="penginput" value="{{auth()->user()->name}}" required readonly>
                                  <label for="floatingInput">Pembuat</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="verifikasi" required>
                          </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://momentjs.com/downloads/moment.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
      $( "#datepicker" ).datepicker({
          minDate: moment().add('d', 1).toDate(),
      });
    </script>
<!--End Modal-->

<!--End Modal-->
<!-- Modal Pengembangan -->
<div class="modal fade modal-lg" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header content-wrapper">
          <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Project Pengembangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body content-wrapper">
                      <div class="card ">
                        <div class="card-body">
                            <form class="forms-sample" action="/create" method="POST">
                            @csrf
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="opsi" id="opsi" placeholder="Opsi" value="pengembangan" required>
                          </div>
                        <div class="form-group">
                            <select class="form-control" id="project" name="project" required>
                              <option selected disabled>Pilih Project Yang Dikembangkan</option>
                              @foreach ( $projects2 as $project)
                              <option value="{{$project->id}}">{{$project->nama_project}}</option>
                              @endforeach
                            </select>
                      </div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="project" id="project" placeholder="Project" value="0" required>
                            </div>
                            <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="nama_project" id="nama_project" placeholder="Nama Project" required>
                              <label for="floatingInput">Nama Project</label>
                            </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="jenis" name="jenis" required>
                                  <option selected disabled>Pilih Jenis Project</option>
                                  <option value="sim">Sistem Informasi Manajemen</option>
                                  <option value="perizinan">Layanan Perizinan</option>
                                </select>
                          </div>
                          <div class="form-group">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Deskripsi Project" id="deskripsi" style="height: 100px" name="deskripsi"></textarea>
                            <label for="floatingTextarea2">Deskripsi</label>
                          </div>
                          </div>
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="pengaju" id="pengaju" placeholder="Pengaju" required>
                              <label for="floatingInput">Pengaju</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating">
                                <input type="date" class="form-control col-md-5" name="mulai" id="mulai" placeholder="Tanggal Mulai" required>
                                <label for="floatingInput">Target Mulai</label>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="date" class="form-control col-md-5" name="target" id="target" placeholder="Target Selesai" required>
                              <label for="floatingInput">Target Selesai</label>
                        </div>
                        </div>
                            <div class="form-group">
                                  <input type="hidden" class="form-control" name="selesai" id="selesai" placeholder="Tanggal Selesai" value="" required>
                            </div>
                            <div class="form-group">
                                <div class="form-floating">
                                  <input type="text" class="form-control" name="penginput" id="penginput" value="{{auth()->user()->name}}" required readonly>
                                  <label for="floatingInput">Pembuat</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="verifikasi" required>
                          </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
      </div>
    </div>
  </div>

@endsection
