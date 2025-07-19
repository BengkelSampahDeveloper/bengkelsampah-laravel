---
sidebar_position: 2
title: Transaksi (Setoran)
---

# 💸 Transaksi (Setoran)

Menu **Transaksi** adalah tempat untuk melihat, mencari, dan mengelola semua transaksi setoran sampah yang masuk ke bank sampah.

---

## Bagian-bagian Penting di Menu Transaksi

### 1. **Filter Data (Bagian Atas)**
- **Filter Bank Sampah:**
  - Hanya muncul untuk admin pusat.
  - Pilih “Semua Bank Sampah” atau cabang tertentu untuk melihat data spesifik.
- **Filter Tipe Transaksi:**
  - Pilih “Jual”, “Sedekah”, atau “Tabung” untuk melihat jenis transaksi tertentu.
- **Filter Status:**
  - Pilih status transaksi: Dikonfirmasi, Diproses, Dijemput, Selesai, Batal.
- **Filter Tanggal:**
  - Pilih tanggal mulai & selesai untuk melihat transaksi dalam rentang waktu tertentu.
- **Pencarian:**
  - Cari transaksi berdasarkan nama user, ID transaksi, atau nomor telepon.
- **Cara Pakai:**
  - Klik filter, pilih sesuai kebutuhan, tabel di bawahnya akan otomatis berubah.

### 2. **Tabel Daftar Transaksi**
- Menampilkan daftar transaksi dengan kolom:
  - **ID Transaksi**
  - **Nama User**
  - **Tanggal**
  - **Tipe Transaksi** (Jual/Sedekah/Tabung)
  - **Status** (dikonfirmasi, diproses, dijemput, selesai, batal)
  - **Total Estimasi** (perkiraan nilai transaksi)
  - **Total Aktual** (nilai setelah ditimbang)
  - **Aksi** (lihat detail, edit, hapus)
- **Status ditandai warna berbeda** agar mudah dibedakan.
- **Klik baris atau tombol aksi** untuk melihat detail atau mengedit transaksi.

### 3. **Export Data**
- **Fungsi:** Download data transaksi ke file Excel, CSV, atau PDF.
- **Cara Pakai:**
  - Klik tombol **Export** di kanan atas tabel.
  - Pilih format file yang diinginkan.
  - Data yang di-export sesuai filter yang sedang dipilih.

### 4. **Detail Transaksi & Edit Item Sampah**
- **Fungsi:** Melihat semua informasi lengkap tentang satu transaksi dan mengelola item sampah di dalamnya.
- **Yang Ditampilkan:**
  - ID transaksi, status, user, bank sampah, tanggal, tipe transaksi.
  - Daftar item sampah (nama, berat estimasi, berat aktual, harga, total).
  - Total estimasi & total aktual (berat dan harga).
  - Riwayat status dan waktu update.
- **Edit Item Sampah (Saat Status Dijemput/Selesai):**
  - **Input Berat Aktual:**
    - Setiap item sampah harus diisi berat aktualnya sebelum transaksi bisa diselesaikan.
  - **Tambah Item Sampah:**
    - Klik tombol “Tambah Item Sampah”, pilih jenis sampah, isi berat aktual, harga otomatis, lalu simpan.
  - **Hapus Item Sampah:**
    - Klik tombol “Hapus” di baris item, item akan dicoret dan tidak dihitung ke total.
  - **Restore Item:**
    - Jika salah hapus, klik “Batal” untuk mengembalikan item.
  - **Validasi:**
    - Semua item (kecuali yang dihapus) wajib diisi berat aktual.
    - Tidak bisa menyelesaikan transaksi jika ada item yang belum diisi berat aktual.
- **Update Status:**
  - Bisa mengubah status transaksi (misal: dari dikonfirmasi ke diproses, dijemput, selesai, atau batal).
  - Jika status selesai, sistem akan meminta konfirmasi dan menghitung total aktual.
  - Jika status batal, wajib isi alasan pembatalan.
  - Jika status dijemput, wajib isi nama & kontak petugas.
- **Aksi:**
  - Edit data transaksi (jika status masih awal).
  - Hapus transaksi (dengan konfirmasi).
  - Cetak struk transaksi (jika sudah selesai).

### 5. **Hak Akses**
- **Admin Pusat:**
  - Bisa melihat dan filter semua cabang.
  - Bisa export semua data.
  - Bisa edit/hapus semua transaksi.
- **Admin Cabang:**
  - Hanya melihat data cabangnya sendiri.
  - Tidak bisa filter cabang lain.
  - Hanya bisa edit/hapus transaksi di cabangnya.

---

## Langkah-langkah Praktis Menggunakan Menu Transaksi
1. **Masuk ke menu Transaksi** dari sidebar.
2. **Gunakan filter** (bank, tipe, status, tanggal, pencarian) untuk mencari transaksi yang diinginkan.
3. **Lihat tabel** untuk melihat daftar transaksi.
4. **Klik tombol aksi** (lihat detail, edit, hapus) di setiap baris transaksi.
5. **Untuk export data**, klik tombol Export dan pilih format file.
6. **Untuk update status transaksi:**
   - Buka detail transaksi.
   - Jika ingin menyelesaikan transaksi, pastikan semua item sudah diisi berat aktual.
   - Tambah item jika ada sampah tambahan, hapus item jika ada yang tidak jadi disetor.
   - Klik status “Selesai”, isi data yang diperlukan, lalu simpan.
7. **Untuk cetak struk**, buka detail transaksi yang sudah selesai lalu klik Cetak Struk.

---

## Contoh Skenario Nyata
- **Mau tahu transaksi setoran bulan ini di cabang A?**
  - Pilih cabang A di filter bank, pilih periode “Bulanan”.
- **Mau export data transaksi ke Excel?**
  - Atur filter sesuai kebutuhan, klik Export, pilih Excel.
- **Mau update status transaksi jadi selesai dan input berat aktual?**
  - Buka detail transaksi, isi berat aktual semua item, tambah/hapus item jika perlu, lalu simpan.
- **Mau tahu siapa saja yang setor hari ini?**
  - Pilih tanggal hari ini di filter, lihat tabel transaksi.

---

## Tips & Solusi Masalah
- **Data tidak muncul?**
  - Cek filter, pastikan sudah benar. Coba refresh halaman.
- **Tidak bisa update status?**
  - Pastikan status sebelumnya sudah benar, dan data yang diperlukan sudah diisi.
  - Pastikan semua item sudah diisi berat aktual.
- **Export gagal?**
  - Coba ulangi, pastikan koneksi internet stabil.
- **Takut salah hapus?**
  - Sistem akan meminta konfirmasi sebelum menghapus data. Item yang dihapus bisa di-restore sebelum transaksi selesai.

---

## Glosarium Istilah Sederhana
- **Setoran:** Menyerahkan sampah ke bank sampah.
- **Tipe Transaksi:** Jual (langsung dijual), Sedekah (disumbangkan), Tabung (ditabung jadi poin).
- **Status Transaksi:**
  - **Dikonfirmasi:** Sudah dicek admin, menunggu proses.
  - **Diproses:** Sedang diproses oleh petugas.
  - **Dijemput:** Sampah sedang dijemput petugas, bisa edit item.
  - **Selesai:** Transaksi selesai, user dapat poin/XP, item sudah final.
  - **Batal:** Transaksi dibatalkan (ada alasan).
- **Total Estimasi:** Perkiraan nilai transaksi sebelum ditimbang.
- **Total Aktual:** Nilai transaksi setelah ditimbang.
- **Struk:** Bukti transaksi yang bisa dicetak.

---

:::info
Menu Transaksi dibuat agar mudah digunakan semua orang. Jika bingung, jangan ragu bertanya ke super admin!
::: 