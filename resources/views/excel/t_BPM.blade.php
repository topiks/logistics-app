<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPM Template</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>

                </th>
                <th>

                </th>
                <th colspan="5">
                    PT. BOMA BISMA INDRA (Persero)
                </th>
            </tr>
            <tr>
                <th>

                </th>
                <th>

                </th>
                <th colspan="5">
                    BUKT PENERIMAAN MATERIAL (BPM)
                </th>
            </tr>
            <tr>
                <th>
                    Order Masuk No : {{$order_masuk_no}}
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    OP No: {{$op_no}}
                </th>
            </tr>
            <tr>
                <th>
                    ACC. Notice (PQC)
                </th>
                <th>
                </th>
                <th>
                    No. :
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    BPM. No.: {{$bpm_no}}
                </th>
            </tr>
            <tr>
                <th>
                </th>
                <th>
                </th>
                <th>
                    Tgl : <?=  date('d-m-Y'); ?>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="5" >
                    Uraian Material
                </th>
                <th >
                    Nomor <br> Kode
                </th>
                <th >
                    Satuan
                </th>
                <th >
                    Qty
                </th>
                <th >
                    Harga Satuan <br> (Rp.)
                </th>
                <th >
                    Jumlah Harga <br> (Rp.)
                </th>
            </tr>

            <!-- DATA START  -->
            @foreach($BPM as $bpm)
            <tr>
                <th colspan="5">
                    {{$bpm->uraian_material}}
                </th>
                <th >
                    {{$bpm->no_kode}}
                </th>
                <th >
                    {{$bpm->satuan}}
                </th>
                <th >
                    {{$bpm->qty}}
                </th>
                <th >
                    asd 
                </th>
                <th >
                    asd
                </th>
            </tr>
            @endforeach
            <!-- DATA END  -->

            <tr>
                <th colspan="8">
                    Nomor/Nama Supplier: {{$nama_supplier}}
                </th>
                <th >
                    Sub Total
                </th>
                <th >
                </th>
            </tr>

            <tr>
                <th>
                    Tanggal Penerimaan
                </th>
                <th colspan="4">
                    Kepala Gudang
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                    PPN 11%
                </th>
            </tr>

            <tr>
                <th>
                    {{$tanggal_penerimaan}}
                </th>
                <th>
                    Nama: <br> <br>
                </th>
                <th >
                </th>
                <th >
                    TT: <br> <br>
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                    Total <br> <br>
                </th>
            </tr>

            <tr>
                <th>
                    *Form mengacu pada pembukuan asli
                </th>
                <th>
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
            </tr>

            <tr>
                <th>
                    Ket.
                </th>
                <th>
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
            </tr>

            <tr>
                <th>
                    Hanya untuk rekapan gudang
                </th>
                <th>
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
                <th >
                </th>
            </tr>

        </tbody>
    </table>
</body>
</html>