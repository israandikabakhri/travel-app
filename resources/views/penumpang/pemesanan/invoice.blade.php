<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pemesanan Tiket</title>
    <style type="text/css">
      .invoice {
    font-family: Arial, sans-serif;
    width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
    </style>
</head>
<body>

    <div class="invoice">
    <h1 style="text-decoration: underline;">Travel App</h1>
        <h3>Invoice Pemesanan Tiket</h3>
        <p>Nama Penumpang: {{ $data[0]->nama }}</p>
        <p>Tanggal Pemesanan: {{ $data[0]->waktu_pesan }}</p>

        <table>
            <thead>
                <tr>
                    <th>Tujuan</th>
                    <th>Tanggal Perjalanan</th>
                    <th>Harga Tiket</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data[0]->tujuan_travel }}</td>
                    <td>{{ $data[0]->waktu_berangkat }}</td>
                    <td>Rp {{ number_format($data[0]->harga_tiket) }},-</td>
                </tr>
            </tbody>
        </table>

        <p>Total Bayar: Rp {{ number_format($data[0]->harga_tiket) }},-</p>
    </div>
</body>
</html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<script type="text/javascript">

$(document).ready(function () {
    window.print();
});

</script>