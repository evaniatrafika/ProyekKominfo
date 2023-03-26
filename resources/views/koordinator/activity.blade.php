@extends('koordinator/sidebar')
@section('konten')

<h3 class="font-weight-bold">Riwayat Aktivitas</h3>

    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Nama Aktor</th>
                    <th>Nama Project</th>
                    <th>Aktivitas</th>
                    <th>Role</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Aktor</th>
                    <th>Nama Project</th>
                    <th>Aktivitas</th>
                    <th>Role</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($history as $log)
                <tr>
                    <td>{{ $log->nama_user }}</td>
                    <td>{{ $log->nama_project }}</td>
                    <td>{{ $log->aktivitas }}</td>
                    <td>{{ $log->role }}</td>
                    <td>{{ $log->created_at->format('d M Y') }}</td>
                    <td>{{ $log->created_at->format('h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</main>

@endsection
