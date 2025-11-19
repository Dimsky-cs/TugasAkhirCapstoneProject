<!DOCTYPE html>
<html>

<head>
    <title>Laporan Konseling</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 10pt;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>LAPORAN RIWAYAT KONSELING</h2>
    <p>Dicetak oleh: {{ Auth::user()->name }} ({{ ucfirst($role) }}) | Tanggal: {{ $date }}</p>
    <hr>
    @include('exports.laporan_table')
</body>

</html>
