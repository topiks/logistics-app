
# Ringkasan Task
1. Pemakaian Material Gudang Kecil
2. Pemakaian Material Gudang Besar
3. Penerimaan Barang Gudang Besar
4. Penolakan Material

<br />

# Fitur
1. domain dan server
2. akses by pc, komputer, hp
3. pembagian user
4. dashboard menampilkan informasi material yang sudah dibuatkan PO yang akan datang, lengkap dengan deskripsi material, dokumen yang disertakan
5. Merekap seluruh material list yang menjadi persediaan perusahaan sebelum lanjut ke tahap produksi
6. List material dapat dicari by jenis, no, po, nama project
7. dapat menginput lokasi penempatan material
8. download excel dengan format yang sudah ditentukan
9. menginput nama project 
10. Menginput nama supplier/vendor dari material
11. merekap persediaan harian, bulanan, dan tahunan
12. menyesuaikan status material dan terekap dengan baik
13. mengintegrasikan pergerakan materila gudang tertutup, terbuka, dan gudang workshop
14. alur pergerakan material terekap oleh sistem
15. distribusi informasi real time
16. notifikasi jika ada inputan update ttg material, baik on delivery, on inspection, material menggunakan nota, material rejected
17. font merah apabila jumlah akan menyentuh angka minimum stock
18. Pembagian role sebagai berikut     
    1. MM => semua fitur
	2. Staff Gudang => semua fitur
	3. PIC Gudang Workshop => melihat daftar list, mengisi form request, mengupdate list material, mengupdate status material berdasarkan jenis pekerjaan dan juga projectnya
	4. Pengadaan => Pengisian penjadwalan kedatangan, menginput dan menghapus dokumen yang dsertakan pada material, list

<br />

# Material dikirim oleh suplier
1. Input ke form berupa text dan number
2. Input dokumen
3. List muncul
4. Notifikasi muncul pada sistem
5. End

<br />

# Persiapan Kedatangan Material
1. Masuk ke notif
2. Pilih menu kedatangan material
3. Tampil List material yang akan datang

<br />

# Material Arrived sampai Put Away
1. Update status material yang akan datang menjadi arrived
2. Mengisi form laporan penerimaan barang
3. download
4. update material menjadi on inspection
5. update material accepted dan melampirkan dokumen AN
6. BPM otomatis terbit pada sistem dan dapat didownload menjadi excel
7. Input lokasi penyimpanan material
8. Material otomatis masuk dalam list material inventory

<br />

# Penolakan dan Pengembalian material
1. update status menjadi rejected
2. notifikasi muncul
3. update dikembalikan

<br />

# Pengeluaran material dari gudang utama dan pemakaian material di gudang workshop
1. Pilih menu stock material wh worksop
2. Apabila tersedia, mengisi form, update status, notifikasi, terekap ke db
3. Apabila tidak tersedia, mengisi form req, muncul notifikasi request
4. staff gudang material mengisi form BPG di sistem, stock material otomatis terupdate


	
