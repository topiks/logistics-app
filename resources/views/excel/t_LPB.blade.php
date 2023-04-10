<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPB Template</title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        img {
            width: 80px;
            height: 30px;
        }
    </style>
</head>
<body>
    <br>
    <table>
        <thead>
            <tr>
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
                <th >
                </th>
                <th >
                    Form - QP-2620 - 01 - 02
                </th>
            </tr>
            <tr>
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
                <th colspan="3">
                    No. DOKUMEN :
                </th>
            </tr>
            <tr>
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
                <th colspan="3">
                    TANGGAL : <?= date('d-m-Y');?>
                </th>
            </tr>
            <tr>
                <th >
                    <img src="general/images/logo-full.png" alt="">
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
        </thead>
        
        <tbody>
            <tr>                
                <th>
                    No
                </th>
                <th>
                    NAMA BARANG
                </th>
                <th>
                    QTY
                </th>
                <th>
                    SAT
                </th>
                <th>
                    NO. SPBB/NOTA
                </th>
                <th>
                    PEMASOK
                </th>
                <th>
                    CHK.QC
                </th>
                <th>
                    KETERANGAN
                </th>
                <th>
                    NO.ORDER
                </th>
            </tr>
            <tr>
                <th>

                </th>
                <th>
                    
                </th>
                <th colspan="5">
                    Laporan Penerimaan Barang
                </th>
                <th>
                    
                <th>
                    
                </th>
            </tr>

            <!-- data start -->
            <?php $no = 0; ?>
            @foreach($LPB as $lpb)
            <tr>
                <?php $no++; ?>
                <th>
                    {{ $no }}
                </th>
                <th>
                    {{ $lpb->nama_barang }}
                </th>
                <th>
                    {{ $lpb->qty }}
                </th>
                <th>
                    {{ $lpb->sat }}
                </th>
                <th>
                    {{ $lpb->no_spbb_nota }}
                </th>
                <th>
                    {{ $lpb->pemasok }}
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    {{ $lpb->no_order }}
                </th>
            </tr>
            @endforeach

            <!-- data end -->

            <!-- mengetahui  -->

            <tr>
                <th colspan="2" rowspan="6">
                    Kepada Yth.
                    <br>
                    1. PPC/MM <br>
                    2. Pengadaan <br>
                    3. Din. QC <br>
                    4. Din. QA <br>
                    5. Arsip
                </th>
                <th colspan="3" rowspan="6">
                    Pasuruan, <br>
                    Quality Assurance
                </th>
                <th colspan="2" rowspan="6">
                    Pasuruan, <br>
                    Quality Control
                </th>
                <th colspan="2" rowspan="6">
                    Pasuruan, <br>
                    Gudang Material <br> <br>

                    Iskhak
                </th>
            </tr>
        </tbody>
</body>
</html>