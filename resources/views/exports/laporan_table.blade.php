<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr style="background-color: #f3f4f6; font-weight: bold;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Nama Klien</th>
            <th>Nama Psikolog</th>
            <th>Layanan</th>
            <th>Status</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->consultation_date)->format('d M Y') }}</td>
                <td>{{ $item->consultation_time }}</td>
                <td>{{ $item->client_name }}</td>
                <td>{{ $item->psikolog->name ?? '-' }}</td>
                <td>{{ ucfirst($item->service_type) }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->rating ? $item->rating . ' Bintang' : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
