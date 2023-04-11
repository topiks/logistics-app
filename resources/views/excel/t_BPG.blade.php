<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template BPG</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="6">
                    PT. BOMA BISMA INDRA
                </th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="6">
                    BUKTI PEMAKAIAN GUDANG (BPG)
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    No. Seri : {{$no_seri}}
                </th>
                <th colspan="3" rowspan="2">
                    SEKSI NO./NAMA
                </th>
                <th colspan="2" rowspan="2">
                    BPG No. {{$nomor_bpg}}
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    No. Order : {{$no_order}}
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    Pemesan : {{$pemesan}}
                </th>
                <th colspan="3">
                </th>
                <th colspan="2">
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    Diisi Yang Meminta
                </th>
                <th colspan="3">
                    Diisi Oleh Gudang
                </th>
                <th colspan="2">
                    Diisi Oleh Keuangan
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    Keterangan Barang
                </th>
                <th>
                    No. Kode
                </th>
                <th>
                    Nomor
                </th>
                <th>
                    QTY
                </th>
                <th>
                    Harga
                </th>
                <th>
                    Jumlah
                </th>
            </tr>
            <tr>
                <th>
                    Jumlah
                </th>
                <th colspan="5">
                    Spesifikasi
                </th>
                <th>
                    Material
                </th>
                <th>
                    Barang
                </th>
                <th>
                    BPM
                </th>
                <th>
                    Penyerahan
                </th>
                <th>
                    Satuan
                </th>
                <th>
                    Harga
                </th>
            </tr>
        </thead>
        <tbody>

            <!-- DATA START  -->

            @foreach ($BPG as $bpg)
            <tr>
                <th>{{ $bpg->jumlah }}</th>
                <th>{{ $bpg->spesifikasi }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>{{ $bpg->material }}</th>
                <th>{{ $bpg->kode_barang }}</th>
                <th>{{ $bpg->nomor_bpm }}</th>
                <th>{{ $bpg->qty_penyerahan }}</th>
                <th></th>
                <th></th>
            </tr>
            @endforeach

            <!-- DATA END  -->

            <tr>
                <th colspan="2">
                    Tanggal Penyerahan
                </th>
                <th colspan="7">
                </th>
                <th colspan="2">
                    Total Rp.
                </th>
            </tr>

            <tr>
                <th colspan="4">
                    P2 Produksi/Yang Meminta
                </th>
                <th colspan="4">
                    Kepala Gudang
                </th>
                <th colspan="4">
                    Yang Menerima
                </th>
            </tr>

            <tr>
                <th>
                   Nama : 
                </th>
                <th>
                </th>
                <th>
                   TT : 
                </th>
                <th>
                </th>
                <th>
                   Nama : 
                </th>
                <th>
                </th>
                <th>
                   TT : 
                </th>
                <th>
                </th>
                <th>
                   Nama : 
                </th>
                <th>
                </th>
                <th>
                   TT : 
                </th>
                <th>
                </th>
            </tr>

            <tr>
                <th>
                   Tanggal : 
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    Tanggal :  
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    Tanggal : 
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
            </tr>

            
            <tr>
                <th colspan="4">
                    *Form mengacu pada pembukuan asli
                </th>
            </tr>

            <tr>
                <th>
                    Ket.
                </th>
            </tr>

            <tr>
                <th colspan="3">
                    Hanya untuk rekapan gudang
                </th>
            </tr>


        </tbody>
    </table>
</body>
</html>