@extends('koordinator/sidebar')
@section('konten')

<h3 class="title" style="text-align: center"><strong>{{$projects->nama_project}}</strong></h3>
<main>
<div class="content" id="home">
<div class="content-description">
<h5><strong> Pengaju : {{$projects->pengaju}}</strong></h5><br>
  <p class="description-text">{{$projects->deskripsi}}</p>
</div>
<div class="content-image">
  <img src="{{ asset('images/bg.png') }}" alt="Logo">
</div>
</div>
</main>
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
                </div>
    @endif
<!-- Tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Programmer</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Fitur</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <form class="forms-sample" action="{{url('/detailverifikasi/programmer/')}}/{{$projects->id}}" method="POST">
                        @csrf
                        <div class="form-group col-lg-6">
                            <select class="form-control" id="user_id" name="user_id" required>
                              <option selected disabled>Pilih Programmer</option>
                              @foreach ( $users as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="project_id" id="project_id" value="{{$projects->id}}">
                    </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end col-lg-6">
                        <button type="submit" class="btn btn-primary me-md-2">Submit</button>
                        </div>
                    </form>
                    <table class="table col-lg-6">
                        <thead>
                          <tr>
                            <th>
                              No
                            </th>
                            <th>
                              Nama
                            </th>
                            <th>
                              Aksi
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($programmers as $programmer)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $programmer->user->name }}</td>
                              <td>
                                   <a type="button" class="btn btn-danger" href="{{url('/detailverifikasi/programmer/$id')}}/{{$programmer->id}}">
                                  <i class="icon-trash menu-icon" style="color: black"></i></a>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <form class="forms-sample" action="{{url('/detailverifikasi/fitur/')}}/{{$projects->id}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" class="form-control" name="project_id" id="project_id" value="{{$projects->id}}">
                        <div class="form-group col-lg-6">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="nama_fitur" id="nama_fitur" placeholder="Nama Fitur" required>
                              <label for="floatingInput">Nama Fitur</label>
                        </div>
                        </div>
                        <div class="form-group col-lg-6 ">
                            <label for="nama_file" class="form-label">Dokumen / Modul</label>
                                <input type="file" class="form-control" name="nama_file" id="nama_file" value="">
                            </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end col-lg-6">
                        <button type="submit" class="btn btn-primary me-md-2">Submit</button>
                        </div>
                    </form>
                    <table class="table col-lg-6">
                        <thead>
                          <tr>
                            <th>
                              No
                            </th>
                            <th>
                              Nama Fitur
                            </th>
                            <th>
                                Modul
                            </th>
                            <th>
                              Aksi
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($fiturs as $fitur)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $fitur->nama_fitur }}</td>
                              <td>
                                @if($fitur->nama_file)
                                <a href="/post-dokumen/{{$fitur->nama_file}}"><button class="btn btn-success" type="button">Download</button></a>
                                @else
                                    Tidak Ada Modul
                                @endif
                              </td>
                              <td>
                                   <a type="button" class="btn btn-danger" href="{{url('/detailverifikasi/fitur/$id')}}/{{$fitur->id}}">
                                  <i class="icon-trash menu-icon" style="color: black"></i></a>
                              </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                </div>
                </div>
              </div><br><br>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-danger" type="button" href="/projecton">Kembali</a>
                </div>
                <div class="modal fade modal-lg" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header content-wrapper">
                          <h5 class="modal-title" id="staticBackdropLabel">Form Edit Project</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body content-wrapper">
                                      <div class="card ">
                                        <div class="card-body">
                                            <form class="forms-sample" action="{{url('/update')}}/{{$projects->id}}" method="POST">
                                            @csrf
                                          <div class="form-group">
                                              <input type="hidden" class="form-control" name="opsi" id="opsi" placeholder="Opsi" value="{{ $projects->opsi }}" required>
                                            </div>
                                            <div class="form-group">
                                              <input type="hidden" class="form-control" name="project" id="project" placeholder="Project" value="{{ $projects->project }}" required>
                                            </div>
                                            <div class="form-group">
                                            <div class="form-floating">
                                              <input type="text" class="form-control" name="nama_project" id="nama_project" placeholder="Nama Project" value="{{ $projects->nama_project }}" required>
                                              <label for="floatingInput">Nama Project</label>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="jenis" name="jenis" style="color: black" required>
                                                  <option selected disabled value="{{ $projects->jenis }}">-- Pilih Jenis Project --</option>
                                                  <option value="sim">Sistem Informasi Manajemen</option>
                                                  <option value="perizinan">Layanan Perizinan</option>
                                                  <option value="lainnya">Lainnya</option>
                                                </select>
                                          </div>
                                          <div class="form-group">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsi Project" id="deskripsi" style="height: 100px" name="deskripsi">{{$projects->deskripsi }}</textarea>
                                            <label for="floatingTextarea2">Deskripsi</label>
                                          </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="form-floating">
                                              <input type="text" class="form-control" name="pengaju" id="pengaju" placeholder="Pengaju" value="{{ $projects->pengaju }}" required>
                                              <label for="floatingInput">Pengaju</label>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <div class="form-floating">
                                                  <input type="date" class="form-control col-md-5" name="target" id="target" placeholder="Target Selesai" value="{{ $projects->target}}" required>
                                                  <label for="floatingInput">Target Selesai</label>
                                            </div>
                                            </div>
                                            <div class="form-floating">
                                                <input type="date" class="form-control col-md-5" name="mulai" id="mulai" placeholder="Tanggal Mulai"  value="{{ $projects->mulai}}"required>
                                                <label for="floatingInput">Target Mulai</label>
                                          </div>
                                            <div class="form-group">
                                                  <input type="hidden" class="form-control" name="selesai" id="selesai" placeholder="Tanggal Selesai" value="{{ $projects->selesai }}" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating">
                                                  <input type="text" class="form-control" name="penginput" id="penginput" value="{{ $projects->penginput }}" required readonly>
                                                  <label for="floatingInput">Pembuat</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="{{ $projects->status }}" required>
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
                <!--End Modal-->

@endsection
