@extends('programmer/sidebar')
@section('konten')

<div class="row col-md-12 grid-margin">
  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Welcome Back, {{auth()->user()->name}}</h3>
  </div>
</div>

<div class="col-md-6 grid-margin stretch-card">
  <div class="card tale-bg">
    <div class="card-people mt-auto">
      <img src="images/dashboard/people.svg" alt="people">
      <div class="weather-info">
            <h3 class="mb-0 font-weight-normal"><?php
              date_default_timezone_set('Asia/Jakarta');
              echo date('l, d / M / Y');
              echo "<br/>";
              ?>
              </h3><p ><h4 class="mb-8 font-weight-normal" style="text-align: right;"><span id="clock">00:00:00</span> <?php echo date(' A'); ?>
              </h4></p>
              <script>
                var span = document.getElementById('clock');

                  function time() {
                    var d = new Date();
                    var s = d.getSeconds();
                    var m = d.getMinutes();
                    var h = d.getHours();
                    span.textContent = 
                      ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
                  }
                  setInterval(time, 1000);
              </script>


      </div>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-light-blue">
        <div class="card-body">
          <p class="mb-3">Total Project Anda</p>
          <p class="fs-30 mb-2">{{ $project_total }}</p>
          <div> Updated at {{ date('d/d/Y') }} </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3 stretch-card transparent">
      <div class="card card-dark-blue">
        <div class="card-body">
          <p class="mb-3">Project Selesai</p>
          <p class="fs-30 mb-2">{{ $project_selesai }}</p>
          <div> {{ $persentase_selesai }}% Dari Total Project </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card card-light-danger">
        <div class="card-body">
          <p class="mb-3">Project Dalam Pengerjaan</p>
          <p class="fs-30 mb-2">{{ $project_proses }}</p>
          <div> {{ $persentase_proses }}% Dari Total Project </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3 stretch-card transparent">
      <div class="card card-tale">
        <div class="card-body">
          <p class="mb-3">Jumlah Kinerja</p>
          <p class="fs-30 mb-2">{{ $jumlah_kinerja }}</p>
          <div>Project Diselesaikan</div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="container-quote">
  <h2 class="font-weight-bold">Daily Quote</h2>
    <div id="quoteContainer">
      <p>Generating Quotes Now... </p>
      <p id="quoteGenius">Please Wait</p>			
    </div><!--end quoteContainer-->
</div><!--end container-->

</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src=" {{ asset('js/quotes.js') }}"></script>

@endsection
