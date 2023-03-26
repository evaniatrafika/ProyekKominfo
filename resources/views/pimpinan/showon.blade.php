@extends('pimpinan/sidebar')
@section('konten')

@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
                </div>
    @endif
    <div class="col-md-12 grid-margin">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Project On Going</h3>
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
                              <h5><span class="badge badge-primary">On Going</span></h5>
                            </td>
                            <td>
                                <a type="button" class="btn btn-info" href="{{url('/detailshowon')}}/{{$project->id}}" ><i class="icon-eye menu-icon" style="color: black"></i></a>
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
