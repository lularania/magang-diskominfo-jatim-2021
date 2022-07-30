<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Instansi</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tanggal Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($permohonans as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->instansi }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->status }}</td>
                @if ($item->id_status != 1)
                    <td>{{ $item->created_at }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
