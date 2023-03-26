@extends('pimpinan/sidebar')
@section('konten')

<div class="detail-project">
    <table class="table-detailproject">
      <tr>
        <td>
          @foreach ($fiturs as $fitur)
            <div class="title-margin">
            <h3 class="font-weight-bold">Progres</h3>
            - {{ $fitur->updated_at->format('d M Y h:i:s')  }}
            </div>
        </td>
        <td>
          <div class="card bg-info mb-3 float-right status-panel">
            <div class="card-header">
              <b>Persentase</b>
            </div>
            <ul class="list-group list-group-flush">
              @foreach ($projects as $project)
              <li class="list-group-item color-text"><div class="text-primary"><b> {{ $project->persentase  }} </b></div></li>
              @endforeach
            </ul>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="subtitle-space">
          <h5> Fitur </h5>
          <ul>
            <li class="ul-text">{{ $fitur->nama_fitur  }}</li>
          </ul>
        </div>
        </td>
        <td rowspan="2">
          <div class="float-right right-page-text">
              <h5>Diupload Oleh</h5>
            <ul>
              <li><div class="ul-text">{{ $fitur->uploader }}</div></li>
            </ul>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="subtitle-space">
            <h5> Keterangan </h5>
            {{ $fitur->keterangan }}
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="subtitle-space">
            <h5> Link Github </h5>
            <link rel="stylesheet" href="#">
            <a href="{{ $fitur->link_git }}" class="link-decoration" target="_blank"></i>{{ $fitur->link_git }} </a> <br>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="subtitle-space">
            <h5> Bukti Tampilan </h5>
            <link rel="stylesheet" href="#">
            <img src="{{asset('/img/'.$fitur->gambar)}}" style="width: 700px;" alt="tidak ada gambar" class="image-adjust">
          </div>
        </td>
      </tr>

    </table>
    @endforeach
</div>
@endsection
